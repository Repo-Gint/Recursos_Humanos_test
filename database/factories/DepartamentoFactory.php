<?php

use Faker\Generator as Faker;

$factory->define(Recursos_Humanos\Departamento::class, function (Faker $faker) {
	$departament = $faker->unique()->word;
    return [
        'Departament_ES' => $departament,
        'Departament_EN' => $departament,
        'Acronym' => $departament,
        'Active' => 1,
        'Slug' => str_slug($departament),
        'Parent_id' => NULL,
        
    ];
});