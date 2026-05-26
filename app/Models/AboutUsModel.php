<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsModel extends Model
{
    //
    public $table = 'aboutus';
    public $fillable = ['heading', 'description', 'YOE','PMC','image1','image2','image3','image4'];
}
