<?php

namespace Database\Factories;

use App\Models\AbbottCode;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'code' => Str::random(14),
			'abbott_code_id' => AbbottCode::factory()
        ];
    }
}
