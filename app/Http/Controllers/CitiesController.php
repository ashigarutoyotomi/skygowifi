<?php

namespace App\Http\Controllers;

use App\Domains\City\Actions\CityAction;
use App\Domains\City\DTO\CityDTO\CreateCityData;
use App\Domains\City\DTO\CityDTO\UpdateCityData;
use App\Domains\City\Gateways\CityGateway;
use App\Domains\City\Models\City;
use App\Http\Requests\CitiesRequest;
use App\Http\Requests\UpdateCitiesRequest;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->keywords)) {
            $cities = CityGateway::all();
            return $cities;
        }
        $query = City::query();
        $query = CityGateway::setSearch($request->keywords, $query);
        $cities = $query->get();
        return $cities;
    }
    public function edit($city_id)
    {
        $city = CityGateway::edit($city_id);
        return $city;
    }
    public function show($city_id)
    {
        $city = CityGateway::show($city_id);
        return $city;
    }
    public function store(CitiesRequest $request)
    {
        $data = new CreateCityData([
            'name' => $request->name,
            'country_id' => (int) $request->country_id,
        ]);

        return (new CityAction)->create($data);
    }
    public function update(UpdateCitiesRequest $request, $city_id)
    {
        $data = new UpdateCityData([
            'name' => $request->name,
            'country_id' => (int) $request->country_id,
            'id' => (int) $request->id,
        ]);

        return (new CityAction)->update($data);
    }
    public function delete($city_id)
    {
        $city = CityGateway::show($city_id);
        abort_unless((bool)$city, 404, 'City not found');
        $city->delete();
        return $city;
    }
}
