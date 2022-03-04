<?php

namespace App\Domains\Device\DTO\DeviceDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UpdateDeviceRequest;

class UpdateDeviceData extends DataTransferObject
{
    public ?string $address_id;
    public ?string $serial_number;

    public static function fromRequest(
        UpdateDeviceRequest $request
    ) : UpdateDeviceData {
        $data = [
        'serial_number' => $request->get('serial_number'),
        'address_id' => $request->get('address_id'),
        "device_id"=>$request->device_id
    ];
        return new self($data);
    }
}
