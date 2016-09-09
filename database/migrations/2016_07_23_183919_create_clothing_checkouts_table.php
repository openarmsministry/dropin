<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClothingCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clothing_checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendance_id')->unsigned()->index();
            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
            $table->timestamp('checkout_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clothing_checkouts');
    }
}
