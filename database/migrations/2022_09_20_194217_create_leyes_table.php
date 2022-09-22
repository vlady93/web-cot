<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeyesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leyes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidacion_id');
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
            $table->unsignedBigInteger('elemento_id');
            $table->foreign('elemento_id')->references('id')->on('elementos');
            $table->decimal('valor');
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
        Schema::dropIfExists('leyes');
    }
}
