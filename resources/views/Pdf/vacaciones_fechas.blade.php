<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style>
			table{
			  border: 0.2px solid black;
			  border-spacing: 0;
			  width: 100%;

			}
			th, td {
				border: 0.1px solid #DBDBDB;
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
            .page-break {
page-break-before: always;
}
		</style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 12px;">
	<header>
		<img src="../public/images/img_encabezado.jpg" width="100%" height="85">
		<br>
		<center><strong>REPORTE DE VACACIONES</strong></center>
	</header>
	<footer>		
		<hr>
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
	<br><br>
	<table  style="border: none;">
		<tr style="border: none; text-align: right;">
			<td colspan="8" style="border: none;">Fecha de Realización: {{ date('d.m.Y H:i')}}</td>
		</tr>
	</table>
	<table style="width: 50%;">
		<tbody>
			<tr>
				<th style="background-color: #00A2FF; color: white; width: 30%; text-align: left;">Fecha Inicial</th>
				<td style="width: 70%;">{{ Formato($fecha_inicio) }}</td>
			</tr>
			<tr>
				<th style="background-color: #00A2FF; color: white; text-align: left;">Fecha Final</th>
				<td>{{ Formato($fecha_fin) }}</td>
			</tr>
			<tr>
				<th style="background-color: #00A2FF; color: white; text-align: left;">Departamento</th>
				<td>
					@php
						$ban = 0;
				        for ($i=0; $i < count($departaments) ; $i++) { 
				            if($departaments[$i] == "Todo"){
				                $ban = 1;
				            }
				        }
					@endphp
					@if($ban == 1)
						Todos
					@else
				        @for ($i=0; $i < count($departaments) ; $i++) 
				            {{ Departamento($departaments[$i])}}
				        @endfor
					@endif
				
				</td>
			</tr>
		</tbody>
	</table> <br>



	<table>
		<tbody>
			<tr>
				<th style="background-color: #00A2FF; color: white;" colspan="4">Empleados</th>
			</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Nómina</th>
				<th>Empleado</th>
				<th>Fecha Inicio</th>
				<th>Fecha Fin</th>
			</tr>
			@php
			$cnt = 0;
			@endphp
				
				@foreach($empleados as $empleado)
				inicio:{{ $fecha_inicio }} Fin: {{$fecha_fin}}
					@foreach($empleado->Vacaciones as $vacaciones)

						@if( (($fecha_inicio <= $vacaciones->Start_date) && ($fecha_fin >= $vacaciones->Start_date)) || (($fecha_inicio >= $vacaciones->Ending_date) && ($fecha_fin <= $vacaciones->Ending_date)) )
							<tr>
							<td style="text-align: center;">{{ $empleado->Code }}</td>
							<td>{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</td>
							<td style="text-align: center;">{{ Formato($vacaciones->Start_date) }}</td>
							<td style="text-align: center;">{{ Formato($vacaciones->Ending_date) }}</td>
							</tr>
							@php
			$cnt++;
			@endphp
						@endif
					@endforeach
				@endforeach
			
		</tbody>
	</table>

	Total: {{ $cnt }}
</body>
</html>