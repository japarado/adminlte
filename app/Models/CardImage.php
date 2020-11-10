<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardImage extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = "card_image";

	public function card()
	{
		return $this->belongsTo(Card::class);
	}
}
