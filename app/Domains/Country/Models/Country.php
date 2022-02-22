<?php

namespace App\Domains\Addresses\Models;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Cities\Models\City;
class Country extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    public function cities(){
        return $this->hasMany(City::class);
    }

}
