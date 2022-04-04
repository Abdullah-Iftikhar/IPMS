<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSomeColumnProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('marla');
            $table->string('plot_no')->nullable()->change();
            $table->string('block')->nullable()->change();
            $table->string('phase')->nullable()->change();
            $table->string('plot_type')->nullable()->change();
            $table->string('property_type')->nullable()->change();
            $table->string('property_for')->nullable()->change();
            $table->string('area')->nullable();
            $table->integer('area_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('marla');
            $table->string('plot_no');
            $table->string('block');
            $table->string('phase');
            $table->string('plot_type');
            $table->string('property_type');
            $table->string('property_for');
            $table->dropColumn('area');
            $table->dropColumn('area_size');
        });
    }
}
