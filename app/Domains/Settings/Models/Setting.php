<?php

namespace App\Domains\Settings\Models;

use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{

    /**
     * the attributes are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'title'
    ];
    const TYPE_NUMBER = 2;
    const TYPE_BOOLEAN = 1;

    const LINK_EXPIRY = "affiliate_link_expiry_time";
    const LINK_SALE = 'affiliate_link_sale_commission';
}
