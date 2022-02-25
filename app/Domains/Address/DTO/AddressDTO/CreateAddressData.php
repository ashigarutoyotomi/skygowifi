<?php

namespace App\Domains\Address\DTO\AddressDTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateAddressData extends DataTransferObject
{
    public string $text;
    public ?int $hours_of_operations;
    public int $city_id;
    public static function fromRequest(CreateAddressRequest $request): CreateAddressData
    {
        $data = [
            'text' => $request->text,
            'country_id' => (int)$request->country_id,
            'hours_of_operations' => $request->hours_of_operations,
        ];

        return new self($data);
    }
}
