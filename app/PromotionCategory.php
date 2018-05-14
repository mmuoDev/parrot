<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionCategory extends Model
{
    //
    public $table = 'promotion_categories';

    protected $fillable = [
        'category'
    ];
}
