<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['activity_id', 'amigo_id', 'amigo_name', 'term_id', 'term_name', 'mission', 'reward', 'description', 'logogram', 'status', 'scene', 'qrcode_url', 'feedback', 'feedbacked_at', 'created_at', 'updated_at'];

    function activity() {
        return $this->belongsTo('App\Activity');
    }
}
