<?php

namespace App\Domains\Country\Gateways;

use App\Domains\Country\Models\Country;
use App\Traits\BasicGatewaysTrait;
class CountryGateway
{
    use BasicGatewaysTrait;

    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $query = Country::query();
        return $query->get();
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
