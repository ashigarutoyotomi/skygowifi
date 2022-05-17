<?php

namespace App\Domains\Affiliates\Gateways;

use App\Domains\Affiliates\Models\Affiliate;
use App\Traits\BasicGatewaysTrait;

class AffiliateGateway
{
    use BasicGatewaysTrait;
    /**
     * get users by set filters
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
        $query = Affiliate::query();        
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
        $affiliate = Affiliate::find($id);
        return $affiliate;
    }
    public function find($id){
        return Affiliate::find($id);
    }
}
