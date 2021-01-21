<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasreservaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vagasreserva', function(Blueprint $table)
		{
			$table->increments('id', true);
			$table->date('data_reserva');
			$table->integer('id_empresa')->unsigned()->index('vagasreservaFKIndex01');
			$table->foreign('id_empresa')->references('idempresa')->on('empresa');
			$table->string('colaborador', 100);
			$table->string('email', 50);
			$table->integer('id_usuario')->unsigned()->index('vagasreservaFKIndex02');
			$table->foreign('id_usuario')->references('idusuario')->on('usuario');
			$table->string('placa', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vagasreserva');
	}

}
