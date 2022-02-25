<?php

namespace App\Domains\Address\Models;
use Illuminate\Database\Eloquent\Model;
use App\Domains\City\Models\City;
class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'city_id',
        'hours_of_operations',
    ];

    public function city(){
        return $this->belongsTo(City::class,"city_id");
    }
}
