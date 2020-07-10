<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'uuid',
        'path',
    ];

    public function project() {
        return $this->belongsTo('App\Models\Project', 'uuid', 'uuid');
    }
}
