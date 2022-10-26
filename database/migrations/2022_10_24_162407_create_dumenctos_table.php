<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDumenctosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dumenctos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidacion_id');
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');

            $table->string('url');
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
        Schema::dropIfExists('dumenctos');
    }
}