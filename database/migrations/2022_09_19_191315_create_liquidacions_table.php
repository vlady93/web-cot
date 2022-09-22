<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidacion_detalles_id');
            $table->foreign('liquidacion_detalles_id')->references('id')->on('liquidacion_detalles');
            $table->String('lote');                                        
            $table->decimal('cot_ag');                                      
            $table->decimal('cot_pb');
            $table->decimal('tmh');                                      
            $table->decimal('humedad');
            $table->decimal('smc_ag');
            $table->decimal('smc_pb');                                          
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
        Schema::dropIfExists('liquidacions');
    }
}
