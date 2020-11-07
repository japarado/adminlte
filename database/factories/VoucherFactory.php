<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'code' => 'AB' . Str::random(14),
			'discount_value' => $this->faker->randomNumber(2),
			'is_amount' => Arr::random([true, false]),
			'batch_id' => Batch::factory()
        ];
    }
}
