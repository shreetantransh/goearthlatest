<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('session_id', 60);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->index([
                'session_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
