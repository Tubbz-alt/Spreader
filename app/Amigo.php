<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    protected $fillable = ['name', 'mobile_phone', 'qq', 'wechat', 'alipay', 'status', 'grade', 'experience', 'responsibility', 'skill', 'evaluate', 'joined_at'];
}
