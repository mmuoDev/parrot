<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'product',
        'price',
        'quantity',
        'total',
        'customer_id',
        'created_by',
        'purchase_log_id'
    ];
}
