<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBajaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_output', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Output_id')->unsigned();
            $table->Date('output_date');
            $table->Text('reason_for_dismissal')->nullable();
                
            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Output_id')->references('id')->on('outputs');

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
        Schema::dropIfExists('employee_output');
    }
}
