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
@if(!$empleados->isEmpty())
	<table >
		<thead>
			@if($campos == "Datos")
			<tr style="background-color: #00A2FF; color: white;">
				<th colspan="19" style="text-align: center;">Datos Generales</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Código</th>
				<th>Nombre</th>
				<th>Ingreso</th>
				<th>Departamento</th>
				<th>Puesto</th>
				<th>Sexo</th>
				<th>F. de Nacimiento</th>
				<th># de Seguro Social</th>
				<th>RFC</th>
				<th>Curp</th>
				<th># de credencial</th>
				<th>Tipo de sangre</th>
				<th>Alergias</th>
				<th>Estado civil</th>
				<th>Hijos</th>
				<th colspan="2">Grado de estudios</th>
				<th>Infonavit</th>
				<th>Fonacot</th>
				<th>Dirección</th>
    		</tr>
    		@endif
    		@if($campos == "Bancos")
    		<tr style="background-color: #00A2FF; color: white;">
				<th colspan="7" style="text-align: center;">Información Bancaria</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Código</th>
				<th>Nombre</th>
				<th>Departamento</th>
				<th>Puesto</th>
				<th>Banco</th>
				<th>Cuenta</th>
				<th>Clabe interbancaria</th>
    		</tr>
    		@endif
    		@if($campos == "Contac_Personal")
    		<tr style="background-color: #00A2FF; color: white;">
				<th colspan="10" style="text-align: center;">Directorio General</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Código</th>
				<th>Nombre</th>
				<th>Departamento</th>
				<th>Puesto</th>
				<th>Celular</th>
				<th>Teléfono Fijo</th>
				<th>Email</th>
				<th colspan="3">En caso de Emergencia</th>
    		</tr>
    		@endif
    		@if($campos == "Contac_Empresa")
    		<tr style="background-color: #00A2FF; color: white;">
				<th colspan="7" style="text-align: center;">Directorio</th>
    		</tr>
			<tr style="background-color: #00A2FF; color: white;">
				<th>Código</th>
				<th>Nombre</th>
				<th>Departamento</th>
				<th>Puesto</th>
				<th>Celular</th>
				<th>Email</th>
				<th>Extensión</th>
    		</tr>
    		@endif
		</thead>
		<tbody>
			@if($campos == "Datos")
				@foreach($empleados as $empleado)
					<tr>
						<td style="text-align: center;">{{ $empleado->Code }}</td>
						<td>{{ $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names }}</td>
						<td>{{ $empleado->Contrataciones->last()->High_date }}</td>
						<td>{{ $empleado->Puesto->last()->Departamento->Departament_ES }}</td>
						<td>{{ $empleado->Puesto->last()->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Datos->Gender }}</td>
						<td style="text-align: center;">{{ $empleado->Datos->Birthdate }}</td>
						<td style="">{{ $empleado->Datos->Nss }}</td>
						<td style="">{{ $empleado->Datos->Rfc }}</td>
						<td>{{ $empleado->Datos->Curp }}</td>
						<td>{{ $empleado->Datos->Credential }}</td>
						<td style="text-align: center;">{{ $empleado->Datos->Blood }}</td>
						<td>{{ $empleado->Datos->Allergy }}</td>
						<td style="text-align: center;">{{ ($empleado->Datos->Status_id == 0) ? '' : $empleado->Datos->Estado_Civil->status }}</td>
						<td style="text-align: center;">{{ $empleado->Datos->Children }}</td>
						<td>{{ ($empleado->Datos->Scholarship_id == 0) ? '' : $empleado->Datos->Escolaridad->Scholarship }}</td>
						<td>{{ ($empleado->Datos->Voucher_id == 0) ? '' : $empleado->Datos->Voucher->Voucher }}</td>
						<td>{{ $empleado->Datos->Infonavit}}</td>
						<td>{{ $empleado->Datos->Fonacot }}</td>
						<td>
							{{ $empleado->Domicilio->Address.' '.$empleado->Domicilio->Tows.' '.$empleado->Domicilio->Municipality.' '.$empleado->Domicilio->State.' C.P.:'.$empleado->Domicilio->Postcode }}
						</td>
					</tr>

				@endforeach
			@endif
			@if($campos == "Bancos")
				@foreach($empleados as $empleado)
					<tr>
						<td style="text-align: center;">{{ $empleado->Code }}</td>
						<td>{{ $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names }}</td>
						<td>{{ $empleado->Puesto->last()->Departamento->Departament_ES}}</td>
						<td>{{ $empleado->Puesto->last()->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Dato_Bancos->Banco->Name }}</td>
						<td style="text-align: center;">{{ $empleado->Dato_Bancos->Count}}</td>
						<td style="text-align: center;">{{ $empleado->Dato_Bancos->Clabe_Bank }}</td>
					</tr>

				@endforeach
			@endif
			@if($campos == "Contac_Personal")
				@foreach($empleados as $empleado)
					<tr>
						<td style="text-align: center; width: 5%;">{{ $empleado->Code }}</td>
						<td style="width: 15%;">{{ $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names }}</td>
						<td style="width: 13%;">{{ $empleado->Puesto->last()->Departamento->Departament_ES }}</td>
						<td style="width: 15%;">{{ $empleado->Puesto->last()->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Contactos->Personal_phone}}</td>
						<td style="text-align: center;">{{ $empleado->Contactos->Landline}}</td>
						<td style="">{{ $empleado->Contactos->Personal_mail }}</td>
						<td style="width: 15%;">{{ $empleado->Contactos->Family}}</td>
						<td style="">{{ ($empleado->Contactos->Relationship_id == 0) ? '' : $empleado->Contactos->Familiar->relationship }}</td>
						<td style="text-align: center;">{{  $empleado->Contactos->Emergency_phone }}</td>
					</tr>

				@endforeach
			@endif
			@if($campos == "Contac_Empresa")
				@foreach($empleados as $empleado)
					<tr>
						<td style="text-align: center; width: 5%;">{{ $empleado->Code }}</td>
						<td style="width: 20%;">{{ $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names }}</td>
						<td style="width: 15%;">{{ $empleado->Puesto->last()->Departamento->Departament_ES }}</td>
						<td style="width: 20%;">{{ $empleado->Puesto->last()->Position_ES }}</td>
						<td style="text-align: center;">{{ $empleado->Contactos->Business_phone }}</td>
						<td>{{ $empleado->Contactos->Business_mail }}</td>
						<td style="text-align: center; width: 5%;">{{ $empleado->Contactos->Extension }}</td>
					</tr>

				@endforeach
			@endif
		</tbody>	
	</table>
@else
	<center><h2>No se encontraron registros del departamento, o sucedio un error en la consulta.</h2></center>
@endif
</body>
</html>