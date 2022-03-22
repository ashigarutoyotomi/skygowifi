<?php

namespace App\Http\Controllers\Device;

use App\Domains\Device\Actions\DeviceAction;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceData;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceCsvData;
use App\Http\Requests\UpdateDeviceRequest;
use App\Domains\Device\Gateways\DeviceGateway;
use App\Domains\Device\Models\Device;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\CreateDeviceCsvRequest;
use Illuminate\Http\Request;
use App\Domains\Device\DTO\DeviceDTO\UpdateDeviceData;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DevicesController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new DeviceGateway();
        
        $filters = json_decode($request->get('filters'), true);
        if (!empty($filters)) {
            $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if ($keywords) {
            $gateway->setSearch($keywords, ['serial_number']);
        }
        $devices = $gateway->all();
        return $devices;
    }
    public function edit($device_id)
    {
        $device = (new DeviceGateway)->with('creator')->edit($device_id);
        return $device;
    }
    public function show($device_id)
    {
        $device = (new DeviceGateway)->with('creator')->edit($device_id);
        return $device;
    }
    public function store(CreateDeviceRequest $request)
    {
        $data = CreateDeviceData::fromRequest($request);
        return (new DeviceAction)->create($data);
    }
    public function storeCsv(CreateDeviceCsvRequest $request)
    {
        if ($request->file('csv')->isValid()) {
            $devices = [];
            if ($request->csv->getClientOriginalExtension()!='csv') {
                abort(403, 'File extension must be csv');
            }
            $path = $request->csv->storeAs('csv', md5(time()).'csv');
            $handle = fopen(base_path('storage/app/'.$path), 'r');
            $i = 0;
            while (($row = fgetcsv($handle))) {
                if ($i ==0) {
                    $i++;
                    continue;
                }

                $device = Device::where('serial_number', $row[0])->first();

                $data = new CreateDeviceData([
                    'address_id' =>$request->address_id,
                    'creator_id'=>Auth::user()->id,
                    'serial_number'=>$row[0]
                ]);
                
                if (!(bool)$device) {
                    $devices[]=(new DeviceAction)->create($data);
                }
            }
            return $devices;
        }
    }
    public function update(UpdateDeviceRequest $request, $device_id)
    {
        $data = UpdateDeviceData::fromRequest($request, $device_id);

        $device = (new DeviceAction)->update($data);

        return $device;
    }
    public function delete($device_id)
    {
        $device = (new DeviceAction)->delete($device_id);
        return $device;
    }
}
