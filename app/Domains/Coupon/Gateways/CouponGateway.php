<?php

namespace App\Domains\Coupon\Gateways;

use App\Traits\BasicGatewaysTrait;
use App\Domains\Coupon\Models\Coupon;
class CouponGateway
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
        $query = Coupon::query();        
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

    public function edit($id){
        $user = Coupon::find($id);
        return $user;
    }
    public function find($id){
        return Coupon::find($id);
    }    
}
