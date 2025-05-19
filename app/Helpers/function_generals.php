<?php
function total_empleados(){
	$empleados = DB::table('employees')->where('Active', '=', 1)->get();

	return $empleados->count();
}

function total_empleados_bajas($dato){
	$inicio = new DateTime();
	$inicio->modify('first day of this month');
	$inicio = $inicio->format('Y-m-d');

	$fin = new DateTime();
	$fin->modify('last day of this month');
	$fin = $fin->format('Y-m-d');

	$empleados = DB::table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Active', '=', 0)->whereBetween('Low_date', [$inicio, $fin])->get();

	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_empleados_altas($dato){
	$inicio = new DateTime();
	$inicio->modify('first day of this month');
	$inicio = $inicio->format('Y-m-d');

	$fin = new DateTime();
	$fin->modify('last day of this month');
	$fin = $fin->format('Y-m-d');

	$empleados = DB::table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Active', '=', 1)->whereBetween('High_date', [$inicio, $fin])->get();

	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_empleados_departamento($id){

	$empleados = DB::table('employees')
	->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
	->join('positions', 'employee_position.Position_id', '=', 'positions.id')
	->where('Departament_id', '=', $id)
	->where('employees.Active', '=', 1)
	->get();
	
	return $empleados->count();
	
}

function total_empleados_contrato($dato){
	$empleados = DB::table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Typecontract_id', '=', 2)
	->orWhere('Typecontract_id', '=', 3)
	->orderBy('Ending', 'Asc')
	->get();

	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
	
}


function total_empleados_mes($dato){

	$inicio = new DateTime();
	$inicio->modify('first day of this month');
	$inicio = $inicio->format('Y-m-d');

	$fin = new DateTime();
	$fin->modify('last day of this month');
	$fin = $fin->format('Y-m-d');

	$empleados = DB::table('employees')
	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
	->where('Active', '=', 1)
	->whereBetween('High_date', [$inicio, $fin])
	->get();
	
	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_empleados_cumple($dato){
	$mes = ''.date('m').'';
	$empleados = DB::table('employees')
	->join('datas', 'employees.id', '=', 'datas.Employee_id')
	->whereMonth('Birthdate', $mes)
	->where('Active', '=', 1)
	->get();

	if($dato == "Conteo"){
		return $empleados->count();
	}
	if($dato == "Coleccion"){
		return $empleados;
	}
}

function total_genero($genero, $inicio, $fin){
	if($inicio == null || $fin == null){
		$empleados = DB::table('employees')
		->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Gender', '=', $genero)
		->where('Active', '=', 1)
		->get();
	}else{
		$empleados = DB::table('employees')
		->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
		->where('Gender', '=', $genero)
		->where('Active', '=', 1)
		->where('Low_date', '=', NULL)
		->whereBetween('High_date', [$inicio, $fin])
		->get();
	}
	
	return $empleados->count();
}

function total_empleados_categorias($sexo, $parametro){
	$empleados = collect([]);
	if($sexo == 'Ambos'){
		$query = DB::table('employees')
		->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->join('employee_typeemployee', 'employees.id', '=', 'employee_typeemployee.Employee_id')
		->join('type_employees', 'employee_typeemployee.Typeemployee_id', '=', 'type_employees.id')
		->where('type_employees.Type', '=', $parametro);
	}else{
		$query = DB::table('employees')
		->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->join('employee_typeemployee', 'employees.id', '=', 'employee_typeemployee.Employee_id')
		->join('type_employees', 'employee_typeemployee.Typeemployee_id', '=', 'type_employees.id')
		->where('datas.Gender', '=', $sexo)
		->where('type_employees.Type', '=', $parametro);
	}

	if($parametro == 'Dual'){
		$empleados = $query->orWhere('type_employees.Type', '=', 'Practicante')->where('employees.Active', '=', 1)->get();
	}else{
		$empleados = $query->where('employees.Active', '=', 1)->get();
	}
	//dd($empleados);
	return $empleados->count();
	
}

function razon_baja($inicio, $fin){
	$bajas = DB::table('outputs')->get();
	$razones = "";
	foreach ($bajas as $baja) {
		if($inicio == null || $fin == null){
			$empleados = DB::table('employees')
			->where('Active', '=', 0)
			->where('Output_id', '=', $baja->id)
			->get();
		}else{
			$empleados = DB::table('employees')
			->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
			->where('Active', '=', 0)
			->where('Output_id', '=', $baja->id)
			->whereNotNull('Low_date')
			->whereBetween('Low_date', [$inicio, $fin])
			->get();

		}
		
		$razones .= '{
              	"category": "'.$baja->Type.'",
              	"column-1": '.$empleados->count().'
              },';
	}
	return $razones;
}



function edades($inicio, $fin){
	if($inicio == null || $fin == null){
		$empleados = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->get();
	}else{
		$empleados = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
	 	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
		->where('Active', '=', 1)
		->where('Low_date', '=', NULL)
		->whereBetween('High_date', [$inicio, $fin])
		->get();
	}

	$edades_array = array();
	$i = 0;
	foreach ($empleados as $empleado) {
		$edades_array[$i] = Edad($empleado->Birthdate);
		$i++;
	}
	$menores_18 = 0;
	$r = 0;
	$r26_35 = 0;
	$r36_45 = 0;
	$r46_55 = 0;
	$r56_mayores = 0;
	for ($i=0; $i < count($edades_array) ; $i++) { 
	 	if($edades_array[$i] < 18){
	 		$menores_18++;
	 	}
	 	if($edades_array[$i] >= 18 && $edades_array[$i] <= 25){
	 		$r++;
	 	}
	 	if($edades_array[$i] >= 26 && $edades_array[$i] <= 35){
	 		$r26_35++;
	 	}
	 	if($edades_array[$i] >= 36 && $edades_array[$i] <= 45){
	 		$r36_45++;
	 	}
	 	if($edades_array[$i] >= 46 && $edades_array[$i] <= 55){
	 		$r46_55++;
	 	}
	 	if($edades_array[$i] >= 56){
	 		$r56_mayores++;
	 	}
	 } 
		
	$razones = '{
              	"category": "-18 años",
              	"column-1": '.$menores_18.'
              },
              {
              	"category": "18 a 25 años",
              	"column-1": '.$r.'
              },
              {
              	"category": "26 a 35 años",
              	"column-1": '.$r26_35.'
              },
              {
              	"category": "36 a 45 años",
              	"column-1": '.$r36_45.'
              },
              {
              	"category": "46 a 55 años",
              	"column-1": '.$r46_55.'
              },
              {
              	"category": "+56 años",
              	"column-1": '.$r56_mayores.'
              }';
	return $razones;
}

function diferencia_fechas($fecha_1,$fecha_2,$formato){
	$f_1 = new DateTime($fecha_1);
	$f_2 = new Datetime($fecha_2);
	if($fecha_1 < $fecha_2){
		return 0;
	}

	$diferencia= $f_1->diff($f_2);

	return $diferencia->$formato;
}



function mes_espanol($m){
	switch ($m) {
		case '01':
			return "Enero";
			break;
		case '02':
			return "Febrero";
			break;
		case '03':
			return "Marzo";
			break;
		case '04':
			return "Abril";
			break;
		case '05':
			return "Mayo";
			break;
		case '06':
			return "Junio";
			break;
		case '07':
			return "Julio";
			break;
		case '08':
			return "Agosto";
			break;
		case '09':
			return "Septiembre";
			break;
		case '10':
			return "Octubre";
			break;
		case '11':
			return "Noviembre";
			break;
		case '12':
			return "Diciembre";
			break;

	}

}
function Departamento ($id){
	$departamento = DB::table('departaments')->where('id', '=', $id)->first();
	return $departamento->Departament_ES;
}

function nombre ($empleado, $funcion){
	if($funcion == 'Mostrar'){
		$nombre_array = explode(' ', $empleado->Names);
		return $nombre_array[0].' '.$empleado->Paternal;
	}


}

function Superior ($empleado){
	if($empleado->Parent_Emp == null){
    	$superior = "";
    }else{
    	$puesto = $empleado->Parent_Emp->Puesto->last();
    	$superior = $empleado->Parent_Emp->Names.' '.$empleado->Parent_Emp->Paternal.' '.$empleado->Parent_Emp->Maternal. ' - '.$puesto->Position_ES;
    }
    return $superior;
}

function Carrera_profesional($empleado){
	$arr = array();
	$i = 0;
	$fecha_baja = '0000-00-00';
	$se_dio_de_baja = 0;
	foreach ($empleado->Contrataciones as $contrato) {
		if($i == 0){
			$tipo = $empleado->Tipo_empleado_historial->first();
			$puesto = $empleado->Puestos_historial->first();
			$departamento= $puesto->Departamento;

			$arr[$i] = array(
				'fecha' => $contrato->High_date, 
				'Titulo' => 'Se unio a Grupo Interconsult', 
				'Descripcion1' =>'Tipo de empleado: '.$tipo->Type, 
				'Descripcion2' => 'Puesto: '.$puesto->Position_ES, 
				'Descripcion3' => 'Departamento: '.$departamento->Departament_ES,
				'Color' => 'bg-green',
				'Icono' => 'fa fa-user-plus bg-green'
			);
			$i++;
		}else{
			$baja = DB::table('employee_output')
			->select('employee_output.output_date', 'employee_output.reason_for_dismissal', 'outputs.Type')
			->join('outputs', 'employee_output.Output_id', '=', 'outputs.id')->where('output_date', '=', $contrato->Low_date)->first();
			if($baja != null && $baja->output_date == $contrato->Low_date){
				$arr[$i] = array(
					'fecha' => $contrato->Low_date, 
					'Titulo' => 'Ha salido de Grupointerconsult', 
					'Descripcion1' => 'Tipo de Baja: '.$baja->Type,
					'Descripcion2' => 'Descripción: '.$baja->reason_for_dismissal, 
					'Descripcion3' => '',
					'Color' => 'bg-red',
					'Icono' => 'fa fa-user-times bg-red'
				);
				$i++;
				$se_dio_de_baja=1;
				$fecha_baja = $contrato->Low_date;
			}
			if($se_dio_de_baja && $fecha_baja < $contrato->High_date){
				$arr[$i] = array(
					'fecha' => $contrato->High_date, 
					'Titulo' => 'Ingreso nuevamente a  Grupo Interconsult', 
					'Descripcion1' => 'Tipo de contrato: '.$contrato->Tipo_Contratos->Type,
					'Descripcion2' => '', 
					'Descripcion3' => '',
					'Color' => 'bg-green',
				'Icono' => 'fa fa-user-plus bg-green'
				);
				$i++;
				$se_dio_de_baja=0;
			}else{
				$arr[$i] = array(
					'fecha' => $contrato->High_date, 
					'Titulo' => 'Cambio de contrato', 
					'Descripcion1' => 'Cambio de tipo de contrato: '.$contrato->Tipo_Contratos->Type,
					'Descripcion2' => '', 
					'Descripcion3' => '',
					'Color' => 'bg-blue',
					'Icono' => 'fa fa-tag bg-aqua'
				);
				$i++;
			}
			
		}
	}
	$dual ='No'; 
	foreach ($empleado->Tipo_empleado_historial as $tipo) {
		if($dual == 'No'){
			if($tipo->Type == 'Dual' || $tipo->Type == 'Practicante'){
				$dual = 'Si';
			}
		}else{
			$arr[$i] = array(
				'fecha' => $tipo->pivot->Start_date, 
				'Titulo' => 'Ha sido Contratado', 
				'Descripcion1' => 'El empleado paso de sistema dual / practicante a empleado de '.$tipo->Type,
				'Descripcion2' => '', 
				'Descripcion3' => '',
				'Color' => 'bg-blue',
				'Icono' => 'fa fa-tag bg-aqua'
			);
			$i++;
		}
	}
	$primera_iteracion = 'No'; //comodin para saltar la primera iteraccion
	foreach ($empleado->Puestos_historial as $puesto) {
		if($primera_iteracion == 'No'){
			$primera_iteracion = 'Si';
		}else{
			$arr[$i] = array(
				'fecha' => $puesto->pivot->Start_date, 
				'Titulo' => 'Nuevo Puesto', 
				'Descripcion1' => 'El empleado se le ha asignado un nuevo puesto',
				'Descripcion2' => ' Puesto: '.$puesto->Position_ES, 
				'Descripcion3' => 'Departamento: '.$puesto->Departamento->Departament_ES,
				'Color' => 'bg-blue',
				'Icono' => 'fa fa-tag bg-aqua'
			);
			$i++;
		}
	}

	/*$fin = $empleado->Contrataciones->last();
	if($empleado->Active == 0 && $fin->Low_date != null){
			$arr[$i] =array('fecha' => $fin->Low_date, 'Titulo' => 'Ha dejado Grupo Interconsult', 'Descripcion1' => 'El empleado se dio de baja','Descripcion2' => $empleado->Output_Description, 'Descripcion3' => '');
			$i++;
	}*/
	return $coleccion = collect($arr);
}

function crear_usuario($nombre, $paterno, $materno){
	$nombre_arreglo = explode(" ", $nombre);
	$usuario = strtolower(quitar_tildes($nombre_arreglo[0])." ".quitar_tildes($paterno));
	return $usuario;
}

function crear_password($nombre, $paterno, $materno, $cumple, $encriptada){
	$cumple_arreglo = explode("-", $cumple);
	$pass = "gim".strtolower($nombre[0].$paterno[0].$materno[0].$cumple_arreglo[2].$cumple_arreglo[1]);
	if($encriptada == true){
		return bcrypt($pass);
	}else{
		return $pass;
	}
	
}

function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

function validar_puesto($puesto_id){

	$puesto = DB::table('employee_position')->where('Position_id', $puesto_id);

	$cnt = $puesto->count();

	if($cnt == 0){
		return true;
	}else{
		return false;
	}

}

function validar_documento_entregado($id_documento, $id_empleado){
	$existe = DB::table('employee_document')->where('Employee_id', $id_empleado)->where('Document_id', $id_documento)->get();
	
	if($existe->isEmpty()){
		return true;
	}else{
		return false;
	}
}

function documento_entregado($id_documento, $id_empleado){
	$documento = DB::table('employee_document')->where('Employee_id', $id_empleado)->where('Document_id', $id_documento)->first();
	$v = $documento->Success;
	return $v;
}

function validar_dia($mes, $dia){
	$year = date('Y');

	$ultimo_dia = date("d",(mktime(0,0,0,$mes+1,1,$year)-1));
	if($dia <= $ultimo_dia){
		return true;
	}else{
		return false;
	}
}

function validar_dia_existente($mes, $dia){
	$dia = DB::table("national_holidays")->where('Month', $mes)->where('Day', $dia)->get();
	if($dia->isEmpty()){
		return true;
	}else{
		return false;
	}
}

function dias_festivos(){
	$dias = DB::table("national_holidays")->get();

	$array = "";
	$i = 0;
	foreach ($dias as $dia) {
		$array.= "[".$dia->Month.",".$dia->Day.","."'".$dia->Description."'"."],";
		$i++;
	}
	return $array;

}

function dias_menos_dias_festivos($dias, $fecha_inicio, $fecha_fin){
  $dias_festivos = DB::table("national_holidays")->get();
  foreach ($dias_festivos as $dia) {
    for($i=$fecha_inicio; $i<=$fecha_fin; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    	$dia_semana = date("w",strtotime($i));
        $array = explode("-", $i);
        if($dia->Month == $array[1] && $dia->Day == $array[2]){
        	if($dia_semana != 0 && $dia_semana != 6){
        		$dias = $dias - 1;
        	}	
        }    
    }
  }

  return $dias;

}

function empleados_a_cargo($empleado, $opcion){
	
	if($opcion == "Null"){
		$empleados = DB::table('employees')->where('Parent_id', '=', $empleado->id)->get();
		foreach ($empleados as $empleado) {
			$emp = Recursos_Humanos\Empleado::where('id', '=', $empleado->id)->firstOrFail();
			$emp->Parent_id= NULL;
			$emp->save();
		}
	}else{
		if($opcion == "Asignar"){
			$puesto = $empleado->Puesto->last();
			$empleados= Recursos_Humanos\Empleado::select('employees.id', 'employees.Parent_id')->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
			->join('positions', 'employee_position.Position_id', '=', 'positions.id')
			->where('positions.Parent_id', $puesto->id)
			->get();
			if($empleados->isNotEmpty()){
				foreach ($empleados as $emp) {
					$e = Recursos_Humanos\Empleado::where('id', '=', $emp->id)->firstOrFail();
					$e->Parent_id= $empleado->id;
					$e->save();
				}
			}
		}
	}
	
}
?>