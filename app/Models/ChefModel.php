<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChefModel extends Model
{
    //
    public $table = 'chef';
    public $fillable = ['name','designation','image'];
}
