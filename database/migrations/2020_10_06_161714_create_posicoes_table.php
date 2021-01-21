<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosicoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posicoes', function(Blueprint $table)
		{
			$table->increments('idposicoes');
			$table->integer('empresa_idempresa')->unsigned()->index('posicoes_FKIndex1');
			$table->foreign('empresa_idempresa')->references('idempresa')->on('empresa');
			$table->string('nome_posicao', 100)->nullable();
			$table->string('area', 100)->nullable();
			$table->string('gerente', 100)->nullable();
			$table->string('diretoria', 100)->nullable();
			$table->string('predio', 100)->nullable();
			$table->string('andar', 10)->nullable();
			$table->integer('bancada')->unsigned()->nullable();
			$table->integer('posicao')->unsigned()->nullable();
			$table->string('liberada', 10)->nullable();
			$table->string('tipo', 10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posicoes');
	}

}
