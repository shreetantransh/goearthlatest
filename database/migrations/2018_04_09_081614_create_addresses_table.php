<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile', 50);
            $table->string('address', 2000);
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100)->nullable();
            $table->string('pincode', 20);
            $table->boolean('is_default')->default(false);

            $table->timestamps();

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
        Schema::dropIfExists('addresses');
    }
}
