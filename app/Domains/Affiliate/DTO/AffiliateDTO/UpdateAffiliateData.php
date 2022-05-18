<?php

namespace App\Domains\Affiliate\DTO\AffiliateDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UpdateAffiliateRequest;
class UpdateAffiliateData extends DataTransferObject
{
    public string $first_name;
    public string $email;
    public string $last_name;
    public ?string $password;
    public int $id;

    public static function fromRequest(
    UpdateAffiliateRequest $request,$affiliateId) : UpdateAffiliateData {
    $data = [
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'email'=>$request->get('email'),
        'password'=>$request->get('password'),
        'id'=>(int)$affiliateId,
    ];        
    return new self($data);
}
}
