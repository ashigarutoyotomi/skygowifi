<?php

namespace App\Domains\User\DTO\UserDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserData extends DataTransferObject
{
    public string $first_name;
    public string $email;
    public string $last_name;
    public ?int $role;
    public ?string $address;
    public string $phone_number;
    public int $id;
}
