<?php

use Faker\Generator as Faker;

$factory->define(\GestaoServicos\Models\Atividade::class, function (Faker $faker) {
    return [
        'ordem' => '43000450' . $faker->randomNumber(3),
        'nota' => '10521' . $faker->randomNumber(3),
        'estacao' => 'STCMS',
        'equipamento' => $faker->linuxProcessor,
        'tipo' => 'CORRETIVA',
        'titulo' => $faker->domainName,
        'data_inicio' => $faker->dateTime(),
        'si' => 'STCMS-000' . $faker->randomNumber(2) . '/2020',
        'apr' => 'DMLV.O-000' . $faker->randomNumber(2) . '/2020',
        'equipe' => $faker->firstNameMale,
        'relatorio' => $faker->text(400),
        'encerrado' => $faker->boolean(),
    ];
});
