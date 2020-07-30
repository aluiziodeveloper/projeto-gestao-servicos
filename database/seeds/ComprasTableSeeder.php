<?php

use GestaoServicos\Models\Compra;
use Illuminate\Database\Seeder;

class ComprasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Compra::class, 9)->create();
    }
}
