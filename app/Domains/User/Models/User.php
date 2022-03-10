<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Domains\Device\Models\Device;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'phone_number',
        'password'
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

    const USER_ROLE_USER= 1;
    const USER_ROLE_DEALER = 2;
    const USER_ROLE_ADMIN = 3;
    const USER_ROLE_SUPERADMIN = 999;
    
    public function devices(){
        return $this->hasMany(Device::class,'creator_id');
    }
}
