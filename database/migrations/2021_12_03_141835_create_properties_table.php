<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('society');
            $table->string('plot_no')->nullable()->change();
            $table->string('block')->nullable()->change();
            $table->string('phase')->nullable()->change();
            $table->string('plot_type')->nullable()->change();
            $table->string('property_type')->nullable()->change();
            $table->string('property_for')->nullable()->change();
            $table->string('area')->nullable();
            $table->integer('area_size')->nullable();
            $table->double('rate');
            $table->string('owner_name')->nullable();
            $table->string('owner_number')->nullable();
            $table->string('id_card')->nullable();
            $table->string('status')
                ->default('active')
                ->comment('active, sold, rent, construct');
            $table->timestamps();

            //Column Index
            $table->index('society');
            $table->index('plot_no');
            $table->index('block');
            $table->index('phase');
            $table->index('plot_type');
            $table->index('property_type');
            $table->index('area');
            $table->index('area_size');
            $table->index('rate');
            $table->index('property_for');
            $table->index('owner_name');
            $table->index('owner_number');
            $table->index('id_card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
