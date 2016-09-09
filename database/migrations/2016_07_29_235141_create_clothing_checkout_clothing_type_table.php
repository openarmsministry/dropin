<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClothingCheckoutClothingTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clothing_checkout_clothing_type', function (Blueprint $table) {
            $table->integer('clothing_checkout_id')->unsigned()->index();
            $table->integer('clothing_type_id')->unsigned()->index();
            $table->integer('amount')->unsigned();
            $table->foreign('clothing_checkout_id')->references('id')->on('clothing_checkouts')->onDelete('cascade');
            $table->foreign('clothing_type_id')->references('id')->on('clothing_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clothing_checkout_clothing_type');
    }
}
