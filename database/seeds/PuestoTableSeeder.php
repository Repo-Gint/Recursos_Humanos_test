<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Puesto;

class PuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recursos_Humanos\Puesto::class, 50)->create();
        /*Puesto::create([
        	'Code' 	  => 'DIR01',
        	'Position_ES' 		  => 'Director',
        	'Position_EN' 	  => 'Director',
            'Descripcion'       => 'Hola',
            'Responsability'        => 'Hola 2',
            'Slug'  => 'director',
            'Hierarchy_id'  => '1',
            'Departament_id' => '1'
        ]);

        Puesto::create([
        	'Code' 	  => 'SIS01',
        	'Position_ES' 		  => 'Jefe de Sistemas',
        	'Position_EN' 	  => 'Jefe de sistemas',
            'Descripcion'       => 'Hola',
            'Responsability'        => 'Hola 2',
            'Slug'  => 'jefe',
            'Hierarchy_id'  => '3',
            'Departament_id' => '3'
        ]);

        Puesto::create([
        	'Code' 	  => 'SIS02',
        	'Position_ES' 		  => 'Analista de Sistemas',
        	'Position_EN' 	  => 'Analista de Sistemas',
            'Descripcion'       => 'Hola',
            'Responsability'        => 'Hola 2',
            'Slug'  => 'analista',
            'Hierarchy_id'  => '6',
            'Departament_id' => '3'
        ]);*/
    }
}
