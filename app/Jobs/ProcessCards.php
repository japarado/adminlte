<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\Card;
use App\Models\Contact;
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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		foreach ($this->cards as $row) {
            $card = Card::create([
                'code' => $row['card_code'],
                'abbott_code_id' => 1,
                'brand_id' => $row['brand_id'],
				'batch_id' => $this->batch->id
            ]);

            if ($row['first_name']) {
                $contact = new Contact([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'phone_number' => $row['phone_number'],
                    'email' => $row['email'],
                ]);

                $card->contact()->save($contact);
            }
        }
    }
}
