<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('property_id')
                ->constrained('properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('id_card');
            $table->string('phone_number')->nullable();
            $table->double('amount');
            $table->double('commission')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(0)->comment("0=in progress, 1=completed");

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
        Schema::dropIfExists('sold_properties');
    }
}
