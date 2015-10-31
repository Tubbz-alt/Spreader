<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id', false, true);
            $table->integer('type', false, true);
            $table->string('name');
            $table->string('promotion_link');
            $table->text('description');
            $table->text('remark');
            $table->tinyInteger('status', false, true);
            $table->integer('created_by', false, true);
            $table->timestamp('created_at');
            $table->integer('updated_by', false, true);
            $table->timestamp('updated_at');
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id', false, true)->foregin('activities', 'id');
            $table->date('deadline');
            $table->string('name');
            $table->text('description');
            $table->text('tasks_template');
            $table->tinyInteger('status', false, true);
            $table->timestamp('completed_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id', false, true)->foregin('activities', 'id');
            $table->integer('amigo_id', false, true);
            $table->string('amigo_name');
            $table->integer('term_id', false, true);
            $table->string('term_name');
            $table->integer('mission', false, true);
            $table->decimal('reward', 7, 2);
            $table->text('description');
            $table->text('logogram');
            $table->tinyInteger('status', false, true);
            $table->string('scene');
            $table->string('qrcode_url');
            $table->text('feedback');
            $table->text('feedbacked_at');
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
        Schema::drop('tasks');
        Schema::drop('activities');
        Schema::drop('projects');
    }
}
