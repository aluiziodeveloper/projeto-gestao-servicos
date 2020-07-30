<?php

use Faker\Generator as Faker;

$factory->define(\GestaoServicos\Models\Colaborador::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'matricula' => $faker->unique()->phoneNumber,
        'setor' => $faker->country,
    ];
});
