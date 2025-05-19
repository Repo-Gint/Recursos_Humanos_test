<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Personal_mail')->unique()->nullable();
            $table->string('Business_mail')->nullable();
            $table->string('Personal_phone')->unique()->nullable();
            $table->string('Business_phone')->nullable();
            $table->string('Landline')->unique()->nullable();
            $table->integer('Extension')->nullable();
            $table->string('Family')->nullable();
            $table->Integer('Relationship_id')->unsigned()->nullable();
            $table->string('Emergency_phone')->nullable();
            $table->Integer('Employee_id')->unsigned();

            $table->foreign('Relationship_id')->references('id')->on('relationships');
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
        Schema::dropIfExists('contacts');
    }
}
