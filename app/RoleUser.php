<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //
    public $table = 'role_users';

    protected $fillable = [
        'role_id',
        'user_id'
    ];
}
