<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $appends = ['full_address'];

    public function getFullAddressAttribute()
    {
        return $this->street . ', '. $this->postcode. ', '. $this->city. ', '. $this->state;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}
