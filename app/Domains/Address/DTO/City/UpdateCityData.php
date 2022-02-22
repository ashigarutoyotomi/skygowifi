<?php

namespace App\Domains\City\DTO\City;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCityData extends DataTransferObject
{
    public string $name;
    public int $country_id;
    public int $id;
}
