<?php  

function estado_civil($inicio, $fin){
	$estados = DB::table('marital_status')->get();
	$razones = "";
	foreach ($estados as $estado) { 
		if($inicio == null || $fin == null){
			$empleados = DB::table('employees')
		 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
			->where('Active', '=', 1)
			->where('Marital_status_id', '=', $estado->id)
			->get();
		}else{
			$empleados = DB::table('employees')
		 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		 	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
			->where('Active', '=', 1)
			->where('Marital_status_id', '=', $estado->id)
			->where('Low_date', '=', NULL)
			->whereBetween('High_date', [$inicio, $fin])
			->get();
		}
	 	

		$razones .= '{
              	"category": "'.$estado->status.'",
              	"column-1": '.$empleados->count().'
              },';
	 } 
	return $razones;
}

function edades_sexo($inicio, $fin){
	if($inicio == null || $fin == null){
		$empleados_hombres = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Hombre')
		->get();

		$empleados_mujeres = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Mujer')
		->get();
	}else{
		$empleados_hombres = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
	 	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Hombre')
		->where('Low_date', '=', NULL)
		->whereBetween('High_date', [$inicio, $fin])
		->get();

		$empleados_mujeres = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
	 	->join('contracts', 'employees.id', '=', 'contracts.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Mujer')
		->where('Low_date', '=', NULL)
		->whereBetween('High_date', [$inicio, $fin])
		->get();
	}

	$edades_hombre_array = array();
	$edades_mujer_array = array();
	$i = 0;
	foreach ($empleados_hombres as $hombre) {
		$edades_hombre_array[$i] = Edad($hombre->Birthdate);
		$i++;
	}
	$i = 0;
	foreach ($empleados_mujeres as $mujer) {
		$edades_mujer_array[$i] = Edad($mujer->Birthdate);
		$i++;
	}

	$menores_18 = 0;
	$r = 0;
	$r26_35 = 0;
	$r36_45 = 0;
	$r46_55 = 0;
	$r56_mayores = 0;

	$m_menores_18 = 0;
	$m_r = 0;
	$m_r26_35 = 0;
	$m_r36_45 = 0;
	$m_r46_55 = 0;
	$m_r56_mayores = 0;
	for ($i=0; $i < count($edades_hombre_array) ; $i++) { 
	 	if($edades_hombre_array[$i] < 18){
	 		$menores_18++;
	 	}
	 	if($edades_hombre_array[$i] >= 18 && $edades_hombre_array[$i] <= 25){
	 		$r++;
	 	}
	 	if($edades_hombre_array[$i] >= 26 && $edades_hombre_array[$i] <= 35){
	 		$r26_35++;
	 	}
	 	if($edades_hombre_array[$i] >= 36 && $edades_hombre_array[$i] <= 45){
	 		$r36_45++;
	 	}
	 	if($edades_hombre_array[$i] >= 46 && $edades_hombre_array[$i] <= 55){
	 		$r46_55++;
	 	}
	 	if($edades_hombre_array[$i] >= 56){
	 		$r56_mayores++;
	 	}
	 } 
	for ($i=0; $i < count($edades_mujer_array) ; $i++) { 
	 	if($edades_mujer_array[$i] < 18){
	 		$m_menores_18++;
	 	}
	 	if($edades_mujer_array[$i] >= 18 && $edades_mujer_array[$i] <= 25){
	 		$m_r++;
	 	}
	 	if($edades_mujer_array[$i] >= 26 && $edades_mujer_array[$i] <= 35){
	 		$m_r26_35++;
	 	}
	 	if($edades_mujer_array[$i] >= 36 && $edades_mujer_array[$i] <= 45){
	 		$m_r36_45++;
	 	}
	 	if($edades_mujer_array[$i] >= 46 && $edades_mujer_array[$i] <= 55){
	 		$m_r46_55++;
	 	}
	 	if($edades_mujer_array[$i] >= 56){
	 		$m_r56_mayores++;
	 	}
	 }

	$razones = '{
              	"category": "-18 años",
              	"hombres": '.$menores_18.',
              	"mujeres": '.$m_menores_18.'
              },
              {
              	"category": "18 a 25 años",
              	"hombres": '.$r.',
              	"mujeres": '.$m_r.'
              },
              {
              	"category": "26 a 35 años",
              	"hombres": '.$r26_35.',
              	"mujeres": '.$m_r26_35.'
              },
              {
              	"category": "36 a 45 años",
              	"hombres": '.$r36_45.',
              	"mujeres": '.$m_r36_45.'
              },
              {
              	"category": "46 a 55 años",
              	"hombres": '.$r46_55.',
              	"mujeres": '.$m_r46_55.'
              },
              {
              	"category": "+56 años",
              	"hombres": '.$r56_mayores.',
              	"mujeres": '.$m_r56_mayores.'
              }';
	return $razones;
}

function total_empleados_edad_sexo($genero, $rango){
	if($genero == "Hombre"){
		$empleados = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Hombre')
		->get();
	}

	if($genero == "Mujer"){
		$empleados = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->where('Gender', '=', 'Mujer')
		->get();
	}

	if($genero == "Ambos"){
		$empleados = DB::table('employees')
	 	->join('datas', 'employees.id', '=', 'datas.Employee_id')
		->where('Active', '=', 1)
		->get();
	}

	$edades_array = array();
	$i = 0;
	foreach ($empleados as $empleado) {
		$edades_array[$i] = Edad($empleado->Birthdate);
		$i++;
	}
	$total = 0;
	for ($i=0; $i < count($edades_array) ; $i++) { 
	 	if($rango == "18" && ($edades_array[$i] < 18)){
	 		$total++;
	 	}
	 	if($rango == "18-25" && ($edades_array[$i] >= 18 && $edades_array[$i] <= 25)){
	 		$total++;
	 	}
	 	if($rango == "26-35" && ($edades_array[$i] >= 26 && $edades_array[$i] <= 35)){
	 		$total++;
	 	}
	 	if($rango == "36-45" && ($edades_array[$i] >= 36 && $edades_array[$i] <= 45)){
	 		$total++;
	 	}
	 	if($rango == "46-55" && ($edades_array[$i] >= 46 && $edades_array[$i] <= 55)){
	 		$total++;
	 	}
	 	if($rango == "56" && ($edades_array[$i] >= 56)){
	 		$total++;
	 	}
	 }

	 return $total; 
	
}

?>