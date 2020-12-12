<?php

namespace App\Models;

use App\Scopes\VoucherBatchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherBatch extends Model
{
    use HasFactory;

	protected $table = 'batch';

	protected $casts = [
		'data' => 'array'
	];

	protected static function booted()
	{
		static::addGlobalScope(new VoucherBatchScope);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function vouchers()
	{
		return $this->hasMany(Voucher::class, 'batch_id');
	}

	public function rejectedContacts()
	{
		return $this->hasMany(RejectedContact::class);
	}
}
