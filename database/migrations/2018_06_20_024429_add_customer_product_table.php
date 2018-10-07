<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('ip')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('Set Null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_product');
    }
}
