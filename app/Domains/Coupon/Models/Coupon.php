<?php

namespace App\Domains\Coupon\Models;
use Illuminate\Database\Eloquent\Model;
use App\Domains\City\Models\User;
class Coupon extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dealer_id',
        'flat_amount_off',
        'percentage_off',
    ];

    public function dealer(){
        return $this->belongsTo(User::class,"dealer_id");
    }
}
