<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->String('Acronym');
            $table->String('Name');
            $table->String('Address')->nullable();
            $table->String('Phone')->nullable();
            $table->String('Slug');
            $table->String('State')->nullable();
            $table->String('Municipality')->nullable();
            $table->String('Tows')->nullable();
            $table->Integer('Country_id')->unsigned();

            $table->foreign('Country_id')->references('id')->on('countries');


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
        Schema::dropIfExists('companies');
    }
}
