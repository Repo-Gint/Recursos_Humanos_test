<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Domicilio;
class DomiciliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domicilio::create([
        	'Address' 	  => 'Negrete',
        	'Postcode' 		  => '1996',
        	'Tows' 	  => 'San pancho',
            'Municipality'       => 'Almoloya de Juarez',
            'State'        => 'Estado de México',
            'Country_id'  => '1',
            'Employee_id' => '1'
        ]);
    }
}
