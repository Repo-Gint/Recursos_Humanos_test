<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style>
			.tabla{
			  border: 1px solid black;
			  border-spacing: 0;
			  width: 100%;

			}
			.tabla th, td {
				border: 1px solid black;
			}

			.pie{
			  width: 100%;
			  border-spacing: 5px;
			}

			.pie th, td {
				width: 33.33%;
			}
		</style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 15px;">
@php
	$contacto = $empleado->Contactos;
        $contratacion = $empleado->Contrataciones->last();
        $tipo = $empleado->Tipo_empleado->last();
        $puesto = $empleado->Puesto->last();

        $puesto_superior = $puesto->Parent_Puesto;
  		$jefe_directo = $puesto_superior->empleado->last();

        if($puesto->Parent_id == null){
        	if($jefe_directo == null || empty($jefe_directo)){
        		$superior = $puesto_superior->Position_ES;
        	}else{
        		$superior = "";

        	}
        }else{
        	$superior = $puesto_superior->Position_ES.' - '.$jefe_directo->Names.' '.$jefe_directo->Paternal;
        }
        
        $departamento = $puesto->Departamento;
        $datos = $empleado->Datos;
        $domicilio = $empleado->Domicilio;
        $banco = $empleado->Dato_Bancos;
@endphp
<img src="../public/images/logo.png" width="150">
<center><h4>CARÁTULA DE EXPEDIENTE</h4></center>
	<table class="tabla">
		<tbody>
			<tr>
				<td style="width: 20%">Fecha de edición: </td>
				<td style="width: 80%">
					{{ Formato($empleado->updated_at) }}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{ 'Nómina: '.$empleado->Code }}
				</td>
			</tr>
			<tr>
				<td>Sociedad: </td>
				<td>{{ $empleado->Empresa->Name }}</td>
			</tr>
			<tr>
				<td>Departamento: </td>
				<td>{{ $puesto->Departamento->Departament_ES }}</td>
			</tr>
			<tr>
				<td>Puesto a quien reporta: </td>
				<td>{{ $superior }}</td>
			</tr>
			<tr>
				<td>Nivel - puesto: </td>
				<td>{{ $puesto->Position_ES }}</td>
			</tr>
			<tr>
				<td>Nombre completo: </td>
				<td>{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }} </td>
			</tr>
			<tr>
				<td>Fecha de ingreso: </td>
				<td>{{ Formato($contratacion->High_date) }}</td>
			</tr>
			<tr>
				<td>Número de imss: </td>
				<td> {{ $datos->Nss }}</td>
			</tr>
			<tr>
				<td>CURP: </td>
				<td>{{ $datos->Curp }}</td>
			</tr>
			<tr>
				<td>RFC: </td>
				<td>{{ $datos->Rfc }}</td>
			</tr>
			<tr>
				<td>Credencial: </td>
				<td>{{ $datos->Credential }}</td>
			</tr>
			<tr>
				<td>Domicilio: </td>
				<td>{{ $domicilio->Address }}</td>
			</tr>
			<tr>
				<td>Colonia: </td>
				<td> {{ $domicilio->Tows}}</td>
			</tr>
			<tr>
				<td>Municipio: </td>
				<td>{{ $domicilio->Municipality}} </td>
			</tr>
			<tr>
				<td>Estado: </td>
				<td> {{ $domicilio->State }}</td>
			</tr>
			<tr>
				<td>Código postal: </td>
				<td> {{ $domicilio->Postcode }}</td>
			</tr>
			<tr>
				<td>Escolaridad: </td>
				<td>{{ $datos->Escolaridad->Scholarship }}</td>
			</tr>
			<tr>
				<td>Documento: </td>
				<td>{{ $datos->Voucher->Voucher }}</td>
			</tr>
			<tr>
				<td>Teléfono: (con clave lada) </td>
				<td>{{ $contacto->Personal_phone }}</td>
			</tr>
			<tr>
				<td>En caso de emergencia: </td>
				<td>{{ 'Lamar a: '.$contacto->Family.' parentesco: '.$contacto->Familiar->relationship.' teléfono: '.$contacto->Emergency_phone  }} </td>
			</tr>
			<tr>
				<td>Alergias: </td>
				<td>{{ $datos->Allergy }}</td>
			</tr>
			<tr>
				<td>Tipo de sangre: </td>
				<td>{{ $datos->Blood }}</td>
			</tr>
			<tr>
				<td>Tiene crédio: </td>
				<td> 
					{{ $datos->Credit }}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{ 'Núm. de Credito: '.$datos->Credit_num }}
				</td>
			</tr>
			<tr>
				<td>Banco: </td>
				<td>{{ ($banco->Banco == Null) ? ' ' : $banco->Banco->Name }}<br>
				{{ ' Núm. cuenta: '.$banco->Count}}<br>
			{{ ' Clabe interbancaria: '.$banco->Clabe_bank  }}</td>
			</tr>
			<tr>
				<td>Email personal: </td>
				<td>{{ $contacto->Personal_mail }}</td>
			</tr>
		</tbody>
	</table>
	<br><br><br>
	<table class="pie">
		<tbody>
			<tr>
				<td style="border: none;" style="border: none;">
					<center>
						Elaboró:
					</center>
				</td>
				<td style="border: none;" style="border: none;"> 
					<center>
						Revisó:
					</center>
				</td>
				<td style="border: none;" style="border: none;"> 
					<center>
						Recibió para Nómina:
					</center>
				</td>
			</tr>
			<tr >
				<td style="height: 70px; border: none;"></td>
				<td style="border: none;"></td>
				<td style="border: none;"></td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none;">
					<center>
						Puesto y Firma
					</center>
				</td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none;"> 
					<center>
						Puesto y Firma
					</center>
				</td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none;"> 
					<center>
						Puesto y Firma
					</center>
				</td>
			</tr>
		</tbody>	
	</table>


</body>
</html>