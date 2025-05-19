<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Departament_ES')->unique();
            $table->string('Departament_EN')->unique();
            $table->string('Acronym')->unique();
            $table->boolean('Active');
            $table->string('Slug');
            $table->Integer('Parent_id')->unsigned()->nullable();

            $table->foreign('Parent_id')->references('id')->on('departaments');
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
        Schema::dropIfExists('departaments');
    }
}
