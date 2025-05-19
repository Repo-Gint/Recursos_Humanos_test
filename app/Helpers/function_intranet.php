<?php 
/**
* Funciones generadas para la insercción, edición y eliminación 
* de usuarios dentro de la DB perteneciente al Sistema de Intranet.
*/
function agregar_usuario($user, $id){
	$id_user = DB::connection('mysql_intranet')->table('users')->insertGetId(
    	[
    		'name' => $user->name, 
    		'email' => $user->email,
    		'email_verified_at' => null,
    		'password' => $user->password,
    		'remember_token'  => null,
    		'Employee_id' => $id,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
    	]
	);

	DB::connection('mysql_intranet')->table('role_user')->insert(
    	[
    		'role_id' => 3, //id del rol Estandar por defecto 
    		'user_id' => $id_user,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
    	]
	);
}

function editar_usuario($user, $id){
	DB::connection('mysql_intranet')->table('users')
	->where('Employee_id', $id)
	->update(
		[
			'name' => $user->name, 
    		'password' => $user->password,
    		'updated_at' => date('Y-m-d H:i:s')
		]
	);
}

function eliminar_usuario($id){
	DB::connection('mysql_intranet')->table('users')->where('Employee_id', $id)->delete();
}


 ?>