<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Code');
            $table->string('Names');
            $table->string('Paternal');
            $table->string('Maternal');
            $table->string('Photo');
            $table->integer('Active');
            $table->Integer('Parent_id')->unsigned()->nullable();
            $table->Integer('Output_id')->unsigned()->nullable();
            $table->string('Slug');
            $table->Integer('Company_id')->unsigned();

            $table->foreign('Parent_id')->references('id')->on('employees');
            $table->foreign('Output_id')->references('id')->on('outputs');
            $table->foreign('Company_id')->references('id')->on('companies');
            $table->timestamps();
        });

        Schema::create('employee_position', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Position_id')->unsigned();

            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Position_id')->references('id')->on('positions');
            $table->timestamps();
        });

        Schema::create('employee_position_history', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Start_date');
            $table->date('Ending_date')->nullable();
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Position_id')->unsigned();

            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Position_id')->references('id')->on('positions');
            $table->timestamps();
        });

        Schema::create('employee_typeemployee', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Typeemployee_id')->unsigned();

            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Typeemployee_id')->references('id')->on('type_employees');
            $table->timestamps();
        });

        Schema::create('employee_typeemployee_history', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Start_date');
            $table->date('Ending_date')->nullable();
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Typeemployee_id')->unsigned();

            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Typeemployee_id')->references('id')->on('type_employees');
            $table->timestamps();
        });

        Schema::create('employee_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Success')->nullable();
            $table->Integer('Employee_id')->unsigned();
            $table->Integer('Document_id')->unsigned();

            $table->foreign('Employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('Document_id')->references('id')->on('documents');
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
        Schema::dropIfExists('employee_position');
        Schema::dropIfExists('employee_position_history');
        Schema::dropIfExists('employee_typeemployee');
        Schema::dropIfExists('employee_typeemployee_history');
        Schema::dropIfExists('employee_document');
        Schema::dropIfExists('employees');
             
    }
}
