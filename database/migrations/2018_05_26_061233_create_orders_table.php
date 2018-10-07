<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('order_id')->nullable()->unique();
            $table->string('transaction_id')->nullable();
            $table->double('sub_total');
            $table->double('tax')->nullable();
            $table->double('discount')->nullable();
            $table->double('total');
            $table->string('payment_mode');
            $table->boolean('is_complete')->default(0);
            $table->boolean('is_paid')->default(0);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
