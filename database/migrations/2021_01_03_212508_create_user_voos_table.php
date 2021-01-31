<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserVoosTable.
 */
class CreateUserVoosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_voos', function(Blueprint $table) {
            $table->increments('id');
			
			$table-> unsignedInteger('user_id');
			$table -> foreign('user_id') -> references('id') -> on('users');
			
			$table-> unsignedInteger('voo_id');
			$table -> foreign('voo_id') -> references('id') -> on('voos');
			
			
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
		Schema::drop('user_voos');
	}
}
