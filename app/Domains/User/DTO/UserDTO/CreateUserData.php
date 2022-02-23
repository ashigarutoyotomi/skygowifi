<?php

namespace App\Domains\User\DTO\UserDTO;

use App\Http\Requests\UserRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserData extends DataTransferObject
{
    public string $first_name;
     public string $email;
    public string $last_name;
    public int $role;
    public ?string $address;
    public string $phone_number;
    public string $password;
    public static function fromRequest(UserRequest $request) : CreateUserData
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => $request->password,
            'role' => (int) $request->role,
        ];

        return new self($data);
    }
}
