<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AtividadesTableSeeder::class);
        $this->call(ColaboradorsTableSeeder::class);
        $this->call(ComprasTableSeeder::class);
        $this->call(TreinamentosTableSeeder::class);
        $this->call(AtividadeFotosTableSeeder::class);
    }
}
