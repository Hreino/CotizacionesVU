<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->date('fechaNac')->default('2000-01-01');
            $table->string('direccion')->default('Ahuachapan');
            $table->string('email')->default('viajero123@gmail.com');
            $table->string('destino')->default('Desconocido');
            $table->string('aerolinea')->default('Desconocida');
            $table->string('telefono')->default('2413-2002');
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
        Schema::dropIfExists('clientes');
    }
}
