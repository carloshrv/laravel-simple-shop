<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePilotosTable.
 */
class CreatePilotosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilotos', function(Blueprint $table) {
			//main information
			$table -> increments('id');
			$table -> string("nome_piloto");
			$table -> string("data_validade_registro");

			//foreign keys

			//timestamps
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
		
		Schema::drop('pilotos');
	}
}
