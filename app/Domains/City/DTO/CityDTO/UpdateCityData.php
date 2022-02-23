<?php

namespace App\Domains\City\DTO\CityDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCityData extends DataTransferObject
{
    public string $name;
    public int $country_id;
}
