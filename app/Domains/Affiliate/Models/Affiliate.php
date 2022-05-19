<?php

namespace App\Domains\Affiliate\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
class Affiliate extends Model
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
        'password'
    ];

    /**
     * attributes that should be hiden for serialization
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
