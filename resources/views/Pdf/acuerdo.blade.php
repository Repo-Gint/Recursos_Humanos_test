<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style>
            @page {
                margin: 0cm 0cm;
            }
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 3cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 1cm;
                right: 1cm;
                height: 2cm;
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
            table{
            	text-align: justify;
            }
        </style>
	</head>
<body style="font-family: Arial, Sans-serif; font-size: 14px;">
	@php
		$ingreso = $empleado->Contrataciones->last();
		$fecha = explode("-", $ingreso->High_date);
		$datos = $empleado->Datos;
	@endphp
	<header>
		<img src="../public/images/img_encabezado.jpg" width="100%">
	</header>
	<footer>
		2b. Acuerdo Laboral de Confidencialidad 		
		<hr>
		Fraccionamiento Industrial PARQUE INN - Carretera Naucalpan - Toluca Km 52.5 - San Mateo Otzacatipan – C. Isaac Newton No. 102, 50220 Toluca, Estado de México 
		<center>E-mail:<span>capital.humano@grupointerconsult.com</span> - Tels.: 0052 (722) 2497491 - 2497492 - 2497493 - <span>www.grupointerconsult.com</span></center>
	</footer>
	<main>
		<center>
			<h4>ACUERDO LABORAL SOBRE CONFIDENCIALIDAD</h4>
		</center>
		<p style="text-align: justify; ">
			Los suscritos a saber, <strong>CAJIAO PESCHL CLAUDIA MARCELA</strong>, mujer mayor de edad, apta para contratar y obligarse, identificado con Credencial de residente permanente 669039  quien en este acto obra en calidad de Representante Legal de <strong>GRUPO INTERCONSULT, S.A. DE C.V.</strong> sociedad inicialmente constituida como INTERCONSULT TERMOFORMA REPRESENTACIONES S.A. DE C.V., mediante escritura pública No. 90,688 de fecha 29.01.1996, otorgada en la Ciudad de México y posteriormente transformada en GRUPO INTERCONSULT S.A. DE C.V., mediante escritura pública No. 92,780 de fecha 19.08.2002, otorgada en la Ciudad de México e inscrita dicha reforma en el Registro Público de Comercio y que para todos los fines del presente acuerdo se denominará <strong>EL PATRÓN</strong>, por una parte, y <strong>{{ strtoupper($empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names)}}</strong>, <strong>{{ strtoupper( $empleado->Datos->Gender) }}</strong>, mayor de edad, apto(a) para contratar y obligarse, identificada con Credencial de Elector {{ $datos->Credential ?: 'Sin Credencial'}} , expedida en el Estado de México, que para todos los fines del presente Convenio de Confidencialidad se denominará <strong>EL EMPLEADO</strong>, por la otra parte, y
			<br><br>
		</p>
		<strong>CONSIDERANDO:</strong><br><br>
		<table style="width: 100%;">
			<tr>
				<td style="width: 5%; vertical-align: top;">1.</td>
				<td>
					Que <strong>GRUPO INTERCONSULT, S.A. DE C.V.</strong>, tiene como parte de su objeto social, “Representación comercial y técnica de maquinaria y accesorios para la industria del plástico en general; la prestación de servicios de asesoría o consultoría técnica industrial. En general, cualquier actividad comercial o industrial lícita, relacionada directa o indirectamente con lo antes descrito y la adquisición de los bienes muebles o inmuebles necesarios para la realización de su objeto”
				</td>
			</tr>
			<tr>
				<td style="width: 5%; float: right; vertical-align: top;">2.</td>
				<td>
					Que para el desarrollo de este tipo de negocios <strong>EL PATRÓN</strong> deberá celebrar contratos de confidencialidad con diferentes empresas, los cuales obligarán a este a garantizar un manejo confidencial y adecuado de la información contenida en los diferentes documentos.
				</td>
			</tr>
			<tr>
				<td style="width: 5%; float: right; vertical-align: top;">3.</td>
				<td>
					Que es obligación de  <strong>EL EMPLEADO</strong>  guardar estricta reserva de cuanto llegara a su conocimiento sobre sistemas y/o políticas de venta, créditos, promociones, entrenamientos, información técnica y de fabricación y demás informaciones de carácter reservado y cuya divulgación lesione el interés de la compañía, a juicio de esta.
				</td>
			</tr>
			<tr>
				<td style="width: 5%; float: right; vertical-align: top;">4.</td>
				<td>
					Que con base en lo anteriormente expuesto, <strong>EL PATRÓN</strong> y <strong>EL EMPLEADO</strong> acuerdan el siguiente:
				</td>
			</tr>
		</table><br>
		<p style="text-align: justify; ">
			<strong>ACUERDO LABORAL SOBRE CONFIDENCIALIDAD:</strong><br><br>

			<strong>PRIMERO:</strong> Que <strong>el EMPLEADO</strong> conoce y entiende sobre su responsabilidad al participar, en nombre del patrón, en proyectos y trabajos relacionados con el desarrollo de contratos de confidencialidad que <strong>EL PATRÓN</strong> haya celebrado o llegue a celebrar con otras empresas.<br><br>

			<strong>SEGUNDO:</strong> Que <strong>EL EMPLEADO</strong> se compromete para con <strong>EL PATRÓN</strong> a dar fiel cumplimiento a todas las obligaciones que le llegaran a corresponder, por su participación en todos los contratos confidenciales.<br><br>

			<strong>TERCERO:</strong> Que <strong>EL EMPLEADO</strong> acepta, se acoge y se compromete a cumplir fielmente, en su calidad de participante, con lo estipulado en las cláusulas de los contratos de confidencialidad que <strong>EL PATRÓN</strong> llegue a celebrar con otras empresas y en especial todo lo relacionado con el procedimiento para el manejo de la información de carácter confidencial.<br><br>

			<strong>CUARTO:</strong> Que <strong>EL EMPLEADO</strong> conoce el contenido de la <strong>Ley Federal del Trabajo (Capitulo IV, Artículo 47 - IX)</strong> que establece como justa causa de rescisión, sin responsabilidad para <strong>EL PATRÓN</strong>, el hecho de que el trabajador revele los <strong>secretos técnicos o comerciales</strong> o dé a conocer los asuntos confidenciales de carácter reservado, con perjuicio de la empresa.<br><br>

			<strong>QUINTO:</strong> Que en caso de que <strong>EL EMPLEADO</strong> decida retirarse voluntariamente de la empresa o su contrato sea de tiempo determinado, <strong>EL EMPLEADO</strong> acepta, se acoge y se compromete fielmente a no divulgar, revelar, hacer copias ilícitas, transferir, vender o utilizar, ninguna información técnica, (Planos, Manuales, Programas, Videos, CD’s, etc.) o comercial (Estados financieros, Declaraciones de impuestos, Cotizaciones, Listas de Precios, Bases de datos sobre clientes), especialmente en favor de otras empresas que tengan el <u>mismo objeto social</u> y que se dedican a las <u>mismas actividades</u> que <strong>GRUPO INTERCONSULT, S.A. DE C.V. Esta restricción es válida por tiempo ilimitado.</strong><br><br>

			<strong>SEXTO:</strong> Que en caso de que <strong>EL EMPLEADO</strong> decida retirarse voluntariamente de la empresa, <strong>EL EMPLEADO</strong> se compromete a entregar incondicionalmente a <strong>EL PATRÓN</strong> toda la información que se encuentre en su poder. <strong>EL EMPLEADO</strong> también se compromete a entregar toda la información requerida, sin restricción de información y de manera organizada a su o sus sucesores en el puesto de trabajo que haya desempeñado hasta la fecha.<br><br>

			<strong>SEPTIMO:</strong> En caso de que <strong>EL EMPLEADO</strong> viole este Acuerdo Laboral de Confidencialidad durante el tiempo que él haya sido empleado de <strong>GRUPO INTERCONSULT, S.A. DE C.V.</strong> o después de haberse retirado de la empresa, se acuerda una indemnización por parte de <strong>EL EMPLEADO</strong> hacia <strong>EL PATRÓN</strong> por la suma de <strong>2,000,000.00</strong> (Dos millones de pesos mexicanos), moneda corriente.<br><br>

			<strong>OCTAVO:</strong> <strong>EL EMPLEADO</strong> no podrá contratarse con la competencia, clientes y proveedores de <strong>GRUPO INTERCONSULT, S.A. DE C.V. , ILLIG LATAM S.A DE C.V.</strong> dentro de los próximos 5 años contados a partir de la fecha  que cause baja de <strong>GRUPO INTERCONSULT SA. DE C.V.</strong><br><br>

			En constancia de aceptación las partes firman el presente Acuerdo Laboral Sobre Confidencialidad, en dos (2) originales de igual valor, el día <strong>{{ $fecha[2] }} de {{ mes_espanol($fecha[1]) }}</strong> del {{ $fecha[0] }}</strong>
		</p><br><br>
		<table style="width: 100%;">
			<tbody>
				<tr>
					<td style="border: none; width: 40%;" >
						<center>
							<strong>EL PATRÓN</strong>
						</center>
					</td>
					<td style="border: none; width: 20%;" >
					</td>
					<td style="border: none; width: 40%;" > 
						<center>
							<strong>EL EMPLEADO</strong>
						</center>
					</td>
				</tr>
				<tr >
					<td style="height: 50px; border: none;"></td>
					<td style="border: none;"></td>
					<td style="border: none;"></td>
				</tr>
				<tr>
					<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none;">
						<center>
							Claudia Marcela Cajiao Peschl	
						</center>
					</td>
					<td style="border: none;"> 
					</td>
					<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none;"> 
						<center>
							{{ $empleado->Code.' '.$empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal}}
						</center>
					</td>
				</tr>
			</tbody>	
		</table>
	</main>  
<!-- 
	Este scritp creara el contador de paginas 
	page_text(posicion X, posicion Y, "Texto {Pagina} texto {Total Paginas}", tipo letra, tamaño, color rgb(el rango es de 0 a 1))
-->
<script type="text/php">
    if ( isset($pdf) ) {
        $font = $fontMetrics->getFont("Arial");
        $pdf->page_text(500, 755, "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(.80, .80, .80));
    }
</script>
</body>
</html>