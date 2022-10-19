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
            $table->decimal('cot_ag',8,4);                                      
            $table->decimal('cot_pb',8,4);
            $table->decimal('tmh');                                      
            $table->decimal('humedad');
            $table->decimal('smc_ag',8,4);
            $table->decimal('smc_pb',8,4);
            $table->dateTime('fecha');
            $table->dateTime('fecha_entrega');
            $table->String('observacion')->nullable();
            $table->String('glosario')->nullable();
            $table->decimal('valoradicional')->nullable();                                          
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
