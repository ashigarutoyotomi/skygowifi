<?php

namespace App\Http\Controllers\City;
use App\Http\Controllers\Controller;
use App\Domains\City\Actions\CityAction;
use App\Domains\City\DTO\CityDTO\CreateCityData;
use App\Domains\City\DTO\CityDTO\UpdateCityData;
use App\Domains\City\Gateways\CityGateway;
use App\Domains\City\Models\City;
use App\Domains\City\DTO\CityDTO\CreateCitiesRequest;
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
        return $gateway->paginate(20)->all();
    }
    public function edit($city_id)
    {
        $city = (new CityGateway)->with(['country'])->edit($city_id);
        return $city;
    }
    public function show($city_id)
    {
        $city = (new CityGateway)->with(['country'])->edit($city_id);
        return $city;
    }
    public function store(CreateCitiesRequest $request)
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
        $city = (new CityAction)->delete($city_id);
        return $city;
    }
}
