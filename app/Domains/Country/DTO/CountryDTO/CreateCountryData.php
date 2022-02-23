<?php

namespace App\Domains\Country\DTO\CountryDTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCountryData extends DataTransferObject
{
    public string $name;
}
