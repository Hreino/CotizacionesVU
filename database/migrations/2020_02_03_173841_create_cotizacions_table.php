<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('fecha');
            $table->string('asesor');

            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            
            $table->unsignedInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->string('proveedor');
            $table->string('medio');
            $table->string('status');
            $table->string('posventa')->default('No finalizado');
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
        Schema::dropIfExists('cotizacions');
    }
}
