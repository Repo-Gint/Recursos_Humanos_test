<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Datos;
class DatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Datos::create([
        	'Gender' 	  => 'Hombre',
        	'Birthdate' 		  => '1996-06-21',
        	'Nss' 	  => '1234567890',
            'Rfc'       => 'LEGS96062133A',
            'Curp' => 'LEGS960621HMCCRM04',
            'Credential' => '1232214214',
            'Blood'        => '+O',
            'Allergy'  => 'Ninguna',
            'Marital_status' => 'Soltero/a',
            'Children' => '0',  
            'Credit' => 'N/A',
            'Credit_num' => null,
            'Scholarchip_id' => '1',
            'Voucher_id' => '1',
            'Tows' => 'Calayuco',
            'Municipality' => 'Juchitepec',
            'State' => 'Estado de México',
            'Country_id'  => '1',
            'Employee_id' => '1'
        ]);
    }
}
