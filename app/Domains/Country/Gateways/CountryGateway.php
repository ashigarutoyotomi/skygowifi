<?php

namespace App\Domains\User\Gateways;

use App\Domains\Coutries\Models\Country;
use App\Traits\BasicGatewaysTrait;
class CountryGateway
{
    use BasicGatewaysTrait;

    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(int $country_id)
    {
        $query = Country::query();
        return $query->get();
    }

    public function setSearch($keyword){
        $query = Country::query();
        $query->where('name',"%LIKE%",$keyword);
        return $query;
    }
public function show ($country_id){
    $country = Country::find($country_id);
    return $country;
}
public function edit($country_id){
    $country = Country::find($country_id);
    return $country;
}
}
