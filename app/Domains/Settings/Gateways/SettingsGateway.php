<?php
namespace App\Domains\Settings\Gateways;

use App\Domains\Settings\Models\Setting;
use App\Traits\BasicGatewaysTrait;

class SettingsGateway
{
    public function all()
    {
        $settings = Setting::all();
        return $settings;
    }
    
    public function findByKey($key)
    {
        $setting = Setting::where('key',$key)->first();
        return $setting;
    }
}
