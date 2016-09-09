<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenarmsSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openarms_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start_timestamp');
            $table->timestamp('end_timestamp')->nullable();
            $table->integer('started_by_user_id')->unsigned()->index();
            $table->integer('ended_by_user_id')->unsigned()->nullable()->index();
            $table->foreign('started_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ended_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('openarms_sessions');
    }
}
