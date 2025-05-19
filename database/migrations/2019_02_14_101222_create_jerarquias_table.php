<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJerarquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hierarchies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name_ES')->unique();
            $table->string('Name_EN')->unique();
            $table->integer('Level')->unique();
            $table->boolean('Active');
            $table->string('Slug');
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
        Schema::dropIfExists('hierarchies');
    }
}
