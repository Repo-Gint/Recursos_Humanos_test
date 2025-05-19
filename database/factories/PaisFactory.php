<?php

use Faker\Generator as Faker;

$factory->define(Recursos_Humanos\Pais::class, function (Faker $faker) {
	$country = $faker->country;
    return [
        'Country' => $country,
        'Flag' => $faker->imageUrl($width = 500, $height = 400),
        'Slug' => str_slug($country)
    ];
});
