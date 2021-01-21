<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_salas', function (Blueprint $table) {
            $table->increments('id_reserva', true);
			$table->integer('id_horario')->unsigned()->index('reserva_sala_FKIndex01');
			$table->foreign('id_horario')->references('id_horario')->on('horario');
			$table->integer('id_sala');
			$table->integer('id_usuario')->unsigned()->index('reserva_sala_FKIndex02');
			$table->foreign('id_usuario')->references('idusuario')->on('usuario');
			$table->integer('id_empresa')->unsigned()->index('reserva_sala_FKIndex03');
			$table->foreign('id_empresa')->references('idempresa')->on('empresa');
			$table->string('nome_usuario', 50);
			$table->string('assunto', 100);
			$table->date('data_reserva');
			$table->string('hashreserva', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_salas');
    }
}
