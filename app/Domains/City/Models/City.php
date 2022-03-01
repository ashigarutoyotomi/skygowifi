<?php

namespace App\Domains\City\Models;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Country\Models\Country;
use App\Domains\Address\Models\Address;
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
        return $this->belongsTo(Country::class,'country_id');
    }
    public function address(){
        return $this->hasMany(Address::class,'city_id');
    }
}
