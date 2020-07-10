<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'name',
        'about',
        'tagline',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'location',
        'email',
        'phone',
    ];
}
