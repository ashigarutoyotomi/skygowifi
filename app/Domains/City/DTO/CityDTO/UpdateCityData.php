<?php

namespace App\Domains\City\DTO\CityDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Domains\City\DTO\CityDTO\UpdateCitiesRequest;
class UpdateCityData extends DataTransferObject
{
    public string $name;
    public int $country_id;
    public int $id;
    public static function fromRequest(UpdateCitiesRequest $request,$city_id): UpdateCityData
    {
        $data = [
            'name' => $request->name,
            'country_id' => (int)$request->country_id,
            'id' => (int)$city_id,
        ];

        return new self($data);
    }
}
