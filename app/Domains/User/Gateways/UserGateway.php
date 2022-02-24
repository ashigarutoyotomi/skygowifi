<?php

namespace App\Domains\User\Gateways;

use App\Domains\User\Models\User;
use App\Traits\BasicGatewaysTrait;

class UserGateway
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
    // public static function appendFilters($query)
    // {
    //     if (!empty($filters['start_created_at'])) {
    //         $query->where('created_at', '>=', $filters['start_created_at']);
    //     }

    //     if (!empty($filters['end_created_at'])) {
    //         $query->where('created_at', '<=',  $filters['end_created_at']);
    //     }
    //     return $query;
    // }

    public function all(){        
        $query = User::query();        
        if ($this->search['keywords'] && count($this->search['columns'])) {
            $this->appendSearch($query);
        }
        
        if(count($this->filters)){
            $query = $this->appendFilters($query);
        }
        return $query->get(); 
    }

    public function edit($id){
        $user = User::find($id);
        return $user;
    }
    public function find($id){
        return User::find($id);
    }
}
