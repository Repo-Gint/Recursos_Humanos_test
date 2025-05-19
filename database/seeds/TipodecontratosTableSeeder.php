<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Tipo_contrato;

class TipodecontratosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_contrato::create([
        	'Type' 			=> 'Indefinido',
        	'Slug' 			=> 'Indefinido'
        ]);

        Tipo_contrato::create([
        	'Type' 			=> 'Tiempo Determinado Capacitación',
        	'Slug' 			=> 'tiempo_determinado_capacitacion'
        ]);

        Tipo_contrato::create([
        	'Type' 			=> 'Tiempo Determinado Prueba',
        	'Slug' 			=> 'tiempo_determinado_prueba'
        ]);
    }
}
