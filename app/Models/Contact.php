<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
	use SoftDeletes;
	 
	protected $table = "contact";

	protected $fillable = [
		'first_name',
		'last_name',
		'phone_number',
		'email',
		'contactable_id',
		'contactable_type'
	];

	public function contactable()
	{
		return $this->morphTo();
	}
}
