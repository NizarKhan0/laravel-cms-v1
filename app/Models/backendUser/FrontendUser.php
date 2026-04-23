<?php

namespace App\Models\backendUser;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;


#[Table('frontend_users')]
#[Fillable([
    'username',
    'email',
    'email_verified_at',
    'password',
    'first_name',
    'last_name',
    'expires_at',
    'two_factor_expires_at',
    'two_factor_code',
    'is_active',
    'last_login_at',
])]
#[Hidden([
    'password',
    'two_factor_code',
    'remember_token',
])]
class FrontendUser extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, LogsActivity;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'expires_at' => 'datetime',
            'two_factor_expires_at' => 'datetime',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    // override per-model sendemail
    public function sendPasswordResetNotification($token)
    {
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return route('frontend.password.reset', [
                'token' => $token,
                'email' => $notifiable->email,
            ]);
        });

        $this->notify(new ResetPassword($token));
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['username', 'email', 'first_name', 'last_name', 'is_active']) //utk log hanya username dan email
            // ->logFillable() // utk log semua field fillable
            ->useLogName('Backend User') // utk log name
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}") // utk log description
            ->dontLogEmptyChanges();
    }
}