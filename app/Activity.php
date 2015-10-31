<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    function project() {
        return $this->belongsTo('App\Project');
    }

    function tasks() {
        return $this->hasMany('App\Task');
    }
}
