<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('High_date');
            $table->date('Low_date')->nullable();
            $table->integer('Duration')->nullable();
            $table->date('Ending')->nullable();
            $table->date('Payment_date')->nullable();
            $table->Integer('Typecontract_id')->unsigned();
            $table->Integer('Employee_id')->unsigned();

            $table->foreign('Typecontract_id')->references('id')->on('type_contracts');
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
        Schema::dropIfExists('contracts');
    }
}
