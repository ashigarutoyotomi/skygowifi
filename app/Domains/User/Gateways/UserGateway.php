<?php

namespace App\Domains\User\Gateways;

use App\Domains\User\Models\User;
use App\Traits\BasicGatewaysTrait;

class UserGateway
{
    use BasicGatewaysTrait;
    /**
     * Get all users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function appendFilters($filters)
    {
        $query = User::query();
        if (array_key_exists('start_created_at', $filters)) {
            $query->where('created_at', '>=', $filters['start_created_at']);
        }

        if (array_key_exists('end_created_at', $filters)) {
            $query->where('created_at', '<=',  $filters['end_created_at']);
        }
        return $query;
    }

    public function all(){
        return User::all(); 
    }

    public function setSearch($query,$keywords){
        $query->where('first_name', 'like', '%' . $keywords. '%')
        ->orWhere('last_name', 'like', '%' . $keywords. '%');
        return $query;
    }

    public function show($id){
        $user = User::find($id);
        return $user;
    }

    public function edit($id){
        $user = User::find($id);
        return $user;
    }
    public function find($id){
        return User::find($id);
    }
}
