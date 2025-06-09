<?php

namespace Database\Seeders\admin;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Almuna',
            'email' => 'almunaadmin@gmail.com',
            'password' => bcrypt('admin1234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}

