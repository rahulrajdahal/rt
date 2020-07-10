<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'project_id',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'entry_fee',
        'photo',
    ];

    public function project() {
        return $this->belongsTo('App\Models\Project');
    }
}
