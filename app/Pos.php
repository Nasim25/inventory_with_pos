<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_qty',
        'product_price',
        'sub_total',
    ];

    
}
