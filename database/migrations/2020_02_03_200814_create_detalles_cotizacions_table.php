<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('detalles');
            $table->string('equipaje');
            $table->unsignedInteger('id_cotizacions');
            $table->foreign('id_cotizacions')->references('id')->on('cotizacions');
            
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
        Schema::dropIfExists('detalles_cotizacions');
    }
}
