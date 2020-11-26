<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = "voucher";

	public function contact()
	{
		return $this->morphOne(Contact::class, 'contactable');
	}

	public function batch()
	{
		return $this->belongsTo(Batch::class);
	}

	public function smsLog()
	{
		return $this->morphOne(SmsLog::class, 'loggable');
	}
}
