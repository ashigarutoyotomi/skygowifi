<?php

namespace App\Domains\Country\DTO\CountryDTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCountryData extends DataTransferObject
{
    public string $name;
    public static function fromRequest(CreateCountriesRequest $request): CreateCountryData
    {
        $data = [
            'name' => $request->name,
        ];

        return new self($data);
    }
}
