<?php

namespace App\Domains\Address\DTO\AddressDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateAddressData extends DataTransferObject
{
    public string $text;
    public int $city_id;
    public ?int $hours_of_operations;
    public static function fromRequest(UpdateAddressRequest $request,$address_id): UpdateAddressData
    {
        $data = [
            'text' => $request->text,
            'country_id' => (int)$request->country_id,
            'id' => (int)$address_id,
            'hours_of_operations' => $request->hours_of_operations,
        ];

        return new self($data);
    }
}
