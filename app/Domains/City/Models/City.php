<?php

namespace App\Domains\City\Models;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Countries\Models\Country;
use App\Domains\Addresses\Models\Address;
class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
}
