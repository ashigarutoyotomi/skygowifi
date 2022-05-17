<?php

namespace App\Domains\City\Gateways;

use App\Domains\City\Models\City;
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
        $query = City::query();        
        if ($this->search['keywords'] && count($this->search['columns'])) {
            $this->appendSearch($query);
        }
        
        if(count($this->filters)){
            $query = $this->appendFilters($query);
        }
        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }
        return $query->get(); 
    }

    protected function appendFilters($query)
    {
        if (array_key_exists('start_created_at', $this->filters)) {
            $query->where('created_at', '>=', $this->filters['start_created_at']);
        }

        if (array_key_exists('end_created_at', $this->filters)) {
            $query->where('created_at', '<=',  $this->filters['end_created_at']);
        }

        return $query;
    }
   
    public function show($city_id)
    {
        $city = City::find($city_id);
        return $city;
    }
    public function edit($city_id)
    {
        $city = City::find($city_id);
        return $city;
        
}
}