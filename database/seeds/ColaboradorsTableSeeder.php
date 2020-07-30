<?php

use GestaoServicos\Models\Colaborador;
use Illuminate\Database\Seeder;

class ColaboradorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Colaborador::class, 8)->create();
    }
}
