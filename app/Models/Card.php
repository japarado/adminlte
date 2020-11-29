<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = "card";
	
	protected $fillable = ["code", "batch_id", "abbott_code_id", 'brand_id'];

	public function contact()
	{
		return $this->morphOne(Contact::class, 'contactable');
	}

	public function cardImage()
	{
		return $this->hasOne(CardImage::class);
	}

	public function batch()
	{
		return $this->belongsTo(Batch::class);
	}

	public function abbottCode()
	{
		return $this->belongsTo(AbbottCode::class);
	}

	public function smsLog()
	{
		return $this->morphOne(SmsLog::class, 'loggable');
	}

	public function getCodePrefixAttribute()
	{
		return substr($this->code, 0, 4);
	}
}
