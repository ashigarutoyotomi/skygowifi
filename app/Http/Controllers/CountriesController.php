<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Country\Actions\CountryAction;
use App\Domains\Country\DTO\CountryDTO\CreateCountryData;
use App\Domains\Country\DTO\CountryDTO\UpdateCountryRequest;
use App\Domains\Country\Gateways\CountryGateway;
use App\Domains\Country\Models\Country;
use App\Domains\Country\DTO\CountryDTO\CreateCountryRequest;
use App\Domains\Country\DTO\CountryDTO\UpdateCountryData;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new CountryGateway();
        
        $filters = json_decode($request->get('filters'),true);
        if(!empty($filters)){
                $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if($keywords){
                $gateway->setSearch($keywords,['name']); 
        } 
        $country = $gateway->all();
        return $country;
    }
    public function edit($country_id)
    {
        $country_id = (new CountryGateway)->edit($country_id);
        return $country;
    }
    public function show($country_id)
    {
        $country_id = (new CountryGateway)->show($country_id);
        return $country;
    }
    public function store(CreateCountryRequest $request)
    {
        $data = CreateCountryData::fromRequest($request);

        return (new CountryAction)->create($data);
    }
    public function update(UpdateCountryRequest $request, $country_id)
    {
        $data = UpdateCountryData::fromRequest($request,$country_id);
        
        return (new CountryAction)->update($data);;
    }
    public function delete($country_id)
    {
        $country = CountryAction::delete($country_id);
        return $country;
    }
}
