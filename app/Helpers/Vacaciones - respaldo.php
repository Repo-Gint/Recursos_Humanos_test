<?php
function Edad($cumple){
	$F_Cumple = new DateTime($cumple);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Cumple->diff($F_Actual);

	return Year($diferencia->y);

}

function Antiguedad($date){
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	return Year($diferencia->y)."".Month($diferencia->m)."".Days($diferencia->d);

}

function empleado_duracion($start_date, $end_date){
	$F_Ingreso = new DateTime($start_date);
	$F_Actual = new Datetime($end_date);

	$diferencia= $F_Ingreso->diff($F_Actual);

	return Year($diferencia->y)."".Month($diferencia->m)."".Days($diferencia->d);

}
function Year ($year){
	if($year == 0){
		return "";
	}else{
		if($year == 1){
			return $year." año ";
		}else{
			if($year > 1){
				return $year." años ";
			}
		}
	}
}

function Month ($month){
	if($month == 0){
		return "";
	}else{
		if($month == 1){
			return $month." mes ";
		}else{
			if($month > 1){
				return $month." meses ";
			}
		}
	}
}

function Days ($days){
	if($days == 0){
		return "";
	}else{
		if($days == 1){
			return $days." día ";
		}else{
			if($days > 1){
				return $days." días ";
			}
		}
	}
}

function Formato ($date){
	$date=date_create($date);
	return date_format($date, "d.m.Y");
}

function Formato_ingles ($date){
	$date=explode("-",$date);
	return $date[0].$date[1].$date[2];
}

function Periodo_actual($fecha_ingreso){

	$array_fecha_ingreso = explode('-', $fecha_ingreso);
	$array_fecha_actual = explode('-', date('Y-m-d'));

	if($array_fecha_actual[0] == $array_fecha_ingreso[0]){
		$fecha_fin_perido = date("Y-m-d",strtotime($fecha_ingreso."+ 1 year"));
		$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
		$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
		return $array_fecha_ingreso[2].'.'.$array_fecha_ingreso[1].'.'.$array_fecha_ingreso[0].' - '.Formato($fecha_fin_perido);
	}else{
		if($array_fecha_actual[0] > $array_fecha_ingreso[0]){
			$fecha = $array_fecha_actual[0].'-'.$array_fecha_ingreso[1].'-'.$array_fecha_ingreso[2];
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha."+ 1 year"));
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
			$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
			return Formato($fecha).' - '.Formato($fecha_fin_perido);
		}else{
			return 'Error';
		}
	}
	

	
 	/*$ingreso = new DateTime($date);
	$fecha_actual = new DateTime(date('Y-m-d'));
	$interval = $ingreso->diff($fecha_actual);
    $dia_menos_ingreso = date("Y-m-d",strtotime(date($date)."- 1 days"));
	if($interval->days <= 365){
		$array = explode("-", $date);
		$actual = date("Y-m-d");
		$array_actual = explode("-", $actual);
		$array_dia_antes = explode("-", $dia_menos_ingreso);
		if($array[0] == $array_actual[0]){
				return $array[2].".".$array[1].".".$array[0]." - ".$array_dia_antes[2].".".$array_dia_antes[1].".".($array_actual[0]+1);
		}
		return $array[2].".".$array[1].".".$array[0]." - ".$array_dia_antes[2].".".$array_dia_antes[1].".".($array_actual[0]);
	}else{
		$array = explode("-", $date);
		$actual = date("Y-m-d");
		$array_actual = explode("-", $actual);
		$array_dia_antes = explode("-", $dia_menos_ingreso);
		return $array[2].".".$array[1].".".$array_actual[0]." - ".$array_dia_antes[2].".".$array_dia_antes[1].".".($array_actual[0]+1);
	}*/

}

function Dias_Disfrutar($date, $tipo_empleado){
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);
	if($tipo_empleado == 1 || $tipo_empleado == 2){
		if($diferencia->days < 365){
			return 0;
		}else{
			//1 año = 12 dias
			if($diferencia->days >= 365 && $diferencia->days < 730){
				return 12;
			}
			//2 años a 9 años = 15 dias
			if($diferencia->days >= 730 && $diferencia->days < 3285){
				return 15;
			}
			//10 años a 14 años = 16 dias
			if($diferencia->days >= 3285 && $diferencia->days < 5110){
				return 16;
			}
			//15 años a 19 años = 18 dias
			if($diferencia->days >= 5110 && $diferencia->days < 6935){
				return 18;
			}
			//20 años a 24 años = 20 dias
			if($diferencia->days >= 6935 && $diferencia->days < 8760){
				return 20;
			}
			//25 años a 29 años = 22 dias
			if($diferencia->days >=  8760 && $diferencia->days < 10585){
				return 22;
			}

		}
	}else{
		if($diferencia->days < 365){
			return 0;
		}else{
			if($diferencia->days >= 365){
				return 12;
			}

		}
	}
}

function Saldo($date, $disfrutados){
	/*
	*	1 año = 12 días
	*	2 años a 9 años = 15 días
	*	10 años a 14 años = 16 días
	*	15 años a 19 años = 18 dias
	*	20 años a 24 años = 20 dias
	*	25 años a 29 años = 22 días
	*/
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	if($diferencia->y == 0){
		return 0 - $disfrutados;
	}

	if($diferencia->y == 1){
		return 12 - $disfrutados;
	}

	//2 años * 15 dias = 30 dias - 5 dias = 25 dias acumulados a los 2 años
	if($diferencia->y >= 2 && $diferencia->y <= 9){
		$saldo_tmp = (($diferencia->y*15) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

	//10 años * 16 dias = 160 dias - 14 dias = 146 dias acumulados a los 10 años
	if($diferencia->y >= 10 && $diferencia->y <= 14){
		$saldo_tmp = (($diferencia->y*16) - 14) ;
		return $saldo_tmp - $disfrutados; 
	}
	//15 años * 18 dias = 270 dias - 42 dias = 228 dias acumulados a los 15 años
	if($diferencia->y >= 15 && $diferencia->y <= 19){
		$saldo_tmp = (($diferencia->y*18) - 42) ;
		return $saldo_tmp - $disfrutados; 
	}

	//20 años * 20 dias = 400 dias - 80 dias = 320 dias acumulados a los 20 años
	if($diferencia->y >= 20 && $diferencia->y <= 24){
		$saldo_tmp = (($diferencia->y*20) - 80) ;
		return $saldo_tmp - $disfrutados; 
	}

	//25 años * 22 dias = 550 dias - 128 dias = 422 dias acumulados a los 25 años
	if($diferencia->y >= 25 && $diferencia->y <= 29){
		$saldo_tmp = (($diferencia->y*22) - 128) ;
		return $saldo_tmp - $disfrutados; 
	}
}

function Dias($inicio, $fin){
	$F1= strtotime($inicio);
	$F2= strtotime($fin);

	$diferencia= abs($F1-$F2); 
	
	$dias=floor(((($diferencia/60)/60)/24));
    return $diferencia->d + 1;
}

function Dias_disfrutados($contratacion, $empleado){
	$dias_disfrutados = 0;
	
	foreach($empleado->Vacaciones as $vacaciones){
        $dias_disfrutados = $dias_disfrutados + $vacaciones->Days;
    }

    return $dias_disfrutados;
}

function Tipo_Vacacion($pagadas, $adelantadas){
	if($pagadas == 0 && $adelantadas == 0){
		return "Disfrutadas";
	}else{
		if($pagadas == 1){
			return "Pagadas";
		}else{
			if($adelantadas == 1){
				return "Adelantadas";

			}
		}
	}
}


/* aqui venia lo de vacaciones adelantadas*/


function vacaciones_adelantadas($saldo, $fecha_alta, $f_inicio, $f_fin){
	$ingreso = new DateTime($fecha_alta);
	$inicio_vacaciones = new DateTime($f_inicio);
	$interval = $ingreso->diff($inicio_vacaciones);

	if($interval->days <= 365){
		return 1;
	}

	if($saldo <= 0){
		return 1;
	}

	return 0;
}




function periodo_vacaciones($f_inicio, $ingreso){

	$inicio_de_periodo = $ingreso; 
	$fin_de_periodo = date("Y-m-d",strtotime($inicio_de_periodo."+ 1 year"));  //primero se le suma un año
	$fin_de_periodo = date("Y-m-d",strtotime($fin_de_periodo."- 1 days")); // despues se le resta un dia
	$ban = 0;

	while($ban == 0){
		$inicio_de_periodo_check = strtotime($inicio_de_periodo);
		$fin_de_periodo_check = strtotime($fin_de_periodo);
		$f_inicio_check = strtotime($f_inicio);

		if(($f_inicio_check >= $inicio_de_periodo_check) && ($f_inicio_check <= $fin_de_periodo_check)) {

	         $ban = 1;
	         $periodo = Formato($inicio_de_periodo).' - '.Formato($fin_de_periodo);
	     } else {
	     	$inicio_de_periodo = date("Y-m-d",strtotime($inicio_de_periodo."+ 1 year"));  
			$fin_de_periodo = date("Y-m-d",strtotime($inicio_de_periodo."+ 1 year"));  //primero se le suma un año
			$fin_de_periodo = date("Y-m-d",strtotime($fin_de_periodo."- 1 days")); // despues se le resta un dia         

	     }
	}
	

/*	$array_fecha_ingreso = explode('-',  $ingreso);
	$array_fecha_vaciones = explode('-', $f_inicio);

	if($array_fecha_vacaciones[0] == $array_fecha_ingreso[0]){ //si el año es el mismo
		if($array_fecha_vaciones[1] > $array_fecha_ingreso[1]){

		}




		$fecha_fin_perido = date("Y-m-d",strtotime($ingreso."+ 1 year"));
		$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
		$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
		return $array_fecha_ingreso[2].'.'.$array_fecha_ingreso[1].'.'.$array_fecha_ingreso[0].' - '.Formato($fecha_fin_perido);
	}else{
		if($array_fecha_actual[0] > $array_fecha_ingreso[0]){
			$fecha = $array_fecha_actual[0].'-'.$array_fecha_ingreso[1].'-'.$array_fecha_ingreso[2];
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha."+ 1 year"));
			$fecha_fin_perido = date("Y-m-d",strtotime($fecha_fin_perido."- 1 days"));
			$array_fecha_fin_perido = explode('-', $fecha_fin_perido);
			return Formato($fecha).' - '.Formato($fecha_fin_perido);
		}else{
			return 'Error';
		}
	}*/


	/*$array_ingreso = explode("-", $ingreso);
	$array_f_inicio = explode("-", $f_inicio);

	$year_ingreso = (int) $array_ingreso[0];
	$year_f_inicio = (int) $array_f_inicio[0];

	$month_ingreso = (int) $array_ingreso[1];
	$month_f_inicio = (int) $array_f_inicio[1];

	$day_ingreso = (int) $array_ingreso[2];
	$day_f_inicio = (int) $array_f_inicio[2];
		$fecha = '';

	$ban = 0;

	while ($ban == 0 ) {
		if($year_ingreso == $year_f_inicio){
			if($month_ingreso < $month_f_inicio){
				$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".$year_ingreso;
				//$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".($year_ingreso+1);
				$periodo_fin = date("d.m.Y",strtotime($periodo_inicio."+ 1 year"));
				$periodo_fin = date("d.m.Y",strtotime($periodo_fin."- 1 days"));
				$periodo = $periodo_inicio." - ".$periodo_fin;
				$ban = 1;
			}else{
				if($month_ingreso > $month_f_inicio){
					$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".($year_ingreso-1);
					//$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".$year_ingreso;
					$periodo_fin =date("d.m.Y",strtotime($periodo_inicio."- 1 days"));
					$periodo = $periodo_inicio." - ".$periodo_fin;
					$ban = 1;
				}else{
					if($month_ingreso == $month_f_inicio){
						$fecha = $array_ingreso[2].".".$array_ingreso[1].".".$year_ingreso;
						$fecha_alternativa = date("d.m.Y",strtotime($fecha."+ 1 year"));
						$fecha_alternativa = date("d.m.Y",strtotime($fecha."- 1 days"));
						$array_fecha_alternativa= explode(".", $fecha_alternativa);
						if($day_f_inicio <= $array_fecha_alternativa[0]){

							//$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".($year_ingreso-1);
							$periodo_inicio =  date("d.m.Y",strtotime($fecha."- 1 year"));
							//$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".$year_ingreso;
							$periodo_fin = date("d.m.Y",strtotime($fecha."+ 1 year"));
							$periodo = $periodo_inicio." - ".$periodo_fin;
							$ban = 1;
							
						}else{
							if( $day_f_inicio >= $day_ingreso){
								$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".$year_ingreso;
								//$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".($year_ingreso+1);
								$periodo_fin = date("d.m.Y",strtotime($periodo_inicio."+ 1 year"));
								$periodo_fin = date("d.m.Y",strtotime($periodo_fin."- 1 days"));
								$periodo = $periodo_inicio." - ".$periodo_fin;
								$ban = 1;
							}
						}
					}
				}
			}
		}else{
			$year_ingreso = $year_ingreso + 1;
		}*/

		/*if($year_ingreso == $year_f_inicio){
			$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".$year_ingreso;
			$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".($year_ingreso+1);

			$periodo = $periodo_inicio." - ".$periodo_fin;
			$ban = 1;
		}else{
			if(($month_ingreso == $month_f_inicio) 	&& $day_ingreso > $day_f_inicio){
				$periodo_inicio = $array_ingreso[2].".".$array_ingreso[1].".".$year_ingreso;
				$periodo_fin = ($array_ingreso[2]-1).".".$array_ingreso[1].".".($year_ingreso+1);

				$periodo = $periodo_inicio." - ".$periodo_fin;
				$ban = 1;

			}else{
				$year_ingreso = $year_ingreso + 1;
			}
			
		}*/
	//}

	return $periodo;

}

function Periodos_historial($empleado){

	$vacaciones = $empleado->Vacaciones()->orderBy('Period', 'Des')->get();
	$array = array();
	$i = 0;
	foreach ($vacaciones as $periodo) {
	   $array[$i] = $periodo->Period;
	   $i++;
	   
	}
	$coleccion = array_values(array_unique($array));
	return $coleccion;

}

function validar_fechas($historial, $inicio, $fin){
	$inicio = strtotime($inicio);
	$fin = strtotime($fin);


	foreach ($historial as $historia) {
		$h_inicio = strtotime($historia->Start_date);
		$h_fin = strtotime($historia->Ending_date);

		
		if(($inicio >= $h_inicio) && ($inicio <= $h_fin)){
			return false;
		}

		if(($fin >= $h_inicio) && ($fin <= $h_fin)){
			return false;
		}

		if(($inicio == $h_inicio) || ($inicio == $h_fin)){
			return false;
		}

		if(($fin == $h_inicio) || ($fin == $h_fin)){
			return false;
		}


	}

	return true;


}

function Saldo_negativo($saldo, $dias){

	$total = $saldo - $dias;
	if($saldo < -20 || $total < -20){
		return true;
	}else{
		return false;
	}

}

function Errores_vacaciones($request, $dias, $historial){

	$msj = "";
	$contratacion = strtotime($request['Contratacion']);

	if($request['Paid'] == 0){
		$f_inicio =  strtotime($request['Start_date']);
	}else{
		$f_inicio =  strtotime($request['Paid_date']);
	}

	if($contratacion < $f_inicio){
		if(!Saldo_negativo($request['Saldo'], $dias)){
			if(validar_fechas($historial, $request['Start_date'], $request['Ending_date'])){
				$msj = "Ninguno";

			}else{
				$msj = "Whoops!! Las fechas o el rango de fechas que ingresaste ya se tienen registradas o estan dentro de un rango ya registrado.";
			}

		}else{
			$msj = 'Whoops!! Sobrepaso el limite de saldo negativo en sus vacaciones. Solo se tiene un limite de -20 dias por periodo.';
		}
	}else{
		$msj = 'Whoops!! La fecha que intentas colocar es menor a la fecha de ingreso.';
	}
	

	return $msj;

}

function validar_asignacion_vacaciones($dias, $saldo, $tipo){
	if($tipo->Type == 'Confianza' || $tipo->Type == 'Sindicalizado'){
		//se ajustan dias a 365 dias (12 meses) para asignación de vacaciones.
		if($dias > 365){
			if($saldo > -20){
				return "Ninguno";
			}else{
				return "Lo siento, este empleado tiene un saldo negativo de -20 dias.";
			}
		}else{
			return "Lo siento, este empleado todavia no cuenta con la antigüedad suficiente para disponer de vacaciones.";
		}
	}else{
		if($tipo->Type == 'Dual' || $tipo->Type == 'Practicante'){
			if($dias > 365){
				if($saldo >= 0){
					return "Ninguno";
				}else{
					return "Lo siento, este empleado tiene un saldo negativo de -20 dias.";
				}
			}else{
				return "Lo siento, este empleado todavia no cuenta con la antigüedad suficiente.";
			}
		}
	}
} 
?>