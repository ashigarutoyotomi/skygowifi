<?php

namespace App\Http\Controllers;

use App\Domains\City\Actions\CityAction;
use App\Domains\City\DTO\CityDTO\CreateCityData;
use App\Domains\City\DTO\CityDTO\UpdateCityData;
use App\Domains\City\Gateways\CityGateway;
use App\Domains\City\Models\City;
use App\Domains\City\DTO\CityDTO\CitiesRequest;
use App\Domains\City\DTO\CityDTO\UpdateCitiesRequest;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new CityGateway();
        
        $filters = json_decode($request->get('filters'),true);
        if(!empty($filters)){
                $gateway->setFilters($filters);
        }
        $keywords =$request->get('keywords');
        if($keywords){
                $gateway->setSearch($keywords,['name']); 
        } 
        $cities = $gateway->all();
        return $cities;
    }
    public function edit($city_id)
    {
        $city = CityGateway::edit($city_id);
        $country = $city->country;        
        return response()->json([$city, $country]);
    }
    public function show($city_id)
    {
        $city = CityGateway::show($city_id);
        $country = $city->country;        
        return response([$city, $country]);
    }
    public function store(CitiesRequest $request)
    {
        $data = CreateCityData::fromRequest($request);

        return (new CityAction)->create($data);
    }
    public function update(UpdateCitiesRequest $request, $city_id)
    {
        $data = UpdateCityData::fromRequest($request,$city_id);

        return (new CityAction)->update($data);
    }
    public function delete($city_id)
    {
        $city = CityAction::delete($city_id);
        return $city;
    }
}
