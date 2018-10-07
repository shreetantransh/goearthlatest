<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttibutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('code');
            $table->string('type', 20);
            $table->boolean('is_unique');
            $table->boolean('is_required');
            $table->boolean('is_comparable');
            $table->boolean('is_searchable');
            $table->boolean('used_in_product_listing');
            $table->boolean('used_in_product_detail');
            $table->boolean('used_in_product_sorting');
            $table->unsignedInteger('sequence')->default(0);
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
        Schema::dropIfExists('attributes');
    }
}
