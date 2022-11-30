<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = ['order_date',''];
    protected $casts = [
        'order_date' => 'datetime'
    ];

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class);
    }
}
