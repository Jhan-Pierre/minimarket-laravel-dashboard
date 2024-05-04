<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@minimarketlaravel.io',
            'password' => bcrypt('123456'),
            'estado_id' => '1',
        ])->assignRole('Admin');

        User::factory(15)->create();
    }
}
