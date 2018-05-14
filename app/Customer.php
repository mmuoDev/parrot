<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'customer_name',
        'location_id',
        'created_by',
        'phone_number',
        'last_purchase'
    ];
}
