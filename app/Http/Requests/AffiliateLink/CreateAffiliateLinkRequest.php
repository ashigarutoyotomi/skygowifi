<?php

namespace App\Http\Requests\AffiliateLink;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateAffiliateLinkRequest extends FormRequest
{
    /**
     * Determine if the Affiliate is authorized to make this request.
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
            'affiliate_id' => 'required|integer',
        ];
    }
}
