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
			//De 6 a 10 años:22 días de vacaciones
			//6 años = 22 dias
			if($diferencia->days >= 2190 && $diferencia->days < 2555){
				return 22;
			}
			//7 años = 22 dias
			if($diferencia->days >= 2555 && $diferencia->days < 2920){
				return 22;
			}
			//8 año = 22 dias
			if($diferencia->days >= 2920 && $diferencia->days < 3285){
				return 22;
			}
			//9 años = 22 dias
			if($diferencia->days >= 3285 && $diferencia->days < 3650){
				return 22;
			}
			//10 años = 22 dias
			if($diferencia->days >= 3650 && $diferencia->days < 4015){
				return 22;
			}
			//De 11 a 15 años: 24 días de vacaciones
			//11 años = 24 dias
			if($diferencia->days >= 4015 && $diferencia->days < 4380){
				return 24;
			}
			//12 años = 24 dias
			if($diferencia->days >= 4380 && $diferencia->days < 4745){
				return 24;
			}
			//13 años = 24 dias
			if($diferencia->days >= 4745 && $diferencia->days < 5110){
				return 24;
			}
			//14 años = 24 dias
			if($diferencia->days >= 5110 && $diferencia->days < 5475){
				return 24;
			}
			//15 años = 24 dias
			if($diferencia->days >= 5475 && $diferencia->days < 5840){
				return 24;
			}
			//De 16 a 20 años: 26 días de vacaciones
			//16 años = 26 dias
			if($diferencia->days >= 5840 && $diferencia->days < 6205){
				return 26;
			}
			//17 años = 26 dias
			if($diferencia->days >= 6205 && $diferencia->days < 6570){
				return 26;
			}
			//18 años = 26 dias
			if($diferencia->days >= 6570 && $diferencia->days < 6935){
				return 26;
			}
			//19 años = 26 dias
			if($diferencia->days >= 6935 && $diferencia->days < 7300){
				return 26;
			}
			//20 años = 26 dias
			if($diferencia->days >= 7300 && $diferencia->days < 7665){
				return 26;
			}
			//De 21 a 25 años: 28 días de vacaciones
			//21 años = 28 dias
			if($diferencia->days >= 7665 && $diferencia->days < 8030){
				return 28;
			}
			//22 años = 28 dias
			if($diferencia->days >= 8030 && $diferencia->days < 8395){
				return 28;
			}
			//23 años = 28 dias
			if($diferencia->days >= 8395 && $diferencia->days < 8760){
				return 28;
			}
			//24 años = 28 dias
			if($diferencia->days >= 8760 && $diferencia->days < 9125){
				return 28;
			}
			//25 años = 28 dias
			if($diferencia->days >= 9125 && $diferencia->days < 9490){
				return 28;
			}
			//De 26 a 30 años: 30 días de vacaciones
			//26 años = 30 dias
			if($diferencia->days >= 9490 && $diferencia->days < 9855){
				return 30;
			}
			//27 años = 30 dias
			if($diferencia->days >= 9855 && $diferencia->days < 10220){
				return 30;
			}
			//28 años = 30 dias
			if($diferencia->days >= 10220 && $diferencia->days < 10585){
				return 30;
			}
			//29 años = 30 dias
			if($diferencia->days >= 10585 && $diferencia->days < 10950){
				return 30;
			}
			//30 años = 30 dias
			if($diferencia->days >= 10950 && $diferencia->days < 11315){
				return 30;
			}
			//De 31 a 35 años: 32 días de vacaciones
			//31 año2 = 32 dias
			if($diferencia->days >= 11315 && $diferencia->days < 11680){
				return 32;
			}
			//32 años = 32 dias
			if($diferencia->days >= 11680 && $diferencia->days < 12045){
				return 32;
			}
			//33 años = 32 dias
			if($diferencia->days >= 12045 && $diferencia->days < 12410){
				return 32;
			}
			//34 años = 32 dias
			if($diferencia->days >= 12410 && $diferencia->days < 12775){
				return 32;
			}
			//35 años = 32 dias
			if($diferencia->days >= 12775 && $diferencia->days < 13140){
				return 32;
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
	*	1 año = 12 dias
	*	2 años = 14 dias
	*	3 años = 16 dias
	*	4 años = 18 dias
	*	5 años = 20 dias
	*	6 años a 10 años = 22 dias
	*	11 años a 15 años = 24 dias
	*	16 años a 20 años = 26 dias
	*	21 años a 25 años = 28 dias
	*	26 años a 30 años = 30 dias
	*	31 años a 35 años = 32 dias
	*/
	$F_Ingreso = new DateTime($date);
	$F_Actual = new Datetime(date('Y-m-d'));
	$diferencia= $F_Ingreso->diff($F_Actual);


$ann=$date;
$ano_alta = strtotime($ann);
$anio_alta = date("Y", $ano_alta);
$anos_diferencia=2023-$anio_alta;

//Se definen los valores dependiendo los años laborados, para sacar el saldo de vacaciones por usuario
if ($diferencia->y ==0){
	$valor=0;
	$restar=0;
}
elseif ($diferencia->y ==1){
	$valor=12;
	$restar=0;
}
elseif ($diferencia->y ==2){
	$valor=14;
	$restar=2;
}
elseif ($diferencia->y ==3){
	$valor=16;
	$restar=6;
}
elseif ($diferencia->y ==4){
	$valor=18;
	$restar=12;
}
elseif ($diferencia->y ==5){
	$valor=20;
	$restar=20;
}
elseif ($diferencia->y >=6 && $diferencia->y <=10){
	$valor=22;
	$restar=30;
}
elseif ($diferencia->y >=11 && $diferencia->y <=15){
	$valor=24;
	$restar=50;
}
elseif ($diferencia->y >=16 && $diferencia->y <=20){
	$valor=26;
	$restar=80;
}
elseif ($diferencia->y >=21 && $diferencia->y <=25){
	$valor=28;
	$restar=120;
}
elseif ($diferencia->y >=26 && $diferencia->y <=30){
	$valor=30;
	$restar=200;
}
elseif ($diferencia->y >=31){
	$valor=32;
	$restar=230;
}

	if($diferencia->y == 0){
		return 0 - $disfrutados;
	}

	if($diferencia->y == 1){
		return 12 - $disfrutados;
	}
	//2 años * 14 dias = 28 dias - 2 dias = 26 dias acumulados a los 2 años
		if($diferencia->y == 2){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
			return $saldo_tmp - $disfrutados; 
	}
	//3 años * 16 dias = 48 dias - 6 dias = 42 dias acumulados a los 3 años
		if($diferencia->y == 3){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
			return $saldo_tmp - $disfrutados; 
	}
	//4 años * 18 dias = 72 dias - 12 dias = 60 dias acumulados a los 4 años
		if($diferencia->y == 4){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados; 
	}
	//5 años * 20 dias = 100 dias - 20 dias = 80 dias acumulados a los 5 años
		if($diferencia->y == 5){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados; 
	}	
	//6 años * 22 dias = 132 dias - 30 dias = 102 dias acumulados a los 6 años
		if($diferencia->y == 6){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}	
	//7 años * 22 dias = 154 dias - 30 dias = 124 dias acumulados a los 7 años
		if($diferencia->y == 7){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}	
	//8 años * 22 dias = 176 dias - 30 dias = 146 dias acumulados a los 8 años
		if($diferencia->y == 8){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//9 años * 22 dias = 198 dias - 30 dias = 168 dias acumulados a los 9 años
		if($diferencia->y == 9){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//10 años * 22 dias = 220 dias - 30 dias = 190 dias acumulados a los 10 años
		if($diferencia->y == 10){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//11 años * 24 dias = 264 dias - 50 dias = 214 dias acumulados a los 11 años
		if($diferencia->y == 11){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//12 años * 24 dias = 288 dias - 50 dias = 238 dias acumulados a los 12 años
		if($diferencia->y == 12){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//13 años * 24 dias = 312 dias - 50 dias = 262 dias acumulados a los 13 años
		if($diferencia->y == 13){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//14 años * 24 dias = 336 dias - 50 dias = 286 dias acumulados a los 14 años
		if($diferencia->y == 14){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//15 años * 24 dias = 360 dias - 50 dias = 310 dias acumulados a los 15 años
		if($diferencia->y == 15){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//16 años * 26 dias = 416 dias - 80 dias = 336 dias acumulados a los 16 años
		if($diferencia->y == 16){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//17 años * 26 dias = 442 dias - 80 dias = 362 dias acumulados a los 17 años
		if($diferencia->y == 17){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//18 años * 26 dias = 468 dias - 80 dias = 388 dias acumulados a los 18 años
		if($diferencia->y == 18){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//19 años * 26 dias = 494 dias - 80 dias = 414 dias acumulados a los 19 años
		if($diferencia->y == 19){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//20 años * 26 dias = 520 dias - 80 dias = 440 dias acumulados a los 20 años
		if($diferencia->y == 20){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//21 años * 28 dias = 588 dias - 120 dias = 468 dias acumulados a los 21 años
		if($diferencia->y == 21){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//22 años * 28 dias = 616 dias - 120 dias = 496 dias acumulados a los 22 años
		if($diferencia->y == 22){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//23 años * 28 dias = 644 dias - 120 dias = 524 dias acumulados a los 23 años
		if($diferencia->y == 23){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}	
	//24 años * 28 dias = 672 dias - 120 dias = 552 dias acumulados a los 24 años
		if($diferencia->y == 24){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//25 años * 28 dias = 700 dias - 120 dias = 580 dias acumulados a los 25 años
		if($diferencia->y == 25){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//26 años * 30 dias = 780 dias - 200 dias = 610 dias acumulados a los 26 años
		if($diferencia->y == 26){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//27 años * 30 dias = 810 dias - 170 dias = 640 dias acumulados a los 27 años
		if($diferencia->y == 27){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//28 años * 30 dias = 840 dias - 170 dias = 670 dias acumulados a los 28 años
		if($diferencia->y == 28){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//29 años * 30 dias = 870 dias - 170 dias = 700 dias acumulados a los 29 años
		if($diferencia->y == 29){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//30 años * 30 dias = 870 dias - 170 dias = 730 dias acumulados a los 30 años
		if($diferencia->y == 30){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//31 años * 32 dias = 992 dias - 230 dias = 762 dias acumulados a los 31 años
		if($diferencia->y == 31){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//32 años * 32 dias = 1024 dias - 230 dias = 794 dias acumulados a los 32 años
		if($diferencia->y == 32){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//33 años * 32 dias = 1056 dias - 230 dias = 826 dias acumulados a los 29 años
		if($diferencia->y == 33){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//34 años * 32 dias = 1080 dias - 230 dias = 858 dias acumulados a los 29 años
		if($diferencia->y == 34){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
		return $saldo_tmp - $disfrutados;
	}
	//35 años * 32 dias = 1120 dias - 230 dias = 890 dias acumulados a los 29 años
		if($diferencia->y == 35){
		$saldo_tmp = (($diferencia->y*$valor) - $restar) ;
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

			}elseif($adelantadas == 3){
				return "Ajuste";
			}
		}
	}
}


/* aqui viene lo de vacaciones adelantadas*/


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
		//se ajustan dias a 90 dias (3 meses) para asignación de vacaciones.
		if($dias > 90){
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