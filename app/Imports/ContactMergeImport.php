<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactMergeImport implements ToModel, WithValidation
{
	public function model(array $row)
	{
		return new Contact([
			'last_name' => $row[0],
			'first_name' => $row[1],
			'phone_number' => $row[2]
		]);
	}

	public function rules(): array
	{
		return [
			'0' => 'required|size:255|alpha_num',
			'1' => 'required|size:255|alpha_num',
			'2' => 'required|regex:^([+]?63|0)?[9]\d{9}(,\s*([+]?63|0)?[9]\d{9})*$'
		];
	}

	public function customValidationAttributes()
	{
		return [
			'0' => 'Last Name',
			'1' => 'First Name',
			'2' => 'Phone Number'
		];
	}
}
