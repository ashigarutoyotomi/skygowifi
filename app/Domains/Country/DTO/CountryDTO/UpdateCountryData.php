<?php

namespace App\Domains\Country\DTO\CountryDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCountryData extends DataTransferObject
{
    public string $name;
    public int $id;
    public static function fromRequest(UpdateCountriesRequest $request,$country_id): CreateCountryData
    {
        $data = [
            'name' => $request->name,
            'id'=>(int)$country_id,
        ];

        return new self($data);
    }
}
