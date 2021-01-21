<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vagas', function(Blueprint $table)
		{
			$table->increments('id', true);
			$table->integer('id_empresa')->unsigned()->index('vagasFKIndex01');
			$table->foreign('id_empresa')->references('idempresa')->on('empresa');
			$table->integer('qtd_vagas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vagas');
	}

}
