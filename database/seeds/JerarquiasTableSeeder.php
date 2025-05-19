<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Jerarquia;

class JerarquiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
         //factory(Recursos_Humanos\Jerarquia::class, 10)->create();
        Jerarquia::create([
        	'Name_ES' 			=> 'Dirección',
        	'Name_EN' 			=> 'Direction',
        	'Level' 			=> '1',
        	'Slug' 			    => 'direccion'
        ]);
        Jerarquia::create([
        	'Name_ES' 			=> 'Sub Dirección',
        	'Name_EN' 			=> 'Sub Direction',
        	'Level' 			=> '2',
        	'Slug' 			    => 'sub_direccion'
        ]);

        Jerarquia::create([
        	'Name_ES' 			=> 'Jefatura',
        	'Name_EN' 			=> 'Jefatura',
        	'Level' 			=> '3',
        	'Slug' 			    => 'jefatura'
        ]);

        Jerarquia::create([
        	'Name_ES' 			=> 'Coordinador',
        	'Name_EN' 			=> 'Coordinador',
        	'Level' 			=> '4',
        	'Slug' 			    => 'coordinador'
        ]);

        Jerarquia::create([
        	'Name_ES' 			=> 'Supervisor',
        	'Name_EN' 			=> 'Supervisor',
        	'Level' 			=> '5',
        	'Slug' 			    => 'supervisor'
        ]);

        Jerarquia::create([
        	'Name_ES' 			=> 'Administracion',
        	'Name_EN' 			=> 'Administracion',
        	'Level' 			=> '6',
        	'Slug' 			    => 'Administracion'
        ]);
        Jerarquia::create([
            'Name_ES'           => 'Operativo',
            'Name_EN'           => 'Operativo',
            'Level'             => '7',
            'Slug'              => 'operativo'
        ]);
    }
}
