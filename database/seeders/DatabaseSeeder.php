<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


		User::factory()->create([
			'first_name' => 'Admin',
			'last_name' => 'User',
			'email' => 'admin@admin.com',
			'password' => Hash::make('admin')
		]);

		$this->call([
			AbbottCodeSeeder::class,
			BrandSeeder::class, 
		]);
    }
}
