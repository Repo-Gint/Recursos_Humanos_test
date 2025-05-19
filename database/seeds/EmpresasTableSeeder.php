<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Empresa;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
        	'Acronym' 	  => 'GIM',
        	'Name' 		  => 'Grupo Interconsult S.A de C.V',
        	'Address' 	  => 'Prueba',
            'Phone'       => '1234567890',
            'Slug'        => 'gim',
            'State' => 'Estado de México',
            'Municipality'  => 'Toluca',
            'Tows'  => 'Otzolocatepec',
            'Country_id' => '1'
        ]);
    }
}
