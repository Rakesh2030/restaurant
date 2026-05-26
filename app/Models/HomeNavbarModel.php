<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeNavbarModel extends Model
{
    //
    public $table = 'homenavbar';
    public $fillable = ['heading','description','image'];
}
