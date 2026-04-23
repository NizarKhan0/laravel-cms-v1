<?php

namespace Database\Seeders;

use App\Models\backendUser\BackendUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class BackendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable activity log temporarily
        activity()->disableLogging();

        $backendUser = BackendUser::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'is_active' => true,
                'email_verified_at' => now(),
                'last_login_at' => now(),
            ]
        );

        // Re-enable logging
        activity()->enableLogging();

        // Delete any existing seeder log to avoid duplicate
        Activity::where('log_name', 'Backend User Seeder')->delete();

        // Create single manual activity log
        activity()
            ->causedBy($backendUser)
            ->tap(function (Activity $activity) use ($backendUser) {
                $activity->log_name = 'Backend User Seeder';
                $activity->subject_type = 'App\Models\backendUser\BackendUser';
                $activity->subject_id = $backendUser->id;  // Fixed: use actual ID instead of string
                $activity->event = 'seeded';
                $activity->causer_type = 'App\Models\backendUser\BackendUser';
                $activity->causer_id = $backendUser->id;
                $activity->attribute_changes = [
                    "old" => [
                        "email" => "superadmin@example.com",
                        "username" => "superadmin",
                        "is_active" => true,
                        "last_name" => "Admin",
                        "first_name" => "Super",
                        "last_login_at" => now(),
                    ],
                    "attributes" => [
                        "email" => "superadmin@example.com",
                        "username" => "superadmin",
                        "is_active" => true,
                        "last_name" => "Admin",
                        "first_name" => "Super",
                        "last_login_at" => now(),
                    ]
                ];
                $activity->url = request()?->fullUrl();
                $activity->ip_address = request()?->ip();
                $activity->user_agent = request()?->userAgent();
            })
            ->log('Backend user seeded successfully');
    }
}
