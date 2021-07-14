<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'invoice_number',
        'date',
        'supplier_id',
        'other',
        'g_total',
        'due',
        'payment_method',
    ];
}
