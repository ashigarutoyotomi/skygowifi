<?php

namespace App\Http\Requests;

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
            'percentage_off'=>'required|integer'
            ,
            'dealer_id'=>'nullable|integer',
            'flat_amount_off'=>'integer|integer',
        ];                                                                                                                                  
    }
    public function messages (){
        return [
            'address_id.required'=>'Address id cannot be null',
            'serial_number.required'=>'serial number needed',
        ];
    }
}
