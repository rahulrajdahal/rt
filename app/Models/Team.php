<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'hidden',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'email',
        'number',
        'photo',
    ];
}
