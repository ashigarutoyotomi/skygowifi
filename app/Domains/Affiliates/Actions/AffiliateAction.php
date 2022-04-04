<?php

namespace App\Domains\Affiliates\Actions;

use Illuminate\Support\Facades\Hash;
use App\Domains\Affiliates\DTO\AffiliateDTO\CreateAffiliateData;
use App\Domains\Affiliates\Models\Affiliate;
use App\Domains\Affiliates\DTO\AffiliateDTO\UpdateAffiliateData;

class AffiliateAction
{
    /**
     * create affiliate
     * @param CreateAffiliateData $data
     * @return mixed
     */
    public function create(CreateAffiliateData $data)
    {
        return Affiliate::create([
            'first_name' => $data->first_name,
            'email' => $data->email,
            'last_name' => $data->last_name,
            'password' => Hash::make($data->password),
        ]);
    }

    public function update(UpdateAffiliateData $data)
    {
        $affiliate = Affiliate::find($data->id);
        abort_unless((bool)$affiliate, 404, "Affiliate not found");

        $affiliate->first_name = $data->first_name;

        $affiliate->last_name = $data->last_name;
        
        $affiliate->email = $data->email;

        if (!empty($data->password)) {
            $affiliate->password= Hash::make($data->password);
        }
        $affiliate->save();
        return $affiliate;
    }
    public function delete($affiliate_id)
    {
        $affiliate = Affiliate::find($affiliate_id);
        abort_unless((bool)$affiliate, 404, 'Affiliate not found');
        $affiliate->delete();
        return $affiliate;
    }
    public function find($affiliate_id)
    {
        $affiliate = Affiliate::find($affiliate_id);
        return $affiliate;
    }
}
