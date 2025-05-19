<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomicilioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Address')->nullable();
            $table->integer('Postcode')->nullable();
            $table->String('Tows')->nullable();
            $table->String('Municipality')->nullable();
            $table->String('State')->nullable();
            $table->Integer('Country_id')->unsigned();
            $table->Integer('Employee_id')->unsigned();

            $table->foreign('Country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('domicile');
    }
}
