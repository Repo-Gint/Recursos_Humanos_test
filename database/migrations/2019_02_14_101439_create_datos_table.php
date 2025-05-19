<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->increments('id');
            $table->String('Gender')->nullable();
            $table->date('Birthdate')->nullable();
            $table->string('Nss')->nullable();
            $table->String('Rfc')->nullable();
            $table->String('Curp')->nullable();
            $table->String('Credential')->nullable();
            $table->String('Blood')->nullable();
            $table->String('Allergy')->nullable();
            $table->Integer('Marital_status_id')->unsigned();
            $table->integer('Children')->nullable();
            $table->String('Infonavit')->nullable();
            $table->String('Fonacot')->nullable();
            $table->Integer('Scholarchip_id')->unsigned();
            $table->Integer('Voucher_id')->unsigned();
            $table->String('Tows')->nullable();
            $table->String('Municipality')->nullable();
            $table->String('State')->nullable();
            $table->Integer('Country_id')->unsigned();
            $table->Integer('Employee_id')->unsigned();

            $table->foreign('Marital_status_id')->references('id')->on('marital_status');
            $table->foreign('Scholarchip_id')->references('id')->on('scholarships');
            $table->foreign('Voucher_id')->references('id')->on('vouchers');
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
        Schema::dropIfExists('datas');
    }
}
