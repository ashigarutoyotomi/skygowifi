<?php

namespace App\Http\Controllers\Setting;
use App\Domains\Settings\Gateways\SettingsGateway;
use App\Domains\Settings\Models\Setting;
use App\Domains\Settings\DTO\SettingDTO\UpdateSettingData;
use App\Domains\Settings\Actions\SettingAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $settings = (new SettingsGateway)->all();
        return $settings;
    }

    public function update(UpdateSettingRequest $request)
    {
        $data = UpdateSettingData::fromRequest($request);

        $setting = (new SettingAction)->update($data);

        return $setting;
    }   
    public function show(Request $request){
        return (new SettingsGateway)->find($request->key);
    }
}
