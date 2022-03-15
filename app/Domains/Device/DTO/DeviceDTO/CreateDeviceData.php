<?php

namespace App\Domains\Device\DTO\DeviceDTO;

use App\Http\Requests\DeviceRequest;
use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\CreateDeviceCsvRequest;
use Illuminate\Support\Facades\Auth;
class CreateDeviceData extends DataTransferObject
{
    public string $serial_number;
    public int $creator_id;
    public string $address_id;

    public static function fromRequest($request) : CreateDeviceData
    {
        $user = Auth::user();
        $data = [
            'address_id' => $request->address_id,
            'serial_number' => $request->serial_number,
            'creator_id' => $user->id
        ];

        return new self($data);
    }
    public static function fromCsvRequest(CreateDeviceCsvRequest $request) : CreateDeviceData
    {
        $user = Auth::user();
        $data = [
            'address_id' => $request->address_id,
            'creator_id' => $user->id,
            'serial_number'=> $request->serial_number
        ];

        return new self($data);
    }
}
