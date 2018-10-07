<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttibuteOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attribute_id');
            $table->string('option_value');
            $table->unsignedInteger('option_sequence')->default(0);
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_options');
    }
}
