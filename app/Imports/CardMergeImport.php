<?php

namespace App\Imports;

use App\Models\Card;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class CardMergeImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
		if(count($row) !== 0)
		{
			return new Card([
				'abbott_code' => $row[0],
				'code' => $row[1],
			]);
		}
    }

    public function rules(): array
    {
        return [
            '0' => 'required|exists:abbott_code,code',
            '1' => 'required|size:14|alpha_num|unique:card,code'
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => "Abbott Code",
            '1' => "Code",
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Abbott Code is required',
            '1.size'  => "Card code must be exactly 14 digits long",
            '1.alpha' => "Card code cannot contain special characters",
        ];
    }
}
