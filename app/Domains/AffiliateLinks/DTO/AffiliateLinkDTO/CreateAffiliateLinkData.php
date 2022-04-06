<?php

namespace App\Domains\AffiliateLinks\DTO\AffiliateLinkDTO;
use Illuminate\Support\Str;
use App\Http\Requests\CreateAffiliateLinkRequest;
use Spatie\DataTransferObject\DataTransferObject;
class CreateAffiliateLinkData extends DataTransferObject
{
    public string $code;
    public int $affiliate_id;
    public static function fromRequest(CreateAffiliateLinkRequest $request) : CreateAffiliateLinkData
    {
        $data = [
            'code' => Str::random(10),
            'affiliate_id' => (int)$request->affiliate_id, 
        ];

        return new self($data);
    }
}
