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

      
        Admin::create([
            'email' => 'carloshenriquereis12@gmail.com',
            'password' => '123456789',
        ]);
        Admin::create([
            'email' => 'SegundoAdmin@admin.com',
            'password' => '123456789',
        ]);
        Piloto::create([
            'nome_piloto' => 'carlos',
            'data_validade_registro' => 2025,
        ]);
        
    }
}
