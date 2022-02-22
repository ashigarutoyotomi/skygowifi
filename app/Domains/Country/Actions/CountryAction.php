<?php

namespace App\Domains\User\Actions;

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
        return User::create([
            'name' => $data->name,
            'id' => $data->id
        ]);
    }

    public function update(UpdateCountryData $data)
    {
        $country = Country::find($data->id);
        abort_unless((bool)$country, 404, 'Country not found');

        $country->name = $data->name;
        $country->id = $data->id;
        $country->save();

        return $country;
    }
}
