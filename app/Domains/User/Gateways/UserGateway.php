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
    public function all()
    {
        $query = User::query();

        if ($this->with) {
            $query->with($this->with);
        }

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }
    public function show($id){
        $user = User::find($id);
        return $user;

    }
    public function edit($id){
        $user = User::findOrFail($id);
        return $user;
    }
}
