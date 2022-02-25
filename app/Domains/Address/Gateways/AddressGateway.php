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
    
    public function all(){        
        $query = Address::query();        
        if ($this->search['keywords'] && count($this->search['columns'])) {
            $this->appendSearch($query);
        }
        
        if(count($this->filters)){
            $query = $this->appendFilters($query);
        }
        return $query->get(); 
    }

    public function edit($id){
        $user = Address::find($id);
        return $user;
    }
    public function find($id){
        return Address::find($id);
    }
}
