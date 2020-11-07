<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbbottCode extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = "abbott_code";

	public function cards()
	{
		return $this->hasMany(Card::class);
	}
}
