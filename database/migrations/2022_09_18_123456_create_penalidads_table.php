<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenalidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidacion_detalles_id');
            $table->foreign('liquidacion_detalles_id')->references('id')->on('liquidacion_detalles');
            $table->unsignedBigInteger('elemento_id');
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->decimal('libre');
            $table->decimal('costo');
            $table->decimal('fraccion');
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
        Schema::dropIfExists('penalidads');
    }
}
