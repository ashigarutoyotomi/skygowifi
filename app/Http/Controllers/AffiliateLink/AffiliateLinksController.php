<?php

namespace App\Http\Controllers\AffiliateLink;
use App\Domains\AffiliateLinks\Actions\AffiliateLinkAction;
use App\Domains\Affiliates\DTO\AffiliateDTO\UpdateAffiliateData;
use Illuminate\Support\Facades\DB;
use App\Domains\AffiliateLinks\Gateways\AffiliateLinkGateway;
use App\Domains\AffiliateLinks\DTO\AffiliateLinkDTO\CreateAffiliateLinkData;
use App\Domains\Affiliate\Models\AffiliateLink;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAffiliateLinkRequest;

class AffiliateLinksController extends Controller
{
    /**
     * Get all affiliates
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $gateway = new AffiliateLinkGateway();
        
        $filters = json_decode($request->get('filters'), true);
        if (!empty($filters)) {
            $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if ($keywords) {
            $gateway->setSearch($keywords, ['first_name','last_name','email']);
        }
        $affiliates = $gateway->all();
        return $affiliates;
    }

    public function generate(CreateAffiliateLinkRequest $request)
    {
        $data = CreateAffiliateLinkData::fromRequest(($request));

        $affiliate = (new AffiliateLinkAction)->create($data);

        return $affiliate;
    }
}
