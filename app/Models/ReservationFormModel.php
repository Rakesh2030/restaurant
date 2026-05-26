<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationFormModel extends Model
{
    //
    public $table = 'reservationform';
    public $fillable = ['name','email','phone','date','time','guests','datetime','people','message','status'];
}
