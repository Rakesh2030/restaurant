<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    public $table= 'contact';
    public $fillable = ['street','phone','email'];
}
