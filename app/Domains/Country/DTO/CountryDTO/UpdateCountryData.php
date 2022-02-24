<?php

namespace App\Domains\Country\DTO\CountryDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCountryData extends DataTransferObject
{
    public string $name;
    public int $id;
}
