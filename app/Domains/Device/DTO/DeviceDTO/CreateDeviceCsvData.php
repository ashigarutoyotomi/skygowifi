<?php

namespace App\Domains\Device\DTO\DeviceDTO;

use App\Http\Requests\DeviceRequest;
use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\CreateDeviceCsvRequest;
use Illuminate\Support\Facades\Auth;
class CreateDeviceCsvData extends DataTransferObject
{
    public int $creator_id;
    public string $address_id;

    public static function fromRequest(CreateDeviceCsvRequest $request) : CreateDeviceCsvData
    {
        $user = Auth::user();
        $data = [
            'address_id' => $request->address_id,
            'creator_id' => $user->id
        ];

        return new self($data);
    }
}
