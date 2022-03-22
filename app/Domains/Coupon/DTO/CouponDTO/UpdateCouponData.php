<?php

namespace App\Domains\Coupon\DTO\CouponDTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCouponData extends DataTransferObject
{
    public int $flat_amount_off;
    public int $dealer_id;
    public ?int $percentage_off;
    public int $coupon_id;
    public static function fromRequest(UpdateCouponRequest $request, $coupon_id): UpdateCouponData
    {
        $data = [
            'percentage_off' => (int)$request->percentage_off,
            'dealer_id' => (int)$request->dealer_id,
            'flat_amount_off' => (int)$request->flat_amount_off,
            'coupon_id' => (int)$coupon_id
        ];

        return new self($data);
    }
}
