<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->increments('idusuario');
			$table->integer('empresa_idempresa')->unsigned()->index('usuario_FKIndex1');
			$table->foreign('empresa_idempresa')->references('idempresa')->on('empresa');
			$table->string('nome_usuario', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('senha', 50)->nullable();
			$table->string('perfil', 50)->nullable();
			$table->string('area', 100)->nullable();
			$table->string('gestor', 100)->nullable();
			$table->integer('garagem');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
