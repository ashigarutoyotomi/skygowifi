<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFActory, Notifiable;

    /**
     * the attributes are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'email',
        'last_name',
        'role',
        'address',
        'phone_number'
    ];

    /**
     * attributes that should be hiden for serialization
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const USER_ROLE_ADMIN = 1;
    const USER_ROLE_MANAGER = 2;
    const USER_ROLE_CUSTOMER = 3;
}
