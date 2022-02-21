<?php

namespace App\Domains\User\Actions;

use Illuminate\Support\Facades\Hash;
use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Domains\User\Models\User;
use App\Domains\User\DTO\UserDTO\UpdateUserData;

class UserAction
{
    /**
     * create user
     * @param CreateUserData $data
     * @return mixed
     */
    public function create(CreateUserData $data)
    {
        return User::create([
            'first_name' => $data->first_name,
            'email' => $data->email,
            'last_name' => $data->last_name,
            'role' => $data->role,
            'address'=>$data->address,
            'phone_number'=>$data->phone_number,
        ]);
    }

    public function update(UpdateUserData $data)
    {
        $user = User::find($data->id);
        abort_unless((bool)$user, 404, 'user not found');
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->address = $data->address;
        $user->role = $data->role;
        $user->phone_number = $data->phone_number;
        $user->save();
        return $user;
    }
}
