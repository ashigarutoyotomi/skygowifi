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
        $data = CreateAddressData::fromRequest($request);

        return (new AddressAction)->create($data);
    }
    public function update(UpdateAddressRequest $request, $address_id)
    {
        $data = UpdateAddressData::fromRequest($request,$address_id);
        
        return (new AddressAction)->update($data);;
    }
    public function delete($address_id)
    {
        $address = AddressAction::delete($address_id);        
        return $address;
    }
}
