<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentPropertyIterationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_property_iterations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rent_property_id')
                ->constrained('rent_properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type');
            $table->integer('bank_id')->nullable();
            $table->string('date')->nullable();
            $table->double('amount')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('rent_property_iterations');
    }
}
