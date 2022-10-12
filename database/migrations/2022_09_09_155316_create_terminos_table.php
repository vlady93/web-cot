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
            $table->decimal('valorag',12,8);
            $table->decimal('porcentag');
            $table->decimal('maquila');
            $table->decimal('base');
            $table->decimal('refincaion')->nullable();
            $table->decimal('escalador');
            $table->decimal('flete');
            $table->decimal('rollback');
            $table->decimal('minimoag');
            $table->decimal('comibol',8,4)->nullable();
            $table->decimal('fedecomin',8,4)->nullable();
            $table->decimal('fencomin',8,4)->nullable();
            $table->decimal('caja',8,4);
            $table->decimal('pagable');
            $table->decimal('remesa',8,4);
            
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
