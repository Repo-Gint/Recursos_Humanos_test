<?php 
/**
* Funciones generadas para la insercción, edición y eliminación 
* de usuarios dentro de la DB perteneciente al Sistema de Mantenimiento.
*/
function agregar_usuario_mantenimiento($user, $id){
	$id_user = DB::connection('mysql_mantenimiento')->table('users')->insertGetId(
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

	DB::connection('mysql_mantenimiento')->table('role_user')->insert(
    	[
    		'role_id' => 2, //sin acceso
    		'user_id' => $id_user,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s')
    	]
	);
}

function editar_usuario_mantenimiento($user, $id){
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

function eliminar_usuario_mantenimiento($id){
	DB::connection('mysql_mantenimiento')->table('users')->where('Employee_id', $id)->delete();
}


 ?>