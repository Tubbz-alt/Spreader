<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::create('terms', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('term_taxonomy_id', false, true)->foreign('term_taxonomies', 'id');
            $table->string('name'); 
            $table->text('remark'); 
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
        Schema::drop('term_taxonomies');
        Schema::drop('terms');
    }
}
