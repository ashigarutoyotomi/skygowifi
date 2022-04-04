<?php

namespace App\Domains\Affiliates\DTO\AffiliateDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UpdateAffiliateRequest;
class UpdateAffiliateData extends DataTransferObject
{
    public string $first_name;
    public string $email;
    public string $last_name;
    public ?string $password;

    public static function fromRequest(
    UpdateAffiliateRequest $request) : UpdateAffiliateData {
    $data = [
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'email'=>$request->get('email'),
        'password'=>$request->get('password'),
    ];        
    return new self($data);
}
}
