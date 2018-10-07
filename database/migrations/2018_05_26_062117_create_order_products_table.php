<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('product_id');
            $table->double('price');
            $table->double('quantity');
            $table->string('options')->nullable();
            $table->double('sub_total');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
