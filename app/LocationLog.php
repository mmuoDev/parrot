<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationLog extends Model
{
    //
    public $table = 'location_logs';

    protected $fillable = [
        'location',
        'state_id',
        'location_id',
        'user_id',
    ];
}
