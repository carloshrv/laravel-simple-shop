<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\Admin;
use App\Entities\Piloto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

      
        Piloto::create([
            'nome_piloto' => 'Junior',
            'data_validade_registro' => 2024,
        ]);
        
    }
}
