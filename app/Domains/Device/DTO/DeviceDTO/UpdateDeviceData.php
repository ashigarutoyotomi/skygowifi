<?php

namespace App\Domains\Device\DTO\DeviceDTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\UpdateDeviceRequest;

class UpdateDeviceData extends DataTransferObject
{
    public int $address_id;
    public string $serial_number;

    public static function fromRequest(
        UpdateDeviceRequest $request
    ) : UpdateDeviceData {
        $data = [
        'serial_number' => $request->get('serial_number'),
        'address_id' => (int)$request->get('address_id')
    ];
        return new self($data);
    }
}
