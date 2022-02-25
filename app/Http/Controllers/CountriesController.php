<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Country\Actions\CountryAction;
use App\Domains\Country\DTO\CountryDTO\CreateCountryData;
use App\Http\Requests\UpdateCountriesRequest;
use App\Domains\Country\Gateways\CountryGateway;
use App\Domains\Country\Models\Country;
use App\Http\Requests\CountriesRequest;
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
        $countries = $gateway->all();
        return $countries;


        // if (empty($request->keywords)) {
        //     $countries = CountryGateway::all();
        //     return $countries;
        // }
        // $query = Country::query();
        // $query = CountryGateway::setSearch($request->keywords, $query);
        // $countries = $query->get();
        // return $countries;
    }
    public function edit($country_id)
    {
        $country_id = CountryGateway::edit($country_id);
        return $country_id;
    }
    public function show($country_id)
    {
        $country_id = CountryGateway::show($country_id);
        return $country_id;
    }
    public function store(CountriesRequest $request)
    {
        $data = CreateCountryData::fromRequest($request);

        return (new CountryAction)->create($data);
    }
    public function update(UpdateCountriesRequest $request, $country_id)
    {
        $data = UpdateCountryData::fromRequest($request,$country_id);
        
        return (new CountryAction)->update($data);;
    }
    public function delete($country_id)
    {
        $country= CountryAction::delete($country_id);
        return $country;
    }
}
