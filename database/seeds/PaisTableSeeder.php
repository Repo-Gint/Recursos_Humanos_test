<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Pais;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Recursos_Humanos\Pais::class, 5)->create();
        //Employees
        Pais::create([
        	'Country' 		=> 'México',
        	'Flag' 			=> 'mexico.png',
        	'Slug' 	        => 'mexico'
        ]);

        Pais::create([
            'Country'       => 'Colombia',
            'Flag'          => 'colombia.png',
            'Slug'          => 'colombia'
        ]);

        Pais::create([
            'Country'       => 'Venezuela',
            'Flag'          => 'venezuela.png',
            'Slug'          => 'venezuela'
        ]);

        Pais::create([
            'Country'       => 'España',
            'Flag'          => 'españa',
            'Slug'          => 'españa'
        ]);

        Pais::create([
            'Country'       => 'Alemania',
            'Flag'          => 'alemania',
            'Slug'          => 'alemania'
        ]);
    }
}
