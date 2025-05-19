<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Count')->nullable();
            $table->string('Clabe_bank')->nullable();
            $table->Integer('Bank_id')->unsigned()->nullable();
            $table->Integer('Employee_id')->unsigned();

            $table->foreign('Bank_id')->references('id')->on('banks');
            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('bank_datas');
    }
}
