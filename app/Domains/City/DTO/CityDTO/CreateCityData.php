<?php

namespace App\Domains\City\DTO\CityDTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCityData extends DataTransferObject
{
    public string $name;
    public int $country_id;
    public static function fromRequest(CitiesRequest $request): CreateCityData
    {
        $data = [
            'name' => $request->name,
            'country_id' => (int)$request->country_id,
        ];

        return new self($data);
    }
}
