<?php

namespace App\Domains\Address\Actions;

use App\Domains\Address\DTO\AddressDTO\CreateAddressData;
use App\Domains\Address\DTO\AddressDTO\UpdateAddressData;
use App\Domains\Address\Models\Address;
class AddressAction
{
    /**
     * create user
     * @param CreateAddressData $data
     * @return mixed
     */
    public function create(CreateAddressData $data)
    {
        return Address::create([
            'city_id' => $data->city_id,
            'hours_of_operations' => $data->hours_of_operations,
            'text' => $data->text,
        ]);
    }

    public function update(UpdateAddressData $data)
    {
        $address = Address::find($data->id);
        abort_unless((bool)$address, 404, 'address not found');

        $address->text = $data->text;
        $address->hours_of_operations = $data->hours_of_operations;

        $address->save();

        return $address;
    }
}
