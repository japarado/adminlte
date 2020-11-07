<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCode extends Model
{
    use HasFactory;

	protected $table = 'brand_code';

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}
}
