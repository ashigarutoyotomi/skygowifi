<?php

namespace App\Domains\Affiliates\Actions;

use Illuminate\Support\Facades\Hash;
use App\Domains\Affiliates\DTO\AffiliateLinkDTO\CreateAffiliateLinkData;
use App\Domains\Affiliates\Models\AffiliateLink;
class AffiliateLinkAction
{
    /**
     * create affiliate
     * @param CreateAffiliateLinkData $data
     * @return mixed
     */
    public function create(CreateAffiliateLinkData $data)
    {
        return AffiliateLink::create([
            'code' => $data->code,            
            'status' => $data->status,
            'affiliate_id'=>$data->affiliate_id
        ]);
    }
}
