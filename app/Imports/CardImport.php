<?php

namespace App\Imports;

use App\Models\AbbottCode;
use App\Models\Batch;
use App\Models\Card as ModelsCard;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class CardImport implements ToModel, WithValidation
{
    public function __construct(Batch $batch, AbbottCode $abbott_code)
    {
        $this->batch = $batch;
        $this->abbott_code = $abbott_code;
    }

    private Batch $batch;
    private AbbottCode $abbott_code;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ModelsCard([
            'code' => $row[1],
            'abbott_code_id' => $this->abbott_code->id,
			'batch_id' => $this->batch->id,
			'brand_id' => 1,
            /* 'code' => $row[1], */
            /* 'batch_id' => $this->batch->id, */
            /* 'abbott_code_id' => $this->abbott_code->id, */
            /* 'brand_id' => 1 */
        ]);
    }

    public function rules(): array
    {
        return [
            /* '1' => 'required|exists:abbott_code,code', */
            /* '2' => 'required|string|size:14|regex:/^[a-zA-Z]+$/u' */
            '0' => 'required|numeric|exists:abbott_code,code',
            '1' => 'required|size:14|alpha_num'
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
