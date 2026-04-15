<?php

namespace App\Models\backendUser;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Table('backend_users')]
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
])]
#[Hidden([
    'password',
    'two_factor_code',
    'remember_token',
])]
class BackendUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'expires_at' => 'datetime',
            'two_factor_expires_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}