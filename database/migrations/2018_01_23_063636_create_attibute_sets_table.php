<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttibuteSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('attribute_set_id')->references('id')->on('attribute_sets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_sets');
    }
}
