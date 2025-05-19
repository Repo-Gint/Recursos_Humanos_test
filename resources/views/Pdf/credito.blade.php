<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style >
			.box{
				width: 50px;
				height: 50px;
				background-color: white;
				border: 1px solid black;
			}
		</style>
	</head>
	<body style="font-family: Arial, Sans-serif; font-size: 15px;">
		@php
			$ingreso = $empleado->Contrataciones->last();
			$fecha = explode("-", $ingreso->High_date);
		@endphp
		<img src="../public/images/logo.png" width="150"><br>
		<p style="text-align: right;">
			Toluca, {{ $fecha[2]." de ".mes_espanol($fecha[1])." del ".$fecha[0] }}
		</p>

<p style="text-align: left;">
	GRUPO INTERCONSULT S.A. DE C.V.<br>
	PRESENTE<br><br>

	Por medio de la presente hago constar que:
</p>

<table style="width: 100%;">
	<tbody>
		<tr>
			<td style="width: 5%;"></td>
			<td style="width: 95%;">
				<strong>A)	RECONOCIMIENTO DE CREDITO INFONAVIT</strong><br>
			</td>
		</tr>
		<tr>
			<td style="width: 10%;">
				<div class="box"></div>
			</td>
			<td style="width: 90%;">
				<p style="text-align: justify;">
				<strong>SI</strong> Cuento con crédito <strong>INFONAVIT</strong>, por lo que me comprometo a notificar a dicha institución de mi incorporación a la empresa GRUPO INTERCONSULT SA DE CV y/o empresas que la integran, a fin de que en un periodo máximo de 15 días entregue al Departamento de Recursos Humanos el documento oficial que emite el INFONAVIT, referente a los datos de descuento por dicho crédito.
				</p>
			</td>
		</tr>
		<tr>
			<td style="width: 10%;">
				<div class="box"></div>
			</td>
			<td style="width: 90%;">
				<p style="text-align: justify;">
				<strong>NO</strong> cuento con crédito <strong>INFONAVIT</strong>, por lo que me comprometo a notificar al Departamento de Recursos Humanos u operaciones, en el momento que éste realizando dicho trámite.<br>
				</p>
			</td>
		</tr>
		<tr>
			<td style="width: 5%;"></td>
			<td style="width: 90%;">
				<strong>B)	RECONOCIMIENTO DE CREDITO FONACOT</strong><br>
			</td>
		</tr>
		<tr>
			<td style="width: 10%;">
				<div class="box"></div>
			</td>
			<td style="width: 90%;">
				<p style="text-align: justify;">
				<strong>SI</strong> Cuento con crédito <strong>FONACOT</strong>, por lo que me comprometo a notificar a dicha institución de mi incorporación a la empresa GRUPO INTERCONSULT SA DE CV y/o empresas que la integran, a fin de que en un periodo máximo de 15 días entregue al Departamento de Recursos Humanos el documento oficial que emite el FONACOT, referente a los datos de descuento por dicho crédito.
				</p>
			</td>
		</tr>
		<tr>
			<td style="width: 10%;">
				<div class="box"></div>
			</td>
			<td style="width: 90%;">
				<p style="text-align: justify;">
				<strong>NO</strong> cuento con crédito <strong>FONACOT</strong>, por lo que me comprometo a notificar al Departamento de Recursos Humanos u operaciones, en el momento que éste realizando dicho trámite.
				</p>
			</td>
		</tr>
	</tbody>
</table>
<p style="text-align: justify;">
	En caso de no cumplir e informar con el compromiso que adquiero con INFONAVIT Y/O FONACOT, o  falsificar los documentos correspondientes a dichas retenciones, la empresa procederá a rescindir el contrato sin responsabilidad para el patrón conforme a la Ley Federal del Trabajo (LFT); Comprometiéndose el colaborador a realizar los pagos que corresponden al periodo de omisión de información.<br><br>
</p>

<center>
	Atentamente<br><br><br>
	{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}<br>
	_____________________________________________<br>	
    Nombre Completo y Firma
</center>
</body>
</html>