<?php

namespace App\Domains\User\DTO\UserDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UserRequest;
class UpdateUserData extends DataTransferObject
{
    public string $first_name;
    public string $email;
    public string $last_name;
    public int $role;
    public ?string $address;
    public string $phone_number;
    public int $id;
    public string $password;

    public static function fromRequest(
    UserRequest $request,$user_id) : UpdateUserData {
    $data = [
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'email'=>$request->get('email'),
        'phone_number'=>$request->get('phone_number'),
        'address'=>$request->get('address'),
        'role'=>$request->get('role'),
        'password'=>$request->get('password'),
        'role'=>(int)$request->get('role'),
        'id'=>$user_id,
    ];        
    return new self($data);
}
}
