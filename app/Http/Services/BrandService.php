<?php
namespace App\Http\Services;

use App\Models\Brand;
use App\Models\BrandCode;

class BrandService {
	public function __construct()
	{
		
	}

	/**
	 * Accepts a string/integer brand code and returns a Brand instance
	 *
	 * @param int|string $code
	 * @return Brand  
	 */
	public static function getBrandByCode($code): ?Brand
	{
		$brand_code = BrandCode::with('brand')->where('code', $code)->first();
		if($brand_code)
		{
			return $brand_code->brand;
		}
		else 
		{
			return null;
		}
	}
}
?>
