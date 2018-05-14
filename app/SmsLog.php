<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    //
    public $table = 'sms_logs';

    protected $fillable = [
        'user_id',
        'success',
        'failed',
        'category_id',
        'message'
    ];
}
