
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style>
			table{
			  border: 0.2px solid black;
			  border-spacing: 0;
			  width: 100%;

			}
			th, td {
				border: 0.1px solid #DBDBDB;
			}
			th {
				text-align: center;
			}
			body {
                margin-top: 2.5cm;
                margin-left: 0cm;
                margin-right: 0cm;
                margin-bottom: 2cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
            }
            footer {
                position: fixed; 
                bottom: -1px; 
                left: 1cm;
                right: 1cm;
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
<body style="font-family: Arial, Sans-serif; font-size: 8px;">
	<header>
		<img src="../public/images/img_encabezado.jpg" width="100%" height="85">
	</header>
	<footer>		
		<hr>
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
<br>
@if(!$empleados->isEmpty())
	<table  style="border: none;">
		<tr style="border: none; text-align: right;">
			<td colspan="8" style="border: none;">Fecha de Realización: {{ date('d.m.Y H:i')}}</td>
		</tr>
	</table>
	<table >
		<thead>
			<tr style="background-color: #00A2FF; color: white;">
				<th colspan="8" style="text-align: center;">Resumen de vacaciones</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>#</th>
				<th>Nombre del Empleado</th>
				<th>Puesto</th>
				<th>F. de Contratación</th>
				<th>Antig&uuml;edad</th>
				<th>Periodo Actual</th>
				<th>Dias a disfrutar</th>
				<th>Saldo</th>
    		</tr>
		</thead>
		<tbody>
			@php 
    				
				   	$cnt = 0;
				@endphp
		@foreach($departamentos as $departamento)
		        <tr style="background-color: #00A2FF; color: white;">
    				<th colspan="8">{{ $departamento->Departament_ES }}</th>
    			</tr>
    		@foreach($empleados as $empleado)
    			
    			@if($empleado->Departament_id == $departamento->id)
    				@php
    				$cnt++;
    				$contratacion = $empleado->Contrataciones->last();
    				$tipo = $empleado->Tipo_empleado->last();
					$fecha_alta = $contratacion->High_date;
					$antiguedad = Antiguedad($fecha_alta);
					$periodo_actual = Periodo_actual($fecha_alta);
					$dias_disfrutar =  Dias_Disfrutar($fecha_alta, $tipo->id);
					$dias_disfrutados = Dias_disfrutados($contratacion, $empleado);
				   	$saldo =  Saldo($fecha_alta, $dias_disfrutados);
    				@endphp
    				<tr >
						<td>{{ $cnt }}</td>
						<td>{{ $empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names}}</td>
						<td>{{ $empleado->Position_ES }}</td>
						<td>{{ Formato($fecha_alta) }}</td>
						<td>{{ $antiguedad }}</td>
						<td>{{ $periodo_actual }}</td>
						<td>{{ $dias_disfrutar }}</td>
						<td>{{ $saldo }}</td>
		    		</tr>
    			@endif
    		@endforeach
		@endforeach
		</tbody>	
	</table>
@else
	<center><h2>No se encontraron registros del departamento, o sucedio un error en la consulta.</h2></center>
@endif
</body>
</html>