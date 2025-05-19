<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Code')->nullable()->unique();
            $table->string('Position_ES');
            $table->string('Position_EN');
            $table->text('Descripcion')->nullable();
            $table->text('Responsability')->nullable();
            $table->Integer('Vacancies')->nullable();
            $table->boolean('Active')->nullable();
            $table->string('Slug');
            $table->Integer('Parent_id')->unsigned()->nullable();
            $table->Integer('Hierarchy_id')->unsigned();
            $table->Integer('Departament_id')->unsigned();

            $table->foreign('Parent_id')->references('id')->on('positions');
            $table->foreign('Hierarchy_id')->references('id')->on('hierarchies');
            $table->foreign('Departament_id')->references('id')->on('departaments');
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
        Schema::dropIfExists('positions');
    }
}
