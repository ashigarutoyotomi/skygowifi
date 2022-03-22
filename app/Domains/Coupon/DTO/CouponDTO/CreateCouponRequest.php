<?php

namespace App\Domains\Coupon\DTO\CouponDTO;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dealer_id'=>'nullable|integer',
            'flat_amount_off'=>'required|integer',
            'percentage_off'=>'required|integer'
        ];
    }
}
