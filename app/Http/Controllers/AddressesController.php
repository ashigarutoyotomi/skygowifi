<?php

namespace App\Http\Controllers;
use App\Domains\Address\Actions\AddressAction;
use App\Domains\Address\DTO\Address\CreateAddressData;
use App\Http\Requests\UpdateAddressRequest;
use App\Domains\Address\Gateways\AddressGateway;
use App\Domains\Address\Models\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Domains\Address\DTO\Address\UpdateAddressData;

class AddressesController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->keywords)) {
            $addresses = AddressGateway::all();
            return $addresses;
        }
        $query = Address::query();
        $query = AddressGateway::setSearch($request->keywords, $query);
        $addresses = $query->get();
        return $addresses;
    }
    public function edit($address_id)
    {
        $address = AddressGateway::edit($address_id);
        return $address;
    }
    public function show($address_id)
    {
        $address = AddressGateway::show($address_id);
        return $address;
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
        $address = AddressGateway::show($address_id);
        abort_unless((bool) $address, 404, 'Address not found');
        $address->delete();
        return $address;
    }
}
