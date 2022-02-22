<?php

namespace App\Domains\User\Gateways;

use App\Domains\Cities\Models\City;
use App\Traits\BasicGatewaysTrait;

class CityGateway
{
    use BasicGatewaysTrait;

    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $query = Cities::query();
        return $query->get();
    }

    public function setSearch($keyword){
        $query = City::query();
        $query->where('name',"%LIKE%",$keyword);
        return $query;
    }
    public function show($city_id){
        $city = City::find($city_id);
        return $city;
    }
    public function edit($city_id){
        $city = City::find($city_id);
        return $city;
    }
}
