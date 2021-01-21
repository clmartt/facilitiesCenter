<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('idreservas');
			$table->integer('posicoes_idposicoes')->unsigned()->index('reservas_FKIndex3');
			$table->foreign('posicoes_idposicoes')->references('idposicoes')->on('posicoes');
			$table->integer('usuario_idusuario')->unsigned()->index('reservas_FKIndex2');
			$table->foreign('usuario_idusuario')->references('idusuario')->on('usuario');
			$table->integer('empresa_idempresa')->unsigned()->index('reservas_FKIndex1');
			$table->foreign('empresa_idempresa')->references('idempresa')->on('empresa');
			$table->date('data_reserva')->nullable();
			$table->time('hora_reserva')->nullable();
			$table->string('nome_posicao', 100)->nullable();
			$table->string('area', 100)->nullable();
			$table->string('gerente', 100)->nullable();
			$table->string('diretoria', 100)->nullable();
			$table->string('checado', 10)->nullable();
			$table->time('hora_check', 6);
			$table->time('hora_inicio', 6);
			$table->time('hora_fim', 6);
			$table->string('tipo', 10);
			$table->string('hashreserva', 100)->comment('guarda um has da reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
