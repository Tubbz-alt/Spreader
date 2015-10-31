<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispatchLog extends Model
{
    public $timestamps = false;

    public $fillable = ['project_id', 'activity_id', 'task_id', 'request_uri', 'remote_addr', 'remote_port', 'user_agent', 'created_at'];
}
