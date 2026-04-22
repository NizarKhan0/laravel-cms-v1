<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\backendUser\BackendUser;

class BackendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BackendUser::updateOrCreate(
            ['email' => 'superadmin@example.com'], // condition to check if exists
            [
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
