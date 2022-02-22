<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Country\Actions\CountryAction;
use App\Domains\Country\DTO\Country\CreateCountryData;
use App\Http\Requests\UpdateCountryRequest;
use App\Domains\Country\Gateways\CountryGateway;
use App\Domains\Country\Models\Country;
use App\Http\Requests\CountryRequest;
use App\Domains\Country\DTO\Country\UpdateCountryData;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->keywords)) {
            $countries = CountryGateway::all();
            return $addresses;
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
    public function store(CountryRequest $request)
    {
        $data = new CreateCountryData([
            'name' => $request->text,
        ]);

        return (new CountryAction)->create($data);
    }
    public function update(UpdateCountryRequest $request, $country_id)
    {
        $data = new UpdateCountryData([
            'name' => $request->name,
            'id' => (int)$id,
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
