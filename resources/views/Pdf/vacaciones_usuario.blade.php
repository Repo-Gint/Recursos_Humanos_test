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
		</style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 12px;">
	<header>
		<img src="../public/images/img_encabezado.jpg" width="100%" height="85">
	</header>
	<footer>		
		<hr>
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
	<?php
	    $contratacion = $empleado->Contrataciones->last();
	    $tipo = $empleado->Tipo_empleado->last();
	    $puesto = $empleado->Puesto->last();
	    
	    $superior = Superior($empleado); 
	    
	    $dias_disfrutados = 0;
		foreach($empleado->Vacaciones as $vacaciones){
	        $dias_disfrutados = $dias_disfrutados + $vacaciones->Days;
	    }
	    $antiguedad = Antiguedad($contratacion->High_date);
	    $saldo =  Saldo($contratacion->High_date, $dias_disfrutados);
	    $departamento = $puesto->Departamento;
		$periodos = Periodos_historial($empleado);
		$suma = 0;
	?>
	<center><h4>Reporte de vacaciones</h4></center>
	<table style="width: 100%;">
		<tbody>
			<tr style="background-color: #00A2FF; color: white;">
				<th colspan="2">
					<center>Datos del Empleado</center>
				</th>
			</tr>
			<tr>
				<th style="width: 25%; background-color: #00A2FF; color: white;">
					Nombre del empleado:
				</th>
				<td style="width: 75%">
					{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}
				</td>
			</tr>
			<tr>
				<th style="background-color: #00A2FF; color: white;">
					Puesto:
				</th>
				<td>
					{{ $puesto->Position_ES }}
				</td>
			</tr>
			<tr>
				<th  style="background-color: #00A2FF; color: white;">
					Departamento:
				</th>
				<td>
					{{ $departamento->Departament_ES }}
				</td>
			</tr>
			<tr>
				<th style="background-color: #00A2FF; color: white;">
					Superior:
				</th>
				<td>
					{{ $superior }}
				</td>
			</tr>
		</tbody>
	</table><br>
	<table>
		<tbody>
			<tr style="background-color: #00A2FF; color: white;">
				<th style="width: 33.33%;">
					<center>Fecha de ingreso:</center>
				</th>
				<th style="width: 33.33%;">
					<center>Antiguedad:</center>
				</th>
				<th style="width: 33.33%;">
					<center>Saldo:</center>
				</th>
			</tr>
			<tr>
				<td>
					<center>{{ Formato($contratacion->High_date) }}</center>
				</td>
				<td>
					<center>{{ $antiguedad }}</center>
				</td>
				<td>
					<center>{{ $saldo }}</center>
				</td>
			</tr>
		</tbody>
	</table><br>
	<table>
        <thead>
        	<tr style="text-align: center; background-color: #00A2FF; color: white;">
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Dias Solicitados</th>
                <th>Tipo de Vacaciones</th>
        	</tr>
        </thead>
        <tbody >
			@php
				$cnt = 0;
                for($x = 0; $x < count($periodos); $x++){
            @endphp
                <tr style="text-align: center; background-color: #00A2FF; color: white;">
                    <th colspan="4" ><center>{{ $periodos[$x] }}</center></th>
                </tr>
                @foreach($empleado->Vacaciones as $vacaciones)
                    @if($periodos[$x] == $vacaciones->Period)
                    @php
                    	$suma += (int)$vacaciones->Days;
                    	$cnt++;
                    @endphp
                        @if($cnt%2 == 0)
						<tr style="background-color: rgb(205,205,205, 0.5);">
						@else
						<tr>
						@endif
                            <td style="">{{ Formato($vacaciones->Start_date) }}</td>
                            <td style="">{{ Formato($vacaciones->Ending_date) }}</td>
                            <td style="">{{ $vacaciones->Days }}</td>
                            <td style="">{{ Tipo_Vacacion($vacaciones->Paid, $vacaciones->Advanced)}}</td>       
                        </tr>
                    @endif
                @endforeach
                <tr >
                    <td colspan="2" style="">Total: </td>
                    <td style="background-color: #CBCBCB;">{{ $suma }}</td>
                    <td style=""></td>       
                </tr>
                @php
                	$suma = 0;
                @endphp
            @php
                }
            @endphp
        </tbody>
     </table>
</body>
</html>