<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RejectedContact extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $table = "rejected_contact";

	public function batch()
	{
		return $this->belongsTo(Batch::class);
	}
}
