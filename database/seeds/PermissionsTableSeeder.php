<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creation of permissions for users
     * @return void
     */
    public function run()
    {
    	//Data stored in the permissions table

    	//Employees
        Permission::create([
        	'name' 			=> 'Listado de Empleados',
            'group'         => 'Empleados',
        	'slug' 			=> 'Empleado.index',
        	'description' 	=> 'Listado de los empleados dados de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear empleado',
            'group'         => 'Empleados',
        	'slug' 			=> 'Empleado.create',
        	'description' 	=> 'Crear un nuevo registro de empleado'
        ]);
        Permission::create([
        	'name' 			=> 'Editar empleado',
            'group'         => 'Empleados',
        	'slug' 			=> 'Empleado.edit',
        	'description' 	=> 'Editar un registro existente de un empleado'
        ]);
        Permission::create([
        	'name' 			=> 'Ver Empleado',
            'group'         => 'Empleados',
        	'slug' 			=> 'Empleado.show',
        	'description' 	=> 'Ver información detallada del empleado'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar empleado',
            'group'         => 'Empleados',
        	'slug' 			=> 'Empleado.destroy',
        	'description' 	=> 'Eliminar registro del empleado'
        ]);
        Permission::create([
            'name'          => 'Dar de baja a empleado',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.baja_empleado',
            'description'   => 'Dar de baja al empleado dentro del sistema'
        ]);
        Permission::create([
            'name'          => 'Listado de empleados inactivos',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.bajas_empleados',
            'description'   => 'Dar de baja algún empleado'
        ]);
        Permission::create([
            'name'          => 'Ver empleado dado de baja',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.información_del_empleado_baja',
            'description'   => 'Visualizar la información del empleado dado de baja'
        ]);
        Permission::create([
            'name'          => 'Contratar Empleado',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.contratar',
            'description'   => 'Contratar Empleado'
        ]);
        Permission::create([
            'name'          => 'Asignar nuevos puestos',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.asignar',
            'description'   => 'Asignar/Cambiar de puesto a los empleados'
        ]);
        Permission::create([
            'name'          => 'Asignar Rol',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.roles',
            'description'   => 'Asignación de roles los empleados'
        ]);
        Permission::create([
            'name'          => 'Agregar documentación',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.documentacion',
            'description'   => 'Agregar documentación al empleado'
        ]);
        Permission::create([
            'name'          => 'Editar documentación',
            'group'         => 'Empleados',
            'slug'          => 'Empleado.edicion_documentacion',
            'description'   => 'Editar documentación al empleado'
        ]);


        //Roles
        Permission::create([
        	'name' 			=> 'Listado de roles',
            'group'         => 'Roles',
        	'slug' 			=> 'Rol.index',
        	'description' 	=> 'Listado de los roles datos de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear rol',
            'group'         => 'Roles',
        	'slug' 			=> 'Rol.create',
        	'description' 	=> 'Crear un nuevo registro de un rol'
        ]);
        Permission::create([
        	'name' 			=> 'Editar rol',
            'group'         => 'Roles',
        	'slug' 			=> 'Rol.edit',
        	'description' 	=> 'Editar un registro existente de un rol'
        ]);
        Permission::create([
        	'name' 			=> 'Ver rol',
            'group'         => 'Roles',
        	'slug' 			=> 'Rol.show',
        	'description' 	=> 'Ver información detallada del rol'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar rol',
            'group'         => 'Roles',
        	'slug' 			=> 'Rol.destroy',
        	'description' 	=> 'Eliminar algún registro de un rol'
        ]);


        //Countries
        Permission::create([
        	'name' 			=> 'Listado de paises',
            'group'         => 'Paises',
        	'slug' 			=> 'Pais.index',
        	'description' 	=> 'Listado de los pais dados de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear pais',
            'group'         => 'Paises',
        	'slug' 			=> 'Pais.create',
        	'description' 	=> 'Crear un nuevo registro de un pais'
        ]);
        Permission::create([
        	'name' 			=> 'Editar pais',
            'group'         => 'Paises',
        	'slug' 			=> 'Pais.edit',
        	'description' 	=> 'Editar un registro existente de un pais'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar pais',
            'group'         => 'Paises',
        	'slug' 			=> 'Pais.destroy',
        	'description' 	=> 'Eliminar algún registro de un pais'
        ]);

        //Hierarchies
        Permission::create([
        	'name' 			=> 'Listado de jerarquias',
            'group'         => 'Jerarquias',
        	'slug' 			=> 'Jerarquia.index',
        	'description' 	=> 'Listado de las jerarquias dadas de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear jerarquia',
            'group'         => 'Jerarquias',
        	'slug' 			=> 'Jerarquia.create',
        	'description' 	=> 'Crear un nuevo registro de una jerarquia'
        ]);
        Permission::create([
        	'name' 			=> 'Editar jerarquia',
            'group'         => 'Jerarquias',
        	'slug' 			=> 'Jerarquia.edit',
        	'description' 	=> 'Editar un registro existente de una jerarquia'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar jerarquia',
            'group'         => 'Jerarquias',
        	'slug' 			=> 'Jerarquia.destroy',
        	'description' 	=> 'Eliminar algún registro de una jerarquia'
        ]);


        //Type_employee
        Permission::create([
        	'name' 			=> 'Listado de tipo de empleados',
            'group'         => 'Tipoempleados',
        	'slug' 			=> 'Tipoempleado.index',
        	'description' 	=> 'Listado de los tipos de empleado dados de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear tipo de empleado',
            'group'         => 'Tipoempleados',
        	'slug' 			=> 'Tipoempleado.create',
        	'description' 	=> 'Crear un nuevo registro de un tipo de empleado'
        ]);
        Permission::create([
        	'name' 			=> 'Editar tipo de empleado',
            'group'         => 'Tipoempleados',
        	'slug' 			=> 'Tipoempleado.edit',
        	'description' 	=> 'Editar un registro existente de un tipo de empleado'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar tipo de empleado',
            'group'         => 'Tipoempleados',
        	'slug' 			=> 'Tipoempleado.destroy',
        	'description' 	=> 'Eliminar algún registro de un tipo de empleado'
        ]);

        //Companies
        Permission::create([
        	'name' 			=> 'Listado de empresas',
            'group'         => 'Empresas',
        	'slug' 			=> 'Empresa.index',
        	'description' 	=> 'Listado de las empresas dadas de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear empresa',
            'group'         => 'Empresas',
        	'slug' 			=> 'Empresa.create',
        	'description' 	=> 'Crear un nuevo registro de una empresa'
        ]);
        Permission::create([
        	'name' 			=> 'Editar empresa',
            'group'         => 'Empresas',
        	'slug' 			=> 'Empresa.edit',
        	'description' 	=> 'Editar un registro existente de una empresa'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar empresa',
            'group'         => 'Empresas',
        	'slug' 			=> 'Empresa.destroy',
        	'description' 	=> 'Eliminar algún registro de una empresa'
        ]);

        //Departaments
        Permission::create([
        	'name' 			=> 'Listado de departamentos',
            'group'         => 'Departamentos',
        	'slug' 			=> 'Departamento.index',
        	'description' 	=> 'Listado de los departamentos dados de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear departamento',
            'group'         => 'Departamentos',
        	'slug' 			=> 'Departamento.create',
        	'description' 	=> 'Crear un nuevo registro de un departamento'
        ]);
        Permission::create([
        	'name' 			=> 'Ver Departamento',
            'group'         => 'Departamentos',
        	'slug' 			=> 'Departamento.show',
        	'description' 	=> 'Ver información detallada del departamento'
        ]);
        Permission::create([
        	'name' 			=> 'Editar departamento',
            'group'         => 'Departamentos',
        	'slug' 			=> 'Departamento.edit',
        	'description' 	=> 'Editar un registro existente de un departamento'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar departamento',
            'group'         => 'Departamentos',
        	'slug' 			=> 'Departamento.destroy',
        	'description' 	=> 'Eliminar algún registro de un departamento'
        ]);
        Permission::create([
            'name'          => 'Visualizar Organigrama',
            'group'         => 'Departamentos',
            'slug'          => 'Departamento.Organigrama_general',
            'description'   => 'Vizualizar organigrama general'
        ]);
        //Positions
        Permission::create([
        	'name' 			=> 'Listado de puestos',
            'group'         => 'Puestos',
        	'slug' 			=> 'Puesto.index',
        	'description' 	=> 'Listado de los puestos dados de alta en el sistema'
        ]);
        Permission::create([
        	'name' 			=> 'Crear puesto',
            'group'         => 'Puestos',
        	'slug' 			=> 'Puesto.create',
        	'description' 	=> 'Crear un nuevo registro de un puesto'
        ]);
        Permission::create([
        	'name' 			=> 'Editar puesto',
            'group'         => 'Puestos',
        	'slug' 			=> 'Puesto.edit',
        	'description' 	=> 'Editar un registro existente de un puesto'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar puesto',
            'group'         => 'Puestos',
        	'slug' 			=> 'Puesto.destroy',
        	'description' 	=> 'Eliminar algún registro de un puesto'
        ]);

        //Holidays
        Permission::create([
        	'name' 			=> 'Listado de vacaciones',
            'group'         => 'Vacaciones',
        	'slug' 			=> 'Vacaciones.index',
        	'description' 	=> 'Listado de las vaciones asignadas a los empleados'
        ]);
        Permission::create([
        	'name' 			=> 'Asignar vaciones',
            'group'         => 'Vacaciones',
        	'slug' 			=> 'Vacaciones.create',
        	'description' 	=> 'Asignar dias de vaciones a los empleados'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar vacaciones',
            'group'         => 'Vacaciones',
        	'slug' 			=> 'Vacaciones.destroy',
        	'description' 	=> 'Eliminar registros de vacaciones a los empleados'
        ]);

        //Documents
        Permission::create([
            'name'          => 'Listado de documentos',
            'group'         => 'Documentos',
            'slug'          => 'Documento.index',
            'description'   => 'Listado de los documentos registrados'
        ]);
        Permission::create([
            'name'          => 'Crear documento',
            'group'         => 'Documentos',
            'slug'          => 'Documento.create',
            'description'   => 'Crear un nuevo registro de documento'
        ]);
        Permission::create([
            'name'          => 'Editar documento',
            'group'         => 'Documentos',
            'slug'          => 'Documento.edit',
            'description'   => 'Editar un registro existente de un documento'
        ]);
        Permission::create([
            'name'          => 'Eliminar documento',
            'group'         => 'Documentos',
            'slug'          => 'Documento.destroy',
            'description'   => 'Eliminar registro de un documento'
        ]);

        //Scholarship
        Permission::create([
            'name'          => 'Listado de escolaridades',
            'group'         => 'Escolaridad',
            'slug'          => 'Escolaridad.index',
            'description'   => 'Listado de las escolaridades registradas'
        ]);
        Permission::create([
            'name'          => 'Crear escolaridad',
            'group'         => 'Escolaridad',
            'slug'          => 'Escolaridad.create',
            'description'   => 'Crear un nuevo registro de escolaridad'
        ]);
        Permission::create([
            'name'          => 'Editar escolaridad',
            'group'         => 'Escolaridad',
            'slug'          => 'Escolaridad.edit',
            'description'   => 'Editar un registro existente de una escolaridad'
        ]);
        Permission::create([
            'name'          => 'Eliminar escolaridad',
            'group'         => 'Escolaridad',
            'slug'          => 'Escolaridad.destroy',
            'description'   => 'Eliminar registro de una escolaridad'
        ]);
        //Voucher
        Permission::create([
            'name'          => 'Listado de vouchers',
            'group'         => 'Vouchers',
            'slug'          => 'Voucher.index',
            'description'   => 'Listado de vouchers registrados'
        ]);
        Permission::create([
            'name'          => 'Crear voucher',
            'group'         => 'Vouchers',
            'slug'          => 'Voucher.create',
            'description'   => 'Crear un nuevo registro de voucher'
        ]);
        Permission::create([
            'name'          => 'Editar voucher',
            'group'         => 'Vouchers',
            'slug'          => 'Voucher.edit',
            'description'   => 'Editar un registro existente de una voucher'
        ]);
        Permission::create([
            'name'          => 'Eliminar voucher',
            'group'         => 'Vouchers',
            'slug'          => 'Voucher.destroy',
            'description'   => 'Eliminar registro de una voucher'
        ]);

        //Martial_status
        Permission::create([
            'name'          => 'Listado de estados civiles',
            'group'         => 'Estado_Civil',
            'slug'          => 'Estado_Civil.index',
            'description'   => 'Listado de estados civiles registrados'
        ]);
        Permission::create([
            'name'          => 'Crear estado civil',
            'group'         => 'Estado_Civil',
            'slug'          => 'Estado_Civil.create',
            'description'   => 'Crear un nuevo registro'
        ]);
        Permission::create([
            'name'          => 'Editar estado civil',
            'group'         => 'Estado_Civil',
            'slug'          => 'Estado_Civil.edit',
            'description'   => 'Editar un registro existente'
        ]);
        Permission::create([
            'name'          => 'Eliminar estado civil',
            'group'         => 'Estado_Civil',
            'slug'          => 'Estado_Civil.destroy',
            'description'   => 'Eliminar registro'
        ]);

        //type_outputs
        Permission::create([
            'name'          => 'Listado de tipos de bajas',
            'group'         => 'Bajas',
            'slug'          => 'Baja.index',
            'description'   => 'Listado de tipos de bajas'
        ]);
        Permission::create([
            'name'          => 'Crear tipo de baja',
            'group'         => 'Bajas',
            'slug'          => 'Baja.create',
            'description'   => 'Crear un nuevo registro'
        ]);
        Permission::create([
            'name'          => 'Editar tipo de baja',
            'group'         => 'Bajas',
            'slug'          => 'Baja.edit',
            'description'   => 'Editar un registro existente'
        ]);
        Permission::create([
            'name'          => 'Eliminar tipo de baja',
            'group'         => 'Bajas',
            'slug'          => 'Baja.destroy',
            'description'   => 'Eliminar registro'
        ]);

        //type_outputs
        Permission::create([
            'name'          => 'Listado de parentescos',
            'group'         => 'Familiar',
            'slug'          => 'Familiar.index',
            'description'   => 'Listado de tipos de bajas'
        ]);
        Permission::create([
            'name'          => 'Crear parentesco',
            'group'         => 'Familiar',
            'slug'          => 'Familiar.create',
            'description'   => 'Crear un nuevo registro'
        ]);
        Permission::create([
            'name'          => 'Editar parentesco',
            'group'         => 'Familiar',
            'slug'          => 'Familiar.edit',
            'description'   => 'Editar un registro existente'
        ]);
        Permission::create([
            'name'          => 'Eliminar parentesco',
            'group'         => 'Familiar',
            'slug'          => 'Familiar.destroy',
            'description'   => 'Eliminar registro'
        ]);
        //reports
        Permission::create([
            'name'          => 'Listado de reportes',
            'group'         => 'Reportes',
            'slug'          => 'Reportes.index',
            'description'   => 'Listado de tipos de reportes'
        ]);
    }
}
