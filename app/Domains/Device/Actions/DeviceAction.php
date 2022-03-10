<?php

namespace App\Domains\Device\Actions;

use Illuminate\Support\Facades\Auth;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceData;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceCsvData;
use App\Domains\Device\Models\Device;
use App\Domains\Device\DTO\DeviceDTO\UpdateDeviceData;
use App\Domains\User\Models\User;
use App\Http\Requests\CreateDeviceRequest;

class DeviceAction
{
    /**
     * create user
     * @param CreateDeviceData $data
     * @return mixed
     */
    public function create(CreateDeviceData $data)
    {        
        $user = Auth::user();
        return Device::create([
            'address_id' => $data->address_id,
            'creator_id' => $user->id,
            'serial_number' => $data->serial_number,
        ]);
    }
    public function createCsv(CreateDeviceCsvData $data)
    {        
        $user = Auth::user();
        return Device::create([
            'address_id' => $data->address_id,
            'creator_id' => $user->id,
            'serial_number' => $data->serial_number,
        ]);
    }
    public function update(UpdateDeviceData $data)
    {
        $user = Auth::user();
        $device = Device::find($device_id);
        abort_unless((bool)$device, 404, "Device not found");
        $device->serial_number = $data->serial_number;
        if ($data->address_id==$device->address_id){
            ;
        }else {
            if ($user->role!=User::USER_ROLE_ADMIN) {
                abort(401, "You must be an admin to do this");
            }
        }
        $device->address_id = $data->address_id;
        $device->save();
        return $device;
    }
    public function delete($device_id)
    {
        $device = Device::find($device_id);
        abort_unless((bool)$device, 404, 'Device not found');
        $device->delete();
        return $device;
    }
}
