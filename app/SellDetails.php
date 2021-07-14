<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellDetails extends Model
{
    protected $fillable = [
            'order_id',
            'product_id',
            'product_qty',
            'product_price',
            'sub_total',
    ];
}
