<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateVoosTable.
 */
class CreateVoosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voos', function(Blueprint $table) {
			//main information
			$table->  increments('id');
			$table -> string("classe_voo");
			$table -> time("hora_partida");
			$table -> time("hora_chegada");
			$table -> date("data_partida");
			$table -> date("data_volta");
			$table -> string("local_partida");
			$table -> string("local_desembarque");
			$table -> string("estado_destino");
			$table -> float("valor", 8, 2);
			$table -> integer("ativo") -> default(1);
			
			//foregin keys 
			$table-> unsignedInteger('id_piloto');
			//$table -> foreign("numero_registro") -> references('numero_registro') -> on('pilotos');

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
		Schema::drop('voos');
	}
}
