<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MergeCards extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'cards' => 'required|file|mimes:txt,csv',
			'contacts' => 'required|file|mimes:txt,csv',
        ];
    }

	public function attributes()
	{
		return [
			'cards' => 'Cards',
			'contacts' => 'Contacts',
		];
	}
}
