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
			//2 años = 14 dias
			if($diferencia->days >= 730 && $diferencia->days < 1095){
				return 14;
			}
			//3 años = 16 dias
			if($diferencia->days >= 1095 && $diferencia->days < 1460){
				return 16;
			}
			//4 años = 18 dias
			if($diferencia->days >= 1460 && $diferencia->days < 1825){
				return 18;
			}
			//5 años = 20 dias
			if($diferencia->days >= 1825 && $diferencia->days < 2190){
				return 20;
			}
			//6 años a 10 años = 22 dias
			if($diferencia->days >=  2190 && $diferencia->days < 5840){
				return 22;
			}
			//11 años a 15 años = 24 dias
			if($diferencia->days >=  5840 && $diferencia->days < 11315){
				return 24;
			}
            //16 años a 20 años = 26 dias
			if($diferencia->days >=  11315 && $diferencia->days < 18615){
				return 26;
			}
			//21 años a 25 años = 28 dias
			if($diferencia->days >=  18615 && $diferencia->days < 27740){
				return 28;
			}
			//26 años a 30 años = 30 dias
			if($diferencia->days >=  27740 && $diferencia->days < 38690){
				return 30;
			}
			//31 años a 35 años = 32 dias
			if($diferencia->days >=  38690 && $diferencia->days < 51465){
				return 32;
			}
		}
	}else{
		if($diferencia->days < 365){
			return 0;
		}else{
			if($diferencia->days >= 365){
				return 10;
			}

		}
	}
}

function Saldo($date, $disfrutados){
	/*
	*	1 año = 10 días
	*	2 años = 14 días
    *   3 años = 16 días
    *   4 años = 18 días
    *   5 años = 20 días
    *   6 a 10 años = 22 días
	*	11 años a 15 años = 24 días
	*	16 años a 20 años = 26 dias
	*	21 años a 25 años = 28 dias
	*	26 años a 30 años = 30 días
	*   31 años a 35 años = 32 días
	*/
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));

	$diferencia= $F_Ingreso->diff($F_Actual);

	if($diferencia->y == 0){
		return 0 - $disfrutados;


    }

	if($diferencia->y == 1){
		return 10 - $disfrutados;
	}

	//2 años 14 DIAS POR 2 AÑOS
	if($diferencia->y == 2){
		$saldo_tmp = (($diferencia->y*14) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}
	
	//3 años 16 DIAS POR 3 AÑOS
	if($diferencia->y == 3){
		$saldo_tmp = (($diferencia->y*16) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}
	//4 años 18 DIAS POR 4 AÑOS
	if($diferencia->y == 4){
		$saldo_tmp = (($diferencia->y*18) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}
	
        //5 años 20 DIAS POR 5 AÑOS
	if($diferencia->y == 5){
		$saldo_tmp = (($diferencia->y*20) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}
	
        //6 A 10 años 22 DIAS POR 6-10 AÑOS
	if($diferencia->y >= 6 && $diferencia->y <= 10){
		$saldo_tmp = (($diferencia->y*22) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

        //11 A 15 años 24 DIAS POR 11-15 AÑOS
	if($diferencia->y >= 11 && $diferencia->y <= 15){
		$saldo_tmp = (($diferencia->y*24) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

        //16 A 20 años 26 DIAS POR 16-20 AÑOS
	if($diferencia->y >= 16 && $diferencia->y <= 20){
		$saldo_tmp = (($diferencia->y*26) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

        //21 A 25 años 28 DIAS POR 21-25 AÑOS
	if($diferencia->y >= 21 && $diferencia->y <= 25){
		$saldo_tmp = (($diferencia->y*28) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

        //26 A 30 años 30 DIAS POR 26-30 AÑOS
	if($diferencia->y >= 26 && $diferencia->y <= 30){
		$saldo_tmp = (($diferencia->y*30) - 5) ;
		return $saldo_tmp - $disfrutados; 
	}

        //30 A 35 años 32 DIAS POR 30-35 AÑOS
	if($diferencia->y >= 30 && $diferencia->y <= 35){
		$saldo_tmp = (($diferencia->y*32) - 5) ;
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
	if($saldo < -10 || $total < -10){
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
			$msj = 'Whoops!! Sobrepaso el limite de saldo negativo en sus vacaciones. Solo se tiene un limite de -10 dias por periodo.';
		}
	}else{
		$msj = 'Whoops!! La fecha que intentas colocar es menor a la fecha de ingreso.';
	}
	

	return $msj;

}

function validar_asignacion_vacaciones($dias, $saldo, $tipo){
	if($tipo->Type == 'Confianza' || $tipo->Type == 'Sindicalizado'){
		//se redujo la fecha a 90 dias (3 meses) para asignación de vacaciones.
		if($dias > 90){
			if($saldo > -10){
				return "Ninguno";
			}else{
				return "Lo siento, este empleado tiene un saldo negativo de -10 dias.";
			}
		}else{
			return "Lo siento, este empleado todavia no cuenta con la antigüedad suficiente.";
		}
	}else{
		if($tipo->Type == 'Dual' || $tipo->Type == 'Practicante'){
			if($dias > 365){
				if($saldo >= 0){
					return "Ninguno";
				}else{
					return "Lo siento, este empleado tiene un saldo negativo de -10 dias.";
				}
			}else{
				return "Lo siento, este empleado todavia no cuenta con la antigüedad suficiente.";
			}
		}
	}
} 
?>