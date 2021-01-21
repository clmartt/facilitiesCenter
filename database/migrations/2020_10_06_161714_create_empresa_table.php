<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa', function(Blueprint $table)
		{
			$table->increments('idempresa');
			$table->string('nome_empresa', 100)->nullable();
			$table->string('endereco', 100)->nullable();
			$table->string('cidade', 100)->nullable();
			$table->date('data_registro')->nullable();
			$table->string('logo', 100)->nullable();
			$table->string('modulo', 10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresa');
	}

}
