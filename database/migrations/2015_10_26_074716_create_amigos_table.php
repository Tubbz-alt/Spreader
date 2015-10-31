<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->string('mobile_phone');
            $table->string('qq');
            $table->string('wechat');
            $table->string('alipay');
            $table->tinyinteger('status', false, true)->default(1);
            $table->tinyinteger('grade', false, true)->default(0);
            $table->tinyinteger('experience', false, true)->default(0);
            $table->tinyinteger('responsibility', false, true)->default(0);
            $table->tinyinteger('skill', false, true)->default(0);
            $table->text('evaluate');
            $table->timestamp('joined_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amigos');
    }
}
