<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Contratacion;

class ContratacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contratacion::create([
        	'High_date' 	  => '2018-01-16',
        	'Low_date' 	  => null,
        	'Duration' 	  => null,
            'Ending'       => null,
            'Typecontract_id'        => '1',
            'Employee_id' => '1'
        ]);
    }
}
