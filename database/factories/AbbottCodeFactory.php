<?php

namespace Database\Factories;

use App\Models\AbbottCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbbottCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AbbottCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'code' =>  $this->faker->randomNumber(4),
			'name' => "Placeholder generated name: {$this->faker->lastName}",
			'description' => "Placeholder generated description: {$this->faker->paragraph(3)}",
        ];
    }
}
