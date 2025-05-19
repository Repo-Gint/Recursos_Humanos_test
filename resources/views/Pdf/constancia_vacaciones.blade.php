<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style>

            footer {
                position: fixed; 
                bottom: -40px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 9px;
                color: #BFBFBF;
               
            }

            span{
            	color: #0074BD;
            }
            hr{
            	color: #0074BD;
            }
        </style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 18px;">
	@php
		$puesto = $empleado->Puesto->last();
		$dep = $puesto->Departamento;
		$ingreso = $empleado->Contrataciones->last();
		$fecha = explode("-", $ingreso->High_date);
		
		$F_Ingreso = new DateTime($ingreso->High_date);
		$F_Actual = new Datetime(date('Y-m-d'));
		$diferencia= $F_Ingreso->diff($F_Actual);

		if($diferencia->y == 1){
			$dias = 10;
		}
		if($diferencia->y > 1){
			$dias = 15;
		}
	@endphp
<img src="../public/images/img_encabezado.jpg" width="100%">
<br>
<p style="text-align: right;">
	Toluca, Estado de México; {{ date('d').' de '.mes_espanol(date('m')).' de '.date('Y') }} 
</p>
<br><br>
<p style="text-align: right; font-size: 12px;">
<i>Las vacaciones de muchas personas no son viajes de descubrimiento, sino rituales de tranquilidad.<br>
(Philip Andrew Adams)</i>
</p>
<br><br>
<p style="text-align: left;">
	En atención a:  <strong>{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</strong><br>
	Área: <strong>{{ $dep->Departament_ES }}</strong>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nómina:  <strong>{{ $empleado->Code}}</strong>
</p>
<br>

<p style="text-align: justify;">
	Por medio de la presente, se hace constar que con fecha de ingreso del <strong>{{ $fecha[2] }}</strong> de <strong>{{ mes_espanol($fecha[1]) }}</strong> del <strong>{{ $fecha[0] }}</strong>  a la compañía, cumple una antigüedad de <strong>{{ Year($diferencia->y) }}</strong>, por lo que es grato informarle que tiene derecho a <strong>{{ $dias }} días de vacaciones</strong> del periodo correspondiente a este año, el cual puede disfrutar a partir del día <strong>{{ $fecha[2] }}</strong> de <strong>{{ mes_espanol($fecha[1]) }}</strong> del presente año al <strong>{{ $fecha[2] }}</strong> de <strong>{{ mes_espanol($fecha[1]) }}</strong> del siguiente año.<br><br>

	Grupo Interconsult, haciendo cumplir la LFT en su Artículo 76 “Los trabajadores que tengan más de un año de servicios disfrutarán de un período anual de vacaciones, que en ningún caso podrá ser inferior a seis días laborables…” Te invita a programar tus vacaciones con tu jefe inmediato y notificar a Recursos Humanos.
<br><br><br><br>
	</p>

<center>
	Atentamente
	<br><br><br><br><br><br>
   	Recursos Humanos
</center>


<footer>
	5a. Constancia de Vacaciones
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Página 1 de 1
	<hr>
	Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México 
	<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>

</footer>
</body>
</html>