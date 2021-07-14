<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
            'customer_name',
            'customer_phone',
            'customer_email',
            'customer_previus_due',
            'customer_address',
            'customer_status',
    ];
}
