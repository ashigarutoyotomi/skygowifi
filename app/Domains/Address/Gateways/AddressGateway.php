<?php

namespace App\Domains\Address\Gateways;

use App\Traits\BasicGatewaysTrait;
use App\Domains\Address\Models\Address;
class AddressGateway
{
    use BasicGatewaysTrait;

    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $query = Address::query();
        return $query->get();
    }
    
    public function show($address_id){
        $address = Address::find($address_id); 
        return $address;
    }
    public function edit($address_id){
        $address = Address::find($address_id);
        return $address;
    }
}
