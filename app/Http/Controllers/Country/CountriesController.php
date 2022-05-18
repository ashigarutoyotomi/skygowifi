<?php

namespace App\Http\Controllers\Country;

use Illuminate\Http\Request;
use App\Domains\Country\Actions\CountryAction;
use App\Domains\Country\DTO\CountryDTO\CreateCountryData;
use App\Domains\Country\DTO\CountryDTO\UpdateCountryRequest;
use App\Domains\Country\Gateways\CountryGateway;
use App\Domains\Country\Models\Country;
use App\Domains\Country\DTO\CountryDTO\CreateCountryRequest;
use App\Domains\Country\DTO\CountryDTO\UpdateCountryData;
use App\Http\Controllers\Controller;

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
        return $gateway->paginate(20)->all();
    }
    public function edit($country_id)
    {
        $country = (new CountryGateway)->edit($country_id);
        return $country;
    }
    public function show($country_id)
    {
        $country = (new CountryGateway)->show($country_id);
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
        $country = (new CountryAction)->delete($country_id);
        return $country;
    }
}
