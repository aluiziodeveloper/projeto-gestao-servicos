<?php

use Faker\Generator as Faker;

$factory->define(\GestaoServicos\Models\Compra::class, function (Faker $faker) {
    return [
        'numero' => '43000450' . $faker->randomNumber(2),
        'descricao' => $faker->text(400),
        'comprador' => $faker->firstNameMale,
    ];
});
