<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Card;
use App\Models\Contact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class CardImport implements ToCollection, WithValidation
{
    use SkipsFailures;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $card = Card::create([
                'code' => $row[1],
                'abbott_code_id' => 1,
                'brand_id' => 1,
                'batch_id' => $this->batch->id
            ]);

            if (self::hasUserDetails($row)) {
                $card->contact()->save(new Contact([
                    'last_name' => $row[2],
                    'first_name' => $row[3],
                    'phone_number' => $row[4],
                    'email' => array_key_exists(5, $row) ? $row[5] : null
                ]));
            }
        }
    }

    public function rules(): array
    {
        return [
            '0' => 'required|max:2|alpha_num|exists:abbott_code,code',
            '1' => 'required|min:14|alpha_num|unique:card,code',

            '2' => 'required_with:3,4|max:255|alpha_num',
            '3' => 'required_with:2,4|max:255|alpha_num',
            '4' => 'required_with:2,3',
            '5' => 'required_with_all:2,3,4|email'
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'Abbott code',
            '1' => 'Card code',
            '2' => 'Last name',
            '3' => 'First name',
            '4' => 'Mobile number',
            '5' => 'Email'
        ];
    }

    public static function hasUserDetails($row)
    {
        return array_key_exists(2, $row) && array_key_exists(3, $row) && array_key_exists(4, $row);
    }
}
