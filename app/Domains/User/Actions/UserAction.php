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
            'password' => Hash::make($data->password),
        ]);
    }

    public function update(UpdateUserData $data,$userId)
    {
        $user = User::find($userId);
        abort_unless((bool)$user,404,"User not found");
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->address = $data->address;
        $user->role = $data->role;
        $user->phone_number = $data->phone_number;
        if(!empty($data->password)){
            $user->password= Hash::make($data->password);
        }
        $user->save();
        return $user;
    }
    public function delete($user_id){
        $user = User::find($user_id);
        abort_unless((bool)$user,404,'User not found');
        $user->delete();
        return $user;
    }
    public static function find($user_id){
        $user = User::find($user_id);
        return $user;
    }
}
