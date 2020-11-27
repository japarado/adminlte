<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;

	/* protected $fillable = ['batch_code', 'import_type', 'user_id']; */

	protected $table = 'batch';

	protected $fillable = ['import_type', 'brand_id', 'user_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function cards()
	{
		return $this->hasMany(Card::class);
	}

	public function vouchers()
	{
		return $this->hasMany(Voucher::class);
	}

	public function rejectedContacts()
	{
		return $this->hasMany(RejectedContact::class);
	}
}
