<?php

namespace Database\Seeders;

use App\Models\AbbottCode;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\BrandCode;
use App\Models\Card;
use App\Models\Contact;
use App\Models\RejectedContact;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		self::seedBrandsAndCodes();

		$brands = Brand::all();
		$abbott_code = AbbottCode::first();

		foreach($brands as $brand)
		{
			// Voucher improts
			User::factory()
				->has(
					Batch::factory()
						->has(
							Voucher::factory()
								->has(Contact::factory())
								->state(['brand_id' => $brand->id])
								->count(10)
						)
						->has(
							Voucher::factory()
								->state(['brand_id' => $brand->id])
								->count(5)
						)
						->has(
							RejectedContact::factory()
								->count(15)
						)
						->state(['import_type' => config('constants.IMPORT_TYPES.voucher')])
						->count(5)
				)
				->count(2)
				->create();

			// Card
			User::factory()
				->has(
					Batch::factory()
						->has(
							Card::factory()
								->has(Contact::factory())
								->state(['abbott_code_id' => $abbott_code->id, 'brand_id' => $brand->id])
								->count(10)
						)
						->has(
							Card::factory()
								->state(['abbott_code_id' => $abbott_code->id, 'brand_id' => $brand->id])
								->count(5)
						)
						->has(
							RejectedContact::factory()
								->count(15)
						)
						->state(['import_type' => config('constants.IMPORT_TYPES.card')])
						->count(5)
				)
				->count(2)
				->create();
		}

    }

	private static function seedBrandsAndCodes()
	{
		foreach(config('constants.BRANDS') as $brand_attributes)
		{
			$brand = new Brand(['name' => $brand_attributes['name']]);
			$brand->save();
			$brand_codes = array_map(function($code) use ($brand) {
				return new BrandCode(['code' => $code, 'brand_id' => $brand->id]);
			}, $brand_attributes['codes']);
			$brand->brandCodes()->saveMany($brand_codes);
		}
	}
}
