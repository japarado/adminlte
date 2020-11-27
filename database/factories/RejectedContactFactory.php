<?php

namespace Database\Factories;

use App\Models\RejectedContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class RejectedContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RejectedContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'first_name' => $this->faker->firstName,
			'last_name' => $this->faker->lastName,
			'phone_number' => $this->faker->phoneNumber,
			'email' => $this->faker->unique()->email(),
        ];
    }
}
