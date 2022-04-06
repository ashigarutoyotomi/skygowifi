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
    
    public function find($key)
    {
        $setting = Setting::where('key',$key)->first();
        abort_unless((bool)$setting,404,'Setting not found');
        return $setting;
    }
}
