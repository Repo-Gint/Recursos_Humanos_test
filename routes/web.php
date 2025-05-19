<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*** Rutas para el login y logout INICIO***/
Route::get('/', 'Auth\LoginController@showLoginForm');

Route::post('login', 'Auth\LoginController@login')->name('Login.login');

Route::post('logout', [ 
	'uses' => 'Auth\LoginController@logout',
	'as' => 'Login.logout'
]);
/*** Rutas para el login y logout FIN***/

/*** Rutas para el panel INICIO***/
Route::view('/Panel', 'Panel');
/*** Rutas para el panel FIN***/

/*** Rutas para pais INICIO***/
Route::resource('Pais','PaisController');
Route::get('Pais/{id}/destroy', 'PaisController@destroy')->name('Pais.destroy');
/*** Rutas para pais FIN***/

/*** Rutas para Dias Festivos INICIO***/
Route::resource('Dias_Festivos','Dias_FestivosController');
Route::get('Dias_Festivos/{id}/destroy', 'Dias_FestivosController@destroy')->name('Dias_Festivos.destroy');
/*** Rutas para Dias Festivos FIN***/

/*** Rutas para jerarquias INICIO***/
Route::resource('Jerarquia','JerarquiaController');
Route::get('Jerarquia/{id}/destroy', 'JerarquiaController@destroy')->name('Jerarquia.destroy');
/*** Rutas para jerarquias FIN***/

/*** Rutas para Tipo empleado INICIO***/
Route::resource('Tipoempleado','TipoempleadoController');
Route::get('Tipoempleado/{id}/destroy', 'TipoempleadoController@destroy')->name('Tipoempleado.destroy');
/*** Rutas para Tipo empleado FIN***/


/*** Rutas para Empresa INICIO***/
Route::resource('Empresa','EmpresaController');
Route::get('Empresa/{id}/destroy', 'EmpresaController@destroy')->name('Empresa.destroy');
/*** Rutas para Empresa FIN***/

/*** Rutas para Departamento INICIO***/
Route::resource('Departamento','DepartamentoController');
Route::get('Departamento/{id}/disable', 'DepartamentoController@disable')->name('Departamento.disable');
Route::post('Departamento/enable', 'DepartamentoController@enable')->name('Departamento.enable');
Route::get('Departamento/{id}/destroy', 'DepartamentoController@destroy')->name('Departamento.destroy');
Route::get('Departamento/{slug}/showPosition', 'DepartamentoController@showPosition')->name('Departamento.showPosition');
Route::get('Organigrama_general', 'DepartamentoController@Organigrama_general')->name('Departamento.Organigrama_general');

/*** Rutas para Departamento FIN***/

/*** Rutas para Puesto INICIO***/
Route::resource('Puesto','PuestoController');
Route::get('Puesto/{id}/disable', 'PuestoController@disable')->name('Puesto.disable');
Route::post('Puesto/enable', 'PuestoController@enable')->name('Puesto.enable');
Route::get('Puesto/{id}/destroy', 'PuestoController@destroy')->name('Puesto.destroy');
Route::get('Puesto/{id}/obtener_puestos', 'PuestoController@obtener_puestos')->name('Puesto.obtener_puestos');
Route::get('Puesto/{id}/obtener_puestos_superiores', 'PuestoController@obtener_puestos_superiores')->name('Puesto.obtener_puestos_superiores');
/*** Rutas para Puesto FIN***/


/*** Rutas para Empleado INICIO***/
Route::resource('Empleado','EmpleadoController');

Route::get('Empleado/{id}/destroy', 'EmpleadoController@destroy')->name('Empleado.destroy');
//Route::get('Empleado/{id}/getpuestos', 'EmpleadoController@getpuestos')->name('Empleado.getpuestos');
Route::get('Empleado/{id}/obtener_empleado_superior', 'EmpleadoController@obtener_empleado_superior')->name('Empleado.obtener_empleado_superior');
Route::get('Empleado/{id}/obtener_codigo_empleado', 'EmpleadoController@obtener_codigo_empleado')->name('Empleado.obtener_codigo_empleado');
Route::get('bajas_empleados', 'EmpleadoController@bajas_empleados')->name('Empleado.bajas_empleados');
Route::get('Empleado/{slug}/información_del_empleado_baja', 'EmpleadoController@información_del_empleado_baja')->name('Empleado.información_del_empleado_baja');
Route::put('Empleado/{id}/roles', 'EmpleadoController@roles')->name('Empleado.roles');
Route::put('Empleado/{id}/documentacion', 'EmpleadoController@documentacion')->name('Empleado.documentacion');
Route::get('Empleado/{slug}/edicion_documentacion', 'EmpleadoController@edicion_documentacion')->name('Empleado.edicion_documentacion');
Route::put('Empleado/{slug}/edicion_documentacion_edit', 'EmpleadoController@edicion_documentacion_edit')->name('Empleado.edicion_documentacion_edit');
Route::put('Empleado/{id}/contratar', 'EmpleadoController@contratar')->name('Empleado.contratar');
//Route::get('Empleado/{id}/output_view', 'EmpleadoController@output_view')->name('Empleado.output_view');
Route::put('Empleado/{id}/baja_de_empleado', 'EmpleadoController@baja_de_empleado')->name('Empleado.baja_de_empleado');
Route::get('Empleado/{slug}/recontratar', 'EmpleadoController@recontratar')->name('Empleado.recontratar');
Route::put('Empleado/{Empleado}/recontratar_guardar', 'EmpleadoController@recontratar_guardar')->name('Empleado.recontratar_guardar');


Route::put('Empleado/{id}/asignar_nuevo_puesto', 'EmpleadoController@asignar_nuevo_puesto')->name('Empleado.asignar_nuevo_puesto');
Route::post('Empleado/{id}/anexos', 'EmpleadoController@anexos')->name('Empleado.anexos');
Route::get('Empleado/{id}/{slug}/eliminar_anexos', 'EmpleadoController@eliminar_anexos')->name('Empleado.eliminar_anexos');

Route::get('descargar_anexo/{name}', function($name){
	return Storage::download("".$name."", $name);
})->name('descargar_anexo');

Route::get('export', 'EmpleadoController@export')->name('Empleado.export');
/*** Rutas para Empleado FIN***/


/*
 *Rutas para el modulo de empleados FIN
 *
 */
Route::resource('Vacaciones','VacacionesController');
Route::get('Vacaciones/{id}/{slug}/destroy', 'VacacionesController@destroy')->name('Vacaciones.destroy');

Route::resource('Rol','RolController');
Route::get('Rol/{id}/destroy','RolController@destroy')->name('Rol.destroy');


Route::resource('Documento','DocumentosController');
Route::get('Documento/{id}/destroy', 'DocumentosController@destroy')->name('Documento.destroy');

Route::resource('Escolaridad','EscolaridadController');
Route::get('Escolaridad/{id}/destroy', 'EscolaridadController@destroy')->name('Escolaridad.destroy');

Route::resource('Voucher','VoucherController');
Route::get('Voucher/{id}/destroy', 'VoucherController@destroy')->name('Voucher.destroy');


Route::get('Reporte/index', [
	'uses' => 'ReporteController@index',
	'as' => 'Reporte.index'
]);


Route::resource('Baja','BajaController');
Route::get('Baja/{id}/destroy', 'BajaController@destroy')->name('Baja.destroy');


Route::resource('Estado_Civil','Estado_CivilController');
Route::get('Estado_Civil/{id}/destroy', 'Estado_CivilController@destroy')->name('Estado_Civil.destroy');


Route::resource('Banco','BancoController');
Route::get('Banco/{id}/destroy', 'BancoController@destroy')->name('Banco.destroy');


Route::resource('Familiar','FamiliarController');
Route::get('Familiar/{id}/destroy', 'FamiliarController@destroy')->name('Familiar.destroy');

/** Rutas para la creación de archivos pdf's **/

Route::post('Reporte/listado_empleados', [
	'uses' => 'ReporteController@listado_empleados',
	'as' => 'Reporte.listado_empleados'
]);

Route::post('Reporte/catalogo_puestos', [
	'uses' => 'ReporteController@catalogo_puestos',
	'as' => 'Reporte.catalogo_puestos'
]);

Route::post('Reporte/vacaciones', [
	'uses' => 'ReporteController@vacaciones',
	'as' => 'Reporte.vacaciones'
]);

Route::get('orgchartpdf', function(){
	$departamentos= Recursos_Humanos\Departamento::get();
	$pdf = PDF::loadView('Pdf.orgchart', ['departamentos' => $departamentos])->setPaper('legal', 'landscape');
	return $pdf->download('orgchart_departaments.pdf');
})->name('orgchartpdf');


Route::get('orgchartdeppdf/{slug}', function($slug){
	$departamento = Recursos_Humanos\Departamento::whereSlug($slug)->firstOrFail();
   	if($departamento->Parent_id != NULL){
        $departamento_padre = Recursos_Humanos\Departamento::where('id', '=', $departamento->Parent_id)->firstOrFail();
    }else{
        $departamento_padre = NULL;
    }
    if($departamento->Departament_ES == 'Dirección General'){
        $puestos = Recursos_Humanos\Puesto::where('positions.Active', '=', 1)
        ->orderBy('Hierarchy_id', 'ASC')
        ->with('empleado')
        ->get();
        $empleados = Recursos_Humanos\Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
        ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
        ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
        ->where('employees.Active','=', 1)
        ->get();
    }else{
        $puestos = Recursos_Humanos\Puesto::select('positions.id','Code', 'Position_ES', 'Position_EN', 'Descripcion', 'Responsability', 'Vacancies', 'positions.Active', 'positions.Slug', 'Parent_id', 'Hierarchy_id', 'Departament_id')
        ->join('hierarchies', 'positions.Hierarchy_id', '=', 'hierarchies.id')
        ->where('positions.Active', '=', 1)
        ->orderBy('hierarchies.Level', 'ASC')
        ->get();

        $empleados = Recursos_Humanos\Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
        ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
        ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
        ->where('employees.Active','=', 1)
        ->get();
    }
    if($departamento->Departament_EN == "Manufacturing CNC"){
    	$pdf = PDF::loadView('Pdf.orgchart_dep', ['departamento' => $departamento, 'puestos' => $puestos, 'empleados' => $empleados, 'departamento_padre' => $departamento_padre])
		->setPaper('legal', 'landscape');
    }else{
    	$pdf = PDF::loadView('Pdf.orgchart_dep', ['departamento' => $departamento, 'puestos' => $puestos, 'empleados' => $empleados, 'departamento_padre' => $departamento_padre])
		->setPaper('letter', 'landscape');
    }
	
	return $pdf->download('orgchart_'.$departamento->Departament_EN.'.pdf');

})->name('orgchartdeppdf');

Route::get('orgchartdeppositionspdf/{slug}', function($slug){
	$departamento = Recursos_Humanos\Departamento::whereSlug($slug)->firstOrFail();
   	if($departamento->Parent_id != NULL){
        $departamento_padre = Recursos_Humanos\Departamento::where('id', '=', $departamento->Parent_id)->firstOrFail();
    }else{
        $departamento_padre = NULL;
    }
    if($departamento->Departament_ES == 'Dirección General'){
        $puestos = Recursos_Humanos\Puesto::where('positions.Active', '=', 1)
        ->orderBy('Hierarchy_id', 'ASC')
        ->with('empleado')
        ->get();
        $empleados = Recursos_Humanos\Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
        ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
        ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
        ->where('employees.Active','=', 1)
        ->get();
    }else{
        $puestos = Recursos_Humanos\Puesto::select('positions.id','Code', 'Position_ES', 'Position_EN', 'Descripcion', 'Responsability', 'Vacancies', 'positions.Active', 'positions.Slug', 'Parent_id', 'Hierarchy_id', 'Departament_id')
        ->join('hierarchies', 'positions.Hierarchy_id', '=', 'hierarchies.id')
        ->where('positions.Active', '=', 1)
        ->orderBy('hierarchies.Level', 'ASC')
        ->get();

        $empleados = Recursos_Humanos\Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
        ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
        ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
        ->where('employees.Active','=', 1)
        ->get();
    }
    if($departamento->Departament_EN == "Manufacturing CNC" || $departamento->Departament_EN == "Plastic Production" ){
    	$pdf = PDF::loadView('Pdf.orgchart_dep_position', ['departamento' => $departamento, 'puestos' => $puestos, 'empleados' => $empleados, 'departamento_padre' => $departamento_padre])
		->setPaper('legal', 'landscape');
    }else{
    	$pdf = PDF::loadView('Pdf.orgchart_dep_position', ['departamento' => $departamento, 'puestos' => $puestos, 'empleados' => $empleados, 'departamento_padre' => $departamento_padre])
		->setPaper('letter', 'landscape');
    }
	
	return $pdf->download('orgchart_'.$departamento->Departament_EN.'.pdf');

})->name('orgchartdeppositionspdf');


Route::get('evaluacion/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.evaluacion', ['empleado' => $empleado])->setPaper('a4', 'landscape');
	return $pdf->download('evaluacion.pdf');
})->name('evaluacion');


Route::get('caratula/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.caratula', ['empleado' => $empleado]);
	return $pdf->download('caratula.pdf');
})->name('caratula');


Route::get('carta/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.carta', ['empleado' => $empleado]);
	return $pdf->download('carta.pdf');
})->name('carta');

Route::get('constancia_vacaciones/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.constancia_vacaciones', ['empleado' => $empleado]);
	return $pdf->download('constancia_vacaciones.pdf');
})->name('constancia_vacaciones');


Route::get('acuerdo/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.acuerdo', ['empleado' => $empleado]);
	return $pdf->download('acuerdo.pdf');
})->name('acuerdo');


Route::get('credito/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$pdf = PDF::loadView('Pdf.credito', ['empleado' => $empleado]);
	return $pdf->download('credito.pdf');
})->name('credito');


Route::get('vacaciones_usuario/{slug}', function($slug){
	$empleado = Recursos_Humanos\Empleado::whereSlug($slug)->firstOrFail();
	$coleccion = $empleado->Vacaciones()->orderBy('Start_date', 'Des');
	$pdf = PDF::loadView('Pdf.vacaciones_usuario', ['empleado' => $empleado, 'coleccion' => $coleccion]);
	return $pdf->download('vacaciones_usuario.pdf');
})->name('vacaciones_usuario');
/** Rutas para la creación de archivos pdf's Fin **/





/** Routas para visualizar detalle de graficas inicio **/
Route::get('Grafica/genero', function () {
    return view('Grafica/genero');
})->name('Grafica.genero');

Route::get('graficos/genero_1/{inicio?}/{fin?}', function ($inicio = NULL, $fin = NULL) {
    return view('graficos/genero_1')->with('inicio', $inicio)->with('fin', $fin);
})->name('graficos.genero_1');

Route::get('Grafica/edades', function () {
    return view('Grafica/edades');
})->name('Grafica.edades');

Route::get('graficos/edades_1/{inicio?}/{fin?}', function ($inicio = NULL, $fin = NULL) {
    return view('graficos/edades_1')->with('inicio', $inicio)->with('fin', $fin);
})->name('graficos.edades_1');

Route::get('Grafica/razones_baja', function () {
    return view('Grafica/razones_baja');
})->name('Grafica.razones_baja');

Route::get('graficos/razones_baja_1/{inicio?}/{fin?}', function ($inicio = NULL, $fin = NULL) {
    return view('graficos/razones_baja_1')->with('inicio', $inicio)->with('fin', $fin);
})->name('graficos.razones_baja_1');

Route::get('Grafica/estado_civil', function () {
    return view('Grafica/estado_civil');
})->name('Grafica.estado_civil');

Route::get('graficos/estado_civil_1/{inicio?}/{fin?}', function ($inicio = NULL, $fin = NULL) {
    return view('graficos/estado_civil_1')->with('inicio', $inicio)->with('fin', $fin);
})->name('graficos.estado_civil_1');