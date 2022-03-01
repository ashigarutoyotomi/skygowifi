<?php

namespace App\Domains\Device\Actions;
use Illuminate\Support\Facades\Auth;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceData;
use App\Domains\Device\Models\Device;
use App\Domains\Device\DTO\DeviceDTO\UpdateDeviceData;
use App\Domains\User\Models\User;

class DeviceAction
{
    /**
     * create user
     * @param CreateDeviceData $data
     * @return mixed
     */
    public function create(CreateDeviceData $data)
    {
        return Device::create([
            'address_id' => $data->address_id,
            'serial_number' => $data->serial_number,
            'creator_id'=>1//Auth::user()->id;
        ]);
    }

    public function update(UpdateDeviceData $data, $deviceId)
    {
        $user = Auth::user();
        $device = Device::find($deviceId);
        abort_unless((bool)$device, 404, "Device not found");
        $device->serial_number = $data->serial_number;
        if (!empty($data->address_id)) {
            if ($user->role!=User::USER_ROLE_ADMIN) {
                abort(401, "U must be an admin to do this");
            }
            $device->address_id = $data->address_id;
        }
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
    public function find($device_id)
    {
        $device = Device::find($device_id);
        return $device;
    }
}
