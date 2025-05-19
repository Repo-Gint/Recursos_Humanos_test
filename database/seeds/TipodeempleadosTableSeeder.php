<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Tipo_empleado;

class TipodeempleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_empleado::create([
        	'Type' 			=> 'Confianza',
        	'Slug' 			=> 'confianza'
        ]);
        Tipo_empleado::create([
        	'Type' 			=> 'Sindicalizado',
        	'Slug' 			=> 'sindicalizado'
        ]);
        Tipo_empleado::create([
        	'Type' 			=> 'Dual',
        	'Slug' 			=> 'dual'
        ]);
        Tipo_empleado::create([
        	'Type' 			=> 'Practicante',
        	'Slug' 			=> 'practicante'
        ]);
    }
}
