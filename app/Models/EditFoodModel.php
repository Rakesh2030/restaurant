<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditFoodModel extends Model
{
    //
    public $table = 'editfood';
    public $fillable = [
        'head',
        'desc',
        'price',
        'discount_price',
        'ingredients',
        'category',
        'image',
        'status',
        'featured',
        'popular',
    ];
}
