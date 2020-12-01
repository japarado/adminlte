<?php

namespace App\Jobs;

use App\Http\Services\BrandService;
use App\Http\Services\CardService;
use App\Models\Batch;
use App\Models\Card;
use App\Models\Contact;
use App\Models\RejectedContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCards implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $cards;
    private int $fallback_brand_id;
    private Batch $batch;
    private BrandService $brand_service;
    private CardService $card_service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $cards, int $fallback_brand_id, Batch $batch)
    {
        $this->cards = $cards;
        $this->batch = $batch;
        $this->fallback_brand_id = $fallback_brand_id;

        $this->brand_service = new BrandService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->cards as $row)
        {

            // Check if card already exists
            $card_query = Card::with('contact')->where('code', $row['card_code'])->first();

            $card = null;
            $contact = null;
			$contact_can_be_accomodated = true;

            $row_has_contact = !is_null($row['first_name']);

            if ($row_has_contact)
            {
                $contact = new Contact([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'phone_number' => $row['phone_number'],
                    'email' => $row['email'],
                ]);
            }

            // Card exists
            if ($card_query)
            {
                $card = $card_query;

                // Card already has an associated contact and contact info is present in the row
                if ($card->contact && $row_has_contact)
                {
                    $supplementary_card = Card::vacant()->first();

                    // A vacant card was found for the customer
                    if ($supplementary_card)
                    {
                        $card = $supplementary_card;
                    }
                    else
                    {
						$contact_can_be_accomodated = false;
                        RejectedContact::create([
                            'first_name' => $row['first_name'],
                            'last_name' => $row['last_name'],
                            'phone_number' => $row['phone_number'],
                            'email' => $row['email'],
							'batch_id' => $this->batch->id
                        ]);
                    }
                }
            }
            else
            {
                $card = new Card([
                    'code' => $row['card_code'],
                    'abbott_code_id' => 1,
                    'brand_id' => $row['brand_id'],
                    'batch_id' => $this->batch->id
                ]);
            }

            if ($card)
            {
				$card->save();

				if($contact && $contact_can_be_accomodated)
				{
					$card->contact()->save($contact);
				}
            }
        }
    }
}
