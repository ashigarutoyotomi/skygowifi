<?php

namespace App\Domains\Address\DTO\Address;

use Spatie\DataTransferObject\DataTransferObject;

class CreateAddressData extends DataTransferObject
{
    public string $text;
    public ?int $hours_of_operations;
    public int $city_id;
}
