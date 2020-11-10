<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Contact;
use App\Models\RejectedContact;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => "Justin",
            "last_name" => "Parado",
            "email" => "justin.parado.personal@sample.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
    }
}
