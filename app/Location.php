<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    public $table = 'locations';

    protected $fillable = [
        'state_id',
        'location'
    ];
}
