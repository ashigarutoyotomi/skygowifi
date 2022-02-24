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
    public static function appendFilters($filters)
    {
        if (!empty($filters['start_created_at'])) {
            $query->where('created_at', '>=', $filters['start_created_at']);
        }

        if (!empty($filters['end_created_at'])) {
            $query->where('created_at', '<=',  $filters['end_created_at']);
        }
        return $query;
    }

    public function all($keyword){
        $query = User::query();
        if(!empty($keyword)){
            $query->where('first_name','%LIKE%',$keyword)->where('last_name','%LIKE%',$keyword);
        }
        return $query::get(); 
    }

    public function edit($id){
        $user = User::find($id);
        return $user;
    }
    public function find($id){
        return User::find($id);
    }
}
