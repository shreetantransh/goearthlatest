<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttributeSetGroupAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_attribute_set_group', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('attribute_set_id');
            $table->unsignedInteger('attribute_set_group_id');
            $table->unsignedInteger('attribute_id');

            $table->foreign('attribute_set_group_id')->references('id')->on('attribute_set_groups')->onDelete('CASCADE');
            $table->foreign('attribute_set_id')->references('id')->on('attribute_sets')->onDelete('CASCADE');
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
        Schema::dropIfExists('attribute_attribute_set_group');
    }
}
