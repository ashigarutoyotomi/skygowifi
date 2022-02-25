<?php

namespace App\Http\Controllers;
use App\Domains\Address\Actions\AddressAction;
use App\Domains\Address\DTO\AddressDTO\CreateAddressData;
use App\Http\Requests\UpdateAddressRequest;
use App\Domains\Address\Gateways\AddressGateway;
use App\Domains\Address\Models\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Domains\Address\DTO\AddressDTO\UpdateAddressData;

class AddressesController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new AddressGateway();
        
        $filters = json_decode($request->get('filters'),true);
        if(!empty($filters)){
                $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if($keywords){
                $gateway->setSearch($keywords,['text']); 
        } 
        $addresses = $gateway->all();
        return $addresses;
    }
    public function edit($address_id)
    {
        $address = AddressGateway::edit($address_id);
        $city = $address->city;
        $country = $address->country;
        return response()->json(array_merge($address,$country,$city));
    }
    public function show($address_id)
    {
        $address = AddressGateway::find($address_id);
        $city = $address->city;
        $country = $address->country;
        return response()->json(array_merge($address,$country,$city));
    }
    public function store(AddressRequest $request)
    {
        $data = new CreateAddressData([
            'text' => $request->text,
            'city_id' => (int) $request->city_id,
            'hours_of_operations' => (int) $request->hours_of_operations,
        ]);

        return (new AddressAction)->create($data);
    }
    public function update(UpdateAddressRequest $request, $address_id)
    {
        $data = new UpdateAddressData([
            'text' => $request->text,
            'hours_of_operations' => (int)$request->hours_of_operations,
            'city_id' => (int)$request->city_id,
            'id' => (int)$address_id,
        ]);
        
        return (new AddressAction)->update($data);;
    }
    public function delete($address_id)
    {
        $address = AddressGateway::find($address_id);
        abort_unless((bool) $address, 404, 'Address not found');
        $address->delete();
        return $address;
    }
}
