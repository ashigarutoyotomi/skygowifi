<?php

namespace App\Domains\Country\Actions;
use App\Domains\Country\Models\Country;
use App\Domains\Country\DTO\CountryDTO\CreateCountryData;
use App\Domains\Country\DTO\CountryDTO\UpdateCountryData;

class CountryAction
{
    /**
     * create user
     * @param CreateUserData $data
     * @return mixed
     */
    public function create(CreateCountryData $data)
    {
        return Country::create([
            'name' => $data->name
        ]);
    }

    public function update(UpdateCountryData $data)
    {
        $country = Country::find($data->id);
        abort_unless((bool)$country, 404, 'Country not found');

        $country->name = $data->name;
        $country->save();

        return $country;
    }
}
