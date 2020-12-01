<?php
namespace App\Http\Services;

use App\Models\Brand;

class BrandService
{
    public function findBrandByCardCode(string $card_code) : ?Brand
    {
        $brand_code = substr($card_code, 0, 4);
        $brand =  Brand::whereHas('brandCodes', function ($query) use ($brand_code) {
            $query->where('code', 'like', "%${brand_code}%");
        })->first();
        return $brand;
    }
}
