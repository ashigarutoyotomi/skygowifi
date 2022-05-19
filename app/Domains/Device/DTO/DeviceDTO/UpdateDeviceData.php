<?php

namespace App\Domains\Device\DTO\DeviceDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\Device\UpdateDeviceRequest;

class UpdateDeviceData extends DataTransferObject
{
    public int $address_id;
    public string $serial_number;
    public int $device_id;

    public static function fromRequest(
        UpdateDeviceRequest $request,$device_id
    ) : UpdateDeviceData {
        $data = [
        'serial_number' => $request->get('serial_number'),
        'address_id' => (int)$request->get('address_id'),
        'device_id'=>(int)$device_id
    ];
        return new self($data);
    }
}
