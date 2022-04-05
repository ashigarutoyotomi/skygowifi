<?php

namespace App\Domains\Settings\DTO\SettingDTO;

use App\Http\Requests\CreateSettingRequest;
use Spatie\DataTransferObject\DataTransferObject;
class CreateSettingData extends DataTransferObject
{
    public string $key;
    public string $value;
    public string $title;
    public int $type;
    public static function fromRequest(CreateSettingRequest $request) : CreateSettingData
    {
        $data = [
            'key' => $request->key,
            'value' => $request->value,            
            'type' => $request->type,
            'title' => $request->title,
        ];

        return new self($data);
    }
}
