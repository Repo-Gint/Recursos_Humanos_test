<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Departamento;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Recursos_Humanos\Departamento::class, 15)->create();
        
       Departamento::create([
        	'Departament_ES' 			=> 'Dirección',
        	'Departament_EN' 			=> 'Direction',
        	'Acronym' 			        => 'DIR',
        	'Slug' 			            => 'direccion',
        	'Parent_id' 	            => null
        ]);

        Departamento::create([
        	'Departament_ES' 			=> 'Finanzas',
        	'Departament_EN' 			=> 'Finanzas',
        	'Acronym' 			        => 'FIN',
        	'Slug' 			            => 'finanzas',
        	'Parent_id' 	            => '1'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Ventas',
            'Departament_EN'            => 'Sales',
            'Acronym'                   => 'VEN',
            'Slug'                      => 'ventas',
            'Parent_id'                 => '1'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Operaciones',
            'Departament_EN'            => 'Operations',
            'Acronym'                   => 'OPE',
            'Slug'                      => 'operaciones',
            'Parent_id'                 => '1'
        ]);

        Departamento::create([
        	'Departament_ES' 			=> 'Sistemas',
        	'Departament_EN' 			=> 'Systems',
        	'Acronym' 			        => 'SIS',
        	'Slug' 			            => 'sistemas',
        	'Parent_id' 	            => '2'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Contabilidad',
            'Departament_EN'            => 'Accounting',
            'Acronym'                   => 'CON',
            'Slug'                      => 'contabilidad',
            'Parent_id'                 => '2'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Recursos Humanos',
            'Departament_EN'            => 'Human Resources',
            'Acronym'                   => 'RH',
            'Slug'                      => 'recursos-humanos',
            'Parent_id'                 => '2'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Compras',
            'Departament_EN'            => 'Purchasing',
            'Acronym'                   => 'COM',
            'Slug'                      => 'compras',
            'Parent_id'                 => '2'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Almacen',
            'Departament_EN'            => 'Warehouse',
            'Acronym'                   => 'ALM',
            'Slug'                      => 'almacen',
            'Parent_id'                 => '6'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Mercadotecnia',
            'Departament_EN'            => 'Marketing',
            'Acronym'                   => 'MER',
            'Slug'                      => 'mercadotecnia',
            'Parent_id'                 => '3'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Servicio Técnico',
            'Departament_EN'            => 'Technical Service',
            'Acronym'                   => 'SER',
            'Slug'                      => 'servicio-técnico',
            'Parent_id'                 => '3'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Diseño',
            'Departament_EN'            => 'Desing',
            'Acronym'                   => 'DES',
            'Slug'                      => 'diseño',
            'Parent_id'                 => '4'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Manufactura',
            'Departament_EN'            => 'Manufacturing',
            'Acronym'                   => 'CNC',
            'Slug'                      => 'manufactura',
            'Parent_id'                 => '4'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Producción Plastico',
            'Departament_EN'            => 'Plastic Produccion',
            'Acronym'                   => 'PPL',
            'Slug'                      => 'producción-plastico',
            'Parent_id'                 => '4'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Mantenimiento',
            'Departament_EN'            => 'Maitenance',
            'Acronym'                   => 'MAN',
            'Slug'                      => 'mantenimiento',
            'Parent_id'                 => '4'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Gestión de la Calidad',
            'Departament_EN'            => 'Quality Management',
            'Acronym'                   => 'GDC',
            'Slug'                      => 'gestión-de-la-calidad',
            'Parent_id'                 => '4'
        ]);

        Departamento::create([
            'Departament_ES'            => 'Seguridad e Higiene',
            'Departament_EN'            => 'Hygiene adn Security',
            'Acronym'                   => 'SH',
            'Slug'                      => 'seguridad-e-higiene',
            'Parent_id'                 => '4'
        ]);


    }
}
