<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('customer_id');
            $table->unsignedTinyInteger('rating');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('SET NULL');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
