<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public static $types = [1 => '派单', 2 => '扫码送礼'];
    public static $status = ['待定（谈判中）', '开始', '暂停', '取消', '结束'];

    function activities() {
        return $this->hasMany('App\Activity');
    }

    function tasks() {
        return $this->hasManyThrough('App\Task', 'App\Activity');
    }
}
