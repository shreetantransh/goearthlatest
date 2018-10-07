<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {

            $table->unsignedInteger('city_id')->after('landmark')->nullable();
            $table->unsignedInteger('state_id')->after('landmark')->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');

            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {

        });
    }
}
