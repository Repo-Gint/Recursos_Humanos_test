<?php

use Faker\Generator as Faker;

$factory->define(Recursos_Humanos\Pais::class, function (Faker $faker) {
    $hierarchy = $faker->unique()->word;
    $level = 1;
    return [
        'Name_ES' => $hierarchy,
        'Name_EN' => $hierarchy,
        'Level' => $level++,
        'Slug' => str_slug($hierarchy)
        
    ];
});
