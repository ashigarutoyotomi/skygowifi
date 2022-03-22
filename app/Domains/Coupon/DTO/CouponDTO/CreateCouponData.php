<?php

namespace App\Domains\Coupon\DTO\CouponDTO;
use App\Domains\Coupon\DTO\CouponDTO\CreateCouponRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateCouponData extends DataTransferObject
{
    public int $flat_amount_off;
    public ?int $dealer_id;
    public int $percentage_off;
    public static function fromRequest(CreateCouponRequest $request): CreateCouponData
    {
        $data = [
            'percentage_off' => (int)$request->percentage_off,
            'dealer_id' => $request->dealer_id? (int)$request->dealer_id:null,
            'flat_amount_off' => (int)$request->flat_amount_off,
        ];

        return new self($data);
    }
}
