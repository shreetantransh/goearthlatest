<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('gender');
            $table->string('mobile', 50);
            $table->string('address', 2000);
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();

            $table->string('country', 100)->nullable();
            $table->string('pincode', 20);
            $table->boolean('is_default')->default(false);

            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
