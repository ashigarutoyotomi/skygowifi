<?php

namespace App\Domains\Coupon\Actions;

use App\Domains\Coupon\DTO\CouponDTO\CreateCouponData;
use App\Domains\Coupon\DTO\CouponDTO\UpdateCouponData;
use App\Domains\Coupon\Models\Coupon;
class CouponAction
{
    /**
     * create user
     * @param CreateCouponData $data
     * @return mixed
     */
    public function create(CreateCouponData $data)
    {
        return Coupon::create([
            'dealer_id' => $data->dealer_id,
            'flat_amount_off' => $data->flat_amount_off,
            'percentage_off' => $data->percentage_off,
        ]);
    }

    public function update(UpdateCouponData $data)
    {
        $coupon = Coupon::find($data->coupon_id);
        abort_unless((bool)$coupon, 404, 'Coupon not found');

        $coupon->flat_amount_off = $data->flat_amount_off;
        if(!empty($data->dealer_id)){
            $coupon->dealer_id = $data->dealer_id;
        
        }
        $coupon->flat_amount_off= $data->flat_amount_off;
        $coupon->save();

        return $coupon;
    }
    public function delete($coupon_id){
        $coupon = Coupon::find($coupon_id);
        abort_unless((bool) $coupon, 404, 'Coupon not found');   
        $coupon->delete();     
        return $coupon;
    }
}
