<?php

namespace App\Domains\Affiliates\Models;

use Illuminate\Database\Eloquent\Model;
class AffiliateLink extends Model
{

    /**
     * the attributes are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'affiliate_id',
        'status'
    ];
    const STATUS_NEW = 1;
    const STATUS_FINISHED = 2;
}
