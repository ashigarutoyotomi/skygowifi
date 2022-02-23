<?php

namespace App\Domains\Address\DTO\AddressDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateAddressData extends DataTransferObject
{
    public string $text;
    public int $city_id;
    public ?int $hours_of_operations;
}
