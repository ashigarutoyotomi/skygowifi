<?php

namespace App\Http\Controllers\Coupon;
use App\Domains\Coupon\Actions\CouponAction;
use App\Domains\Coupon\DTO\CouponDTO\CreateCouponData;
use App\Domains\Coupon\DTO\CouponDTO\UpdateCouponRequest;
use App\Domains\Coupon\Gateways\CouponGateway;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\Coupon\DTO\CouponDTO\CreateCouponRequest;
use Illuminate\Http\Request;
use App\Domains\Coupon\DTO\CouponDTO\UpdateCouponData;
use App\Http\Controllers\Controller;
class CouponsController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new CouponGateway();
        
        $filters = json_decode($request->get('filters'),true);
        if(!empty($filters)){
                $gateway->setFilters($filters);
        }        
        ;
        return $gateway->paginate(20)->all();
    }
    public function edit($coupon_id)
    {
        $coupon = (new CouponGateway)->with(['dealer'])->edit($coupon_id);
        return $coupon;
    }
    public function show($coupon_id)
    {
        $coupon = (new CouponGateway)->with(['dealer'])->edit($coupon_id);
        return $coupon;
    }
    public function store(CreateCouponRequest $request)
    {
        $data = CreateCouponData::fromRequest($request);

        return (new CouponAction)->create($data);
    }
    public function update(UpdateCouponRequest $request, $coupon_id)
    {
        $data = UpdateCouponData::fromRequest($request,$coupon_id);
        
        return (new CouponAction)->update($data);;
    }
    public function delete($coupon_id)
    {
        $Coupon = (new CouponAction)->delete($coupon_id);        
        return $Coupon;
    }
}
