<?php

use Faker\Generator as Faker;

$factory->define(Recursos_Humanos\Tipo_empleado::class, function (Faker $faker) {
    $type = $faker->unique()->word;
    return [
        'Type' => $type,
        'Slug' => str_slug($type)
        
    ];
});
