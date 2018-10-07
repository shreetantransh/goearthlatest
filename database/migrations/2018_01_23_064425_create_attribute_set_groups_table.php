<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSetGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_set_groups', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('attribute_set_id');
            $table->string('name');
            $table->timestamps();

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
        Schema::dropIfExists('attribute_set_groups');
    }
}
