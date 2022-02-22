<?php

namespace App\Domains\Country\DTO\Country;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCountryData extends DataTransferObject
{
    public string $name;
    public int $id;
}
