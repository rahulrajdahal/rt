<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsMedia extends Model
{
    protected $fillable = [
        'name',
        'project_date',
        'location',
        'featured',
        'project_id',
        'body',
        'hidden',
        'uuid',
    ];

    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery', 'uuid', 'uuid');
    }

    public function projectYear()
    {
        return $this->belongsTo('App\Models\Projectyear', 'projectyear_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
