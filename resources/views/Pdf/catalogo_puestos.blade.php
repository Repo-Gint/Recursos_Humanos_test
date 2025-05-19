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
<body style="font-family: Arial, Sans-serif; font-size: 9px;">
	<header>
		<img src="../public/images/img_encabezado.jpg" width="100%" height="85">
	</header>
	<footer>		
		<hr>
		<center>Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México </center>
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
<br>
	<table >
		<thead>
			<tr style="background-color: #00A2FF; color: white;">
				<th colspan="7" style="text-align: center;">Catálogo de Puestos</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>#</th>
				<th>Código</th>
				<th>Puesto</th>
				<th>Position</th>
				<th>Departamento</th>
				<th>Autorizados</th>
				<th>Plantilla</th>
    		</tr>
		</thead>
		<tbody>
				@php
					$i = 0;
					$a = 0;
				@endphp
				@foreach($puestos as $puesto)
					@php
						$i++;
					@endphp
					@foreach($empleados as $empleado)
						@if($empleado->Position_id == $puesto->Position_id)
							@php
								$a++;
							@endphp
						@endif
					@endforeach
					<tr>
						<td style="text-align: center; width: 4%;">{{ $i }}</td>
						<td style="width: 6%;">{{ $puesto->Code }}</td>
						<td style="width: 25%;">{{ $puesto->Position_ES }}</td>
						<td style="width: 25%;">{{ $puesto->Position_EN }}</td>
						<td style="width: 20%;">{{ $puesto->Departament_ES }}</td>
						<td style="text-align: center; width: 10%;">{{ $puesto->Vacancies }}</td>
						<td style="text-align: center; width: 10%;">{{ $a }}</td>
					</tr>
					@php
						$a = 0;
					@endphp
				@endforeach
		</tbody>	
	</table>

</body>
</html>