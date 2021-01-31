<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			//user information
			$table->  increments('id');
			$table-> char('numero_rg');
			$table -> string('nome_cliente');
			$table -> char('telefone', 11);
			$table -> string('endereço');
			$table -> string('numero_cadeira');
			$table -> string('qtd_bagagem');

			//auth information
			$table -> string('email');
			$table -> string('password');
			
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
		Schema::drop('users');
	}
}
