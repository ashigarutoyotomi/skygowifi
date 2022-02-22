<?php

namespace App\Domains\Country\DTO\Country;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCountryData extends DataTransferObject
{
    public string $name;
}
