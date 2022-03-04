<?php

namespace App\Http\Controllers;

use App\Domains\Device\Actions\DeviceAction;
use App\Domains\Device\DTO\DeviceDTO\CreateDeviceData;
use App\Http\Requests\UpdateDeviceRequest;
use App\Domains\Device\Gateways\DeviceGateway;
use App\Domains\Device\Models\Device;
use App\Http\Requests\CreateDeviceRequest;
use Illuminate\Http\Request;
use App\Domains\Device\DTO\DeviceDTO\UpdateDeviceData;
use Illuminate\Support\Facades\Auth;

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
        $device = (new DeviceGateway)->with(['user'])->edit($device_id);
        return $device;
    }
    public function show($device_id)
    {
        $device = (new DeviceGateway)->with(['user'])->edit($device_id);
        return $device;
    }
    public function store(CreateDeviceRequest $request)
    {
        $user = Auth::user();
        $data = CreateDeviceData::fromRequest($request,$user->id);
        if (!empty($request->csv)
        &&
        $request->file('csv')->isValid()) {
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
                $data = new CreateDeviceData([
                    'serial_number'=>$row[0],
                    'address_id' =>$request->address_id,
                    'creator_id'=>$user->id,
                ]);
                $device = Device::where('serial_number',$row[0])->first();
                if($device!=null){
                    $devices[]=(new DeviceAction)->create($data);
                }      
            }
            return $devices;
        }

        return (new DeviceAction)->create($data);
    }
    public function update(UpdateDeviceRequest $request, $device_id)
    {
        $data = UpdateDeviceData::fromRequest($request, $device_id);
        
        return (new DeviceAction)->update($data, $device_id);
        ;
    }
    public function delete($device_id)
    {
        $device = (new DeviceAction)->delete($device_id);
        return $device;
    }
}
