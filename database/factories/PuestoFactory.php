<?php

use Faker\Generator as Faker;

$factory->define(Recursos_Humanos\Puesto::class, function (Faker $faker) {
    $position = $faker->unique()->sentence(2);
    return [
        'Code' => $faker->unique()->domainWord,
        'Position_ES' => $position,
        'Position_EN' => $position,
        'Descripcion' => $faker->text(100),
        'Responsability' => $faker->text(100),
        'Vacancies' => $faker->numberBetween($min = 1, $max = 9),
        'Active' => 1,
        'Slug' => str_slug($position),
        'Parent_id' => NULL,
        'Hierarchy_id' => $faker->numberBetween($min = 1, $max = 7),
        'Departament_id' => $faker->numberBetween($min = 1, $max = 17)
    ];
});
