<?php

namespace App\Domains\Affiliate\DTO\AffiliateLinkDTO;
use App\Domains\Affiliate\Models\AffiliateLink;
use Illuminate\Support\Str;
use App\Http\Requests\AffiliateLink\CreateAffiliateLinkRequest;
use Spatie\DataTransferObject\DataTransferObject;
class CreateAffiliateLinkData extends DataTransferObject
{
    public string $code;
    public int $affiliate_id;
    public int $status;
    public static function fromRequest(CreateAffiliateLinkRequest $request) : CreateAffiliateLinkData
    {        
        while(true) {
            $code = Str::random(10);
            $link = AffiliateLink::where('code',$code)->first();
            if ($link==null){
                break;
            }
        }
       
        $data = [
            'code' => $code,
            'affiliate_id' => (int)$request->affiliate_id, 
            'status' => (int)$request->status
        ];

        return new self($data);
    }
}
