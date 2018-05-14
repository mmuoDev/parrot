<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseLog extends Model
{
    //
    public $table = 'purchase_logs';

    protected $fillable = [
        'customer_id'
    ];
}
