<?php

namespace App\Domains\Affiliate\Models;

use Illuminate\Database\Eloquent\Model;
class Affiliate extends Model
{

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
