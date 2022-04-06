<?php

namespace App\Domains\Settings\Actions;
use App\Domains\Settings\Models\Setting;
use App\Domains\Settings\DTO\SettingDTO\UpdateSettingData;

class SettingAction
{
    public function update(UpdateSettingData $data)
    {
        $setting = Setting::where('key',$data->key)->first();
        abort_unless((bool)$setting, 404, "Setting not found");

        $setting->value = $data->value;
        
        $setting->save();
        return $setting;
    }
}
