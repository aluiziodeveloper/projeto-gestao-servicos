<?php

use GestaoServicos\Models\Atividade;
use Illuminate\Database\Seeder;

class AtividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Atividade::class, 10)->create();
    }
}
