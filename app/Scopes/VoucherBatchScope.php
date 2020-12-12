<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class VoucherBatchScope implements Scope 
{
	public function apply(Builder $builder, Model $model)
	{
		$builder->where('import_type', config('constants.IMPORT_TYPES.voucher'));
	}
}
?>
