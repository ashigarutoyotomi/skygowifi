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

    public function all(){
        $query = User::query();

        if ($this->search['keywords'] && count($this->search['columns'])) {
            $this->appendSearch($query);
        }

        if(count($this->filters)){
            $this->appendFilters($query);
        }

        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }

        return $query->get();
    }

    public function edit($id){
        $user = User::find($id);
        return $user;
    }

    public static function find($id){
        return User::find($id);
    }

    public function getCreateFields(User $user)
    {
        $fields = [
            'first_name' => [
                'key' => 'first_name',
                'title' => "First name",
                'type' => "text",
                'value' => '',
            ],
            'last_name' => [
                'key' => 'last_name',
                'title' => "Last name",
                'type' => "text",
                'value' => '',
            ],
            'email' => [
                'key' => 'email',
                'title' => "Email",
                'type' => "email",
                'value' => '',
            ],
            'role' => [
                'key' => 'role',
                'title' => "Role",
                'type' => "select",
                'options' => [
                    ['value' => User::USER_ROLE_USER, 'name' => 'User'],
                    ['value' => User::USER_ROLE_DEALER, 'name' => 'Dealer'],
                ],
                'value' => '',
            ],
            'address' => [
                'key' => 'address',
                'title' => "Address",
                'type' => "text",
                'value' => '',
            ],
            'phone_number' => [
                'key' => 'phone_number',
                'title' => "Phone number",
                'type' => "text",
                'value' => '',
            ],
            'password' => [
                'key' => 'password',
                'title' => "Password",
                'type' => "password",
                'value' => '',
            ],
        ];

        if ($user->role === User::USER_ROLE_SUPERADMIN) {
            $fields['role']['options'][] = ['value' => User::USER_ROLE_ADMIN, 'name' => 'Admin'];
        }

        return $fields;
    }
}
