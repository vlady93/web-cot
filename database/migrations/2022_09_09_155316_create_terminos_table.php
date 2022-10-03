<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->String('nombre');
            $table->decimal('merma');
            $table->decimal('valorag');
            $table->decimal('porcentag');
            $table->decimal('maquila');
            $table->decimal('base');
            $table->decimal('refincaion')->nullable();
            $table->decimal('escalador');
            $table->decimal('flete');
            $table->decimal('rollback');
            $table->decimal('minimoag');
            $table->decimal('comibol')->nullable();
            $table->decimal('fedecomin')->nullable();
            $table->decimal('fencomin')->nullable();
            $table->decimal('remesa');
            
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
        Schema::dropIfExists('terminos');
    }
}
