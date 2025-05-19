<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Empleado;
class EmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create([
        	'Code' 	  => '1999',
        	'Names' 		  => 'Alejandro',
        	'Paternal' 	  => 'Lechuga',
            'Maternal'       => 'García',
            'Photo'        => 'man.png',
            'Active'  => '1',
            'Slug'  => '1999',
            'Parent_id' => null,
            'Company_id' => '1'
        ]);
    }
}
