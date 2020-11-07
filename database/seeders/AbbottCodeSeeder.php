<?php

namespace Database\Seeders;

use App\Models\AbbottCode;
use Illuminate\Database\Seeder;

class AbbottCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		AbbottCode::factory()
			->state([
			'code' => '9222',
		])
			->create();
    }
}
