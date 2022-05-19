<?php

namespace App\Domains\Affiliate\DTO\AffiliateDTO;

use App\Http\Requests\Affiliate\CreateAffiliateRequest;
use Spatie\DataTransferObject\DataTransferObject;
class CreateAffiliateData extends DataTransferObject
{
    public string $first_name;
    public string $email;
    public string $last_name;
    public string $password;
    public static function fromRequest(CreateAffiliateRequest $request) : CreateAffiliateData
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,            
            'email' => $request->email,
            'password' => $request->password,
        ];

        return new self($data);
    }
}
