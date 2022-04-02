<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('construct_property_id')
                ->constrained('construct_properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('material_id')
                ->constrained('materials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('price');
            $table->text('desc');
            $table->timestamps();

            $table->index('material_id');
            $table->index('construct_property_id');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_materials');
    }
}
