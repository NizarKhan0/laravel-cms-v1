<?php

namespace Database\Seeders;

use App\Models\backendUser\FrontendUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class FrontendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable activity log temporarily
        activity()->disableLogging();

        $frontendUser = FrontendUser::updateOrCreate(
            ['email' => 'frontenduser@example.com'],
            [
                'username' => 'frontenduser',
                'password' => Hash::make('password'),
                'first_name' => 'Frontend',
                'last_name' => 'User',
                'is_active' => true,
                'email_verified_at' => now(),
                'last_login_at' => now(),
            ]
        );

        // Re-enable logging
        activity()->enableLogging();

        // Delete any existing seeder log to avoid duplicate
        Activity::where('log_name', 'Frontend User Seeder')->delete();

        // Create single manual activity log
        activity()
            ->causedBy($frontendUser)
            ->tap(function (Activity $activity) use ($frontendUser) {
                $activity->log_name = 'Backend User Seeder';
                $activity->subject_type = 'App\Models\backendUser\FrontendUser';
                $activity->subject_id = $frontendUser->id;
                $activity->event = 'seeded';
                $activity->causer_type = 'App\Models\backendUser\FrontendUser';
                $activity->causer_id = $frontendUser->id;
                $activity->attribute_changes = [
                    "old" => [
                        "email" => "frontenduser@example.com",
                        "username" => "frontenduser",
                        "is_active" => true,
                        "last_name" => "User",
                        "first_name" => "Frontend",
                        "last_login_at" => now(),
                    ],
                    "attributes" => [
                        "email" => "frontenduser@example.com",
                        "username" => "frontenduser",
                        "is_active" => true,
                        "last_name" => "User",
                        "first_name" => "Frontend",
                        "last_login_at" => now(),
                    ]
                ];
                $activity->url = request()?->fullUrl();
                $activity->ip_address = request()?->ip();
                $activity->user_agent = request()?->userAgent();
            })
            ->log('Frontend user seeded successfully');
    }
}
