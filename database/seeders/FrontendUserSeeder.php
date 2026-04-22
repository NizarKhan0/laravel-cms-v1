<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\backendUser\FrontendUser;

class FrontendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrontendUser::updateOrCreate(
            ['email' => 'frontenduser@example.com'], // condition to check if exists
            [
                'username' => 'frontenduser',
                'password' => Hash::make('password'),
                'first_name' => 'Frontend',
                'last_name' => 'User',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
