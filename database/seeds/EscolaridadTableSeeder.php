<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Escolaridad;

class EscolaridadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Escolaridad::create([
        	'Scholarship' 		=> 'Licenciatura en Ingeneria',
        	'Slug' 			    => 'licenciatura_en_ingeneria'
        ]);

        Escolaridad::create([
            'Scholarship'       => 'Preparatoria',
            'Slug'              => 'preparatoria'
        ]);

        Escolaridad::create([
            'Scholarship'       => 'Secundaria',
            'Slug'              => 'secundaria'
        ]);

        Escolaridad::create([
            'Scholarship'       => 'Primaria',
            'Slug'              => 'primaria'
        ]);

        Escolaridad::create([
            'Scholarship'       => 'Licenciatura',
            'Slug'              => 'licenciatura'
        ]);
    }
}
