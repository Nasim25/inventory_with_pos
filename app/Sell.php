<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = [
            'customer',
            'qty',
            'subtotal',
            'vat',
            'total',
            'pay',
            'due',
            'payby',
            'sell_date',
            'user_id',
    ];

    
}
