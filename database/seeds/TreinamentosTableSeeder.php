<?php

use GestaoServicos\Models\Treinamento;
use Illuminate\Database\Seeder;

class TreinamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Treinamento::class, 25)->create();
    }
}
