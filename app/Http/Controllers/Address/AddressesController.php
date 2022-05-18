<?php

namespace App\Http\Controllers\Address;
use App\Domains\Address\Actions\AddressAction;
use App\Domains\Address\DTO\AddressDTO\CreateAddressData;
use App\Domains\Address\DTO\AddressDTO\UpdateAddressRequest;
use App\Domains\Address\Gateways\AddressGateway;
use App\Domains\Address\Models\Address;
use App\Domains\Address\DTO\AddressDTO\CreateAddressRequest;
use Illuminate\Http\Request;
use App\Domains\Address\DTO\AddressDTO\UpdateAddressData;
use App\Http\Controllers\Controller;
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
        return $gateway->paginate(20)->all();
    }
    public function edit($address_id)
    {
        $address = (new AddressGateway)->with(['country','city'])->edit($address_id);
        return $address;
    }
    public function show($address_id)
    {
        $address = (new AddressGateway)->with(['city'])->edit($address_id);
        return $address;
    }
    public function store(CreateAddressRequest $request)
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
        $address = (new AddressAction)->delete($address_id);        
        return $address;
    }
}
