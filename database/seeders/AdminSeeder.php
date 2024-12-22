<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'mobile_number' => '1234567890',
                'company_name' => 'ServiceCentralPro',
                'password' => bcrypt('password'), // Use a secure password in production
                'role' => 'admin',
            ]
        );
    }
}
