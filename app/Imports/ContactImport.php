<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Contact as ModelsContact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactImport implements ToModel
{
	public function __construct(Batch $batch)
	{
		$this->batch = $batch;
	}

	protected Batch $batch;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ModelsContact([
			'first_name' => $row[0],
			'last_name' => $row[1],
			'phone_number' => $row[1],
        ]);
    }
}
