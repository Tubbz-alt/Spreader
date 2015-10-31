<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispatchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type', false, true)->default(0);
            $table->integer('project_id', false, true);
            $table->integer('activity_id', false, true);
            $table->integer('task_id', false, true);
            $table->string('request_uri');
            $table->string('remote_addr');
            $table->smallInteger('remote_port');
            $table->string('user_agent');
            $table->decimal('lng', 7, 2);
            $table->decimal('lat', 7, 2);
            $table->timestamp('created_at');
        });

        Schema::create('prequest_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id', false, true);
            $table->integer('activity_id', false, true);
            $table->integer('task_id', false, true);
            $table->integer('term_id', false, true);
            $table->integer('amigo_id', false, true);
            $table->string('request_udid', 32);
            $table->timestamp('requested_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dispatch_logs');
        Schema::drop('prequest_logs');
    }
}
