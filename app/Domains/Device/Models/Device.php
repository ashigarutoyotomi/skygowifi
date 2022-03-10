<?php

namespace App\Domains\Device\Models;
use App\Domains\Address\Models\Address;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id','creator_id','serial_number'
    ];
    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }
    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
}
