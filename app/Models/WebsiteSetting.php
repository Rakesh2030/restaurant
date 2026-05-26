<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'footer_text',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
    ];
}
