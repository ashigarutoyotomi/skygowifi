<?php

namespace App\Http\Controllers\Setting;
use App\Domains\Settings\Models\Setting;
use App\Domains\Settings\DTO\SettingDTO\UpdateSettingData;
use App\Domains\Settings\Actions\SettingAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateSettingRequest;

class SettingsController extends Controller
{
    /**
     * Get all Settings
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $settings = Setting::all();
        return $settings;
    }

    // public function store(CreateAffiliateRequest $request)
    // {
    //     $data = CreateAffiliateData::fromRequest(($request));

    //     $affiliate = (new AffiliateAction)->create($data);

    //     return $affiliate;
    // }

    // public function show($affiliateId)
    // {
    //     $affiliate = (new AffiliateGateway)->find($affiliateId);
    //     abort_unless((bool)$affiliate, 404, 'Affiliate not found');
    //     return $affiliate;
    // }

    // public function edit($affiliateId)
    // {
    //     $affiliate = (new AffiliateGateway)->edit($affiliateId);
    //     abort_unless((bool)$affiliate, 404, 'Affiliate not found');
    //     return $affiliate;
    // }

    public function update(UpdateSettingRequest $request)
    {
        $setting = (new SettingAction)->find($request->key);

        $data = UpdateSettingData::fromRequest($request);

        $setting = (new SettingAction)->update($data);

        return $setting;
    }

    // public function delete($affiliateId)
    // {
    //     $affiliate = ( new AffiliateAction)->delete($affiliateId);
    //     return $affiliate;
    // }
}
