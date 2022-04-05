<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnsRentProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_properties', function (Blueprint $table) {
            $table->float('commission')->nullable()->change();
            $table->string('phone_number');
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_properties', function (Blueprint $table) {
            $table->double('commission');
            $table->dropColumn('phone_number');
            $table->dropColumn('remarks');
        });
    }
}
