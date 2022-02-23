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
        if (empty($request->keywords)) {
            $countries = CountryGateway::all();
            return $countries;
        }
        $query = Country::query();
        $query = CountryGateway::setSearch($request->keywords, $query);
        $countries = $query->get();
        return $countries;
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
        $data = new CreateCountryData([
            'name' => $request->name,
        ]);

        return (new CountryAction)->create($data);
    }
    public function update(UpdateCountriesRequest $request, $country_id)
    {
        $data = new UpdateCountryData([
            'name' => $request->name,
            'id' => (int)$request->id,
        ]);
        
        return (new CountryAction)->update($data);;
    }
    public function delete($country_id)
    {
        $country = CountryGateway::show($country_id);

        abort_unless((bool)$country, 404, 'country not found');
        $country->delete();
        return $country;
    }
}
