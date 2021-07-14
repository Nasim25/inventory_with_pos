<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VertualPurchase extends Model
{
    protected $fillable = [

        'product_id',
        'unit_price',
        'qty',
        'total',
        'user_id',
    ];
}
