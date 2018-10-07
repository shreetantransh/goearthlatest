<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrosssellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cross_sells', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('related_product_id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('related_product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cross_sells');
    }
}
