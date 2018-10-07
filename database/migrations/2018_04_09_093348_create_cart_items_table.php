<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('product_id');
            $table->unsignedSmallInteger('qty');
            $table->text('options');
            $table->timestamps();

            $table->foreign('cart_id')->references('id')
                ->on('carts')
                ->onDelete('CASCADE');

            $table->foreign('product_id')->references('id')
                ->on('products')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
