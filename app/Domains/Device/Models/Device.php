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
        'id','address_id','creator_id','serial_number'
    ];
    public function user(){
        return $this->belongsTo(User::class,'id');
    }
    public function address(){
        return $this->belongsTo(Address::class,'id');
    }
}
