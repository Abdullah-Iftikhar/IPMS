<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('bank_id')
                ->constrained('banks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('acc_title');
            $table->string('acc_number');
            $table->double('amount');
            $table->double('transaction')->nullable();
            $table->integer('property_id')->nullable();
            $table->string('status')->default('active')->comment('active, inactive');
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
        Schema::dropIfExists('bank_accounts');
    }
}
