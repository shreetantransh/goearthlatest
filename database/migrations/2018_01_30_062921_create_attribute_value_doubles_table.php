<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValueDoublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_value_double', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_attribute_id');
            $table->double('value')->nullable();
            $table->timestamps();

            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_value_double');
    }
}
