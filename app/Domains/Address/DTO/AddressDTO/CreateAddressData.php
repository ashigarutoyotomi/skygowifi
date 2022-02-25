<?php

namespace App\Domains\Address\DTO\AddressDTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateAddressData extends DataTransferObject
{
    public string $text;
    public ?int $hours_of_operations;
    public int $city_id;
    public static function fromRequest(AddressRequest $request): CreateAddressData
    {
        $data = [
            'text' => $request->text,
            'hours_of_operations' => (int)$request->hours_of_operations,
            'city_id' => (int)$request->city_id,
        ];

        return new self($data);
    }
}
