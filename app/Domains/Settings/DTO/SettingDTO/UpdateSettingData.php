<?php

namespace App\Domains\Settings\DTO\SettingDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UpdateSettingRequest;
class UpdateSettingData extends DataTransferObject
{
    public string $key;
    public string $value;
    public static function fromRequest(
    UpdateSettingRequest $request) : UpdateSettingData {
    $data = [
        'key' => $request->get('key'),
        'value' => $request->get('value')
    ];        
    return new self($data);
}
}
