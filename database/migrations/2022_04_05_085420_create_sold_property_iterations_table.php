<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldPropertyIterationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_property_iterations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sold_property_id')
                ->constrained('sold_properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type');
            $table->string('start_date')->nullable();
            $table->string('next_date')->nullable();
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
        Schema::dropIfExists('sold_property_iterations');
    }
}
