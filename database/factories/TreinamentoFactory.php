<?php

use Faker\Generator as Faker;

$factory->define(\GestaoServicos\Models\Treinamento::class, function (Faker $faker) {
    return [
        'titulo' => $faker->sentence(10, true),
        'local' => $faker->sentence(10, true),
        'data_inicio' => $faker->dateTime(),
        'data_fim' => $faker->dateTime(),
        'participantes' => $faker->firstNameMale,
    ];
});
