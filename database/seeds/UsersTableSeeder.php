<?php

use GestaoServicos\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)
            ->create([
                'email' => 'admin@user.com',
                'role' => 1
            ]);
        factory(User::class, 20)->create();
    }
}
