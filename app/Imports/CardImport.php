<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Card;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class CardImport implements ToCollection, WithValidation, WithChunkReading, ShouldQueue
{
    public function __construct()
    {
		$this->batch = Batch::create([
			'import_type' => config('constants.IMPORT_TYPES.card'),
			'user_id' => 1,
		]);
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
		foreach($collection as $row)
		{
			$this->batch->cards->save(Card::new([
				'code' => $row[0],
				'abbott_code_id' => 1,
				'brand_id' => 1,
			]));
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

	public function chunkSize(): int
	{
		return 1000;
	}
}
