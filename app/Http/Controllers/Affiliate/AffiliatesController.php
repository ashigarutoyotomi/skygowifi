<?php

namespace App\Http\Controllers\Affiliate;

use App\Domains\Affiliate\Gateways\AffiliateGateway;
use App\Domains\Affiliate\DTO\AffiliateDTO\UpdateAffiliateData;
use Illuminate\Support\Facades\DB;
use App\Domains\Affiliate\Actions\AffiliateAction;
use App\Domains\Affiliate\DTO\AffiliateDTO\CreateAffiliateData;
use App\Domains\Affiliate\Models\Affiliate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAffiliateRequest;
use App\Http\Requests\UpdateAffiliateRequest;

class AffiliatesController extends Controller
{
    /**
     * Get all affiliates
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $gateway = new AffiliateGateway();
        
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

    public function store(CreateAffiliateRequest $request)
    {
        $data = CreateAffiliateData::fromRequest(($request));

        $affiliate = (new AffiliateAction)->create($data);

        return $affiliate;
    }

    public function show($affiliateId)
    {
        $affiliate = (new AffiliateGateway)->find($affiliateId);
        abort_unless((bool)$affiliate, 404, 'Affiliate not found');
        return $affiliate;
    }

    public function edit($affiliateId)
    {
        $affiliate = (new AffiliateGateway)->edit($affiliateId);
        abort_unless((bool)$affiliate, 404, 'Affiliate not found');
        return $affiliate;
    }

    public function update(UpdateAffiliateRequest $request, $affiliateId)
    {
        $affiliate = (new AffiliateAction)->find($affiliateId);

        $data = UpdateAffiliateData::fromRequest($request,$affiliateId);

        $affiliate = (new AffiliateAction)->update($data);

        return $affiliate;
    }

    public function delete($affiliateId)
    {
        $affiliate = ( new AffiliateAction)->delete($affiliateId);
        return $affiliate;
    }
}
