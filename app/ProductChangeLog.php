<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductChangeLog extends Model
{
    //
    public $table = 'product_update_logs';

    protected $fillable = [
        'product_id',
        'user_id',
        'product_name',
        'price'
    ];
}
