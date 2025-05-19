<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
	</head>
	<body style="font-family: Arial, Sans-serif; font-size: 15px;">
		@php
			$ingreso = $empleado->Contrataciones->last();
			$fecha = explode("-", $ingreso->High_date);
		@endphp
		<center>
			<h4>Carta compromiso</h4>
			<h4>Reglamento Interior de Trabajo (RIT) y Código de Ética (CÉ)</h4>
		</center><br>
		<p style="text-align: justify;">
			Yo, <strong>{{ $empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names }}</strong>  hago constar que he recibido, leído, comprendido y aceptado los Derechos y Obligaciones establecidos en el <strong>Reglamento Interior de Trabajo (RIT) Y Código de Ética (CÉ)</strong> y me comprometo a conducir mis actos con apego a dichos documentos, a fin de preservar la confianza que otros empleados, clientes, proveedores y autoridades han depositado en la Compañía a la que pertenezco. <br><br>
	
			Así mismo, me comprometo a que en caso de dudas de aplicación, solicitaré apoyo a mi área de Recursos Humanos. <br><br>
	
			Entiendo que la firma de la presente carta compromiso no constituye ni debe interpretarse como contrato de trabajo por tiempo definido ni garantiza la continuación de mi relación laboral. <br><br>
	
			Leída la presente carta compromiso y entendido su contenido y alcance, se firma en la Ciudad de Toluca, Estado de México el día <u>{{ " ".$fecha[2]." " }}</u> del mes de <u>{{ " ".mes_espanol($fecha[1])." " }}</u> del {{ " ".$fecha[0]." " }}.<br><br>
 	
 			De conformidad<br><br>
		</p>

	<table style="width: 100%; border-spacing: 5px;">
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td> 
					<center>
						{{ $empleado->Code }}
					</center>
				</td>
			</tr>
			<tr>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 50%;">
					<center>
						Nombre completo y Firma
					</center>
				</td>
				<td style="width: 10%;">
				</td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 25%;"> 
					<center>
						Número de empleado:
					</center>
				</td>
			</tr>
		</tbody>	
	</table>

<p style="text-align: justify;">

	El diferimiento en la entrega de la presente carta compromiso no me exime del cumplimiento del Reglamento Interior de Trabajo y Código de Conducta, ni de estar sujeto a las sanciones que en él se describen.
</p>

</body>
</html>