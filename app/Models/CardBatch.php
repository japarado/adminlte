<?php

namespace App\Models;

use App\Scopes\CardBatchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardBatch extends Model
{
    use HasFactory;

	protected $table = 'batch';

	protected $casts = [
		'data' => 'array'
	];

	protected static function booted()
	{
		static::addGlobalScope(new CardBatchScope);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function cards()
	{
		return $this->hasMany(Card::class, 'batch_id');
	}

	public function rejectedContacts()
	{
		return $this->hasMany(RejectedContact::class);
	}
}
