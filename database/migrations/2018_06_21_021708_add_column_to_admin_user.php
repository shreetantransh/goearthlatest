<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->string('contact_number')->nullable();
            $table->string('contact_number_other')->nullable();
            $table->string('address')->nullable();
            $table->string('address_other')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linked_in')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
        });
    }
}
