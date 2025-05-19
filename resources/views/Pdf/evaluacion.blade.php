<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="../public/plugins/bootstrap/css/bootstrap.css') }}">
		<style>
			.encabezado{
			  border-spacing: 0;
			  width: 100%;

			}
			.encabezado th{
				vertical-align: bottom;
				padding: 0;

			}
			.encabezado td{
				border-bottom: 0.5px solid black; 
				vertical-align: bottom; 
				text-align: center;
			}

			.contenido{
				font-size: 9px;
				border-spacing: 0;
			  width: 100%;
			}

			.contenido td{
				border: 0.5px solid black;
			}

			.contenido th{
				border: 0.5px solid black;
				text-align: center;
			}
		</style>
	</head>
	<body style="font-family: Arial, Sans-serif;">
	@php
	    $contratacion = $empleado->Contrataciones->last();
	    $puesto = $empleado->Puesto->last();
	    if($empleado->Parent_Emp == null){
	    	$superior_nombre = "";
	    }else{
	    	$superior = $empleado->Parent_Emp;
	    	$superior_nombre = nombre($superior, "Mostrar");
	    	$puesto_superior = $superior->Puesto->last(); 
	    }
	    
	@endphp
<p style="font-size: 16px;"><center><strong>Autoevaluación y Evaluación del Desempeño</strong></center></p><br>
	<table class="encabezado">
		<tbody>
			<tr style="font-size: 9px;">
				<th style="width: 5%">Evaluado:</th>
				<td>{{ nombre($empleado, "Mostrar") }}</td>
				<th style="width: 5%">Puesto:</th>
				<td>{{ $puesto->Position_ES }}</td>
				<th style="width: 15%">Fecha de ingreso:</th>
				<td>{{ Formato($contratacion->High_date) }}</td>
				<th style="width: 10%">Termino de contrato:</th>
				<td>{{ Formato($contratacion->Ending) }}</td>
				<th style="width: 5%">Nómina:</th>
				<td>{{ $empleado->Code }}</td>
			</tr>
			<tr style="font-size: 9px;">
				<th>Evaluador:</th>
				<td>{{ $superior_nombre }}</td>
				<th>Puesto:</th>
				<td>{{ $puesto_superior->Position_ES }}</td>
				<th>Fecha para entrega de evaluacion:</th>
				<td></td>
				<th>Perido de evaluación:</th>
				<td></td>
			</tr>
			<tr style="font-size: 12px;">
				<th colspan="10"><center>Instrucciones:</center></th>
			</tr>
			<tr style="font-size: 9px;">
				<td colspan="10">
					<p style="text-align: justify;">
						<strong>EVALUADO:</strong> Leer primero las competencias e indicar en la columna de Auto-evaluación el número de la calificación que consideras cumples, (1-5) respecto a tus funciones y responsabilidades de puesto.<br>
						<strong>EVALUADOR:</strong>  Leer primero las competencias y evaluar el desempeño laboral del colaborador que se encuentra bajo su cargo,  indicando en la columna Evaluación Jefe Inmediato  la calificación acorde a la conducta mostrada durante el período a evaluar y que corresponda al valor de cada nivel de evaluación. El promedio de todos corresponde a la evaluación final.<br>
						Es importante, plasmar Comentarios Generales y/o compromisos adquiridos para justificar la decisión final
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="contenido">
		<thead>
			<tr>
				<th colspan="2" rowspan="2">Competencias a Evaluar</th>
				<th>Deficientes Resultados</th>
				<th>Bajos Resultados</th>
				<th>Resultados acorde al puesto</th>
				<th>Resultados Favorables</th>
				<th>Excede Resultados</th>
				<th rowspan="2" >Autoevaluación</th>
				<th rowspan="2" >Evaluación del jefe inmediato</th>
				<th rowspan="2" >Comentarios Generales</th>
				<th rowspan="2" >Compromisos adquiridos</th>
			</tr>
			<tr>
				<th style="background-color: red;">1</th>
				<th style="background-color: yellow">2</th>
				<th style="background-color: orange">3</th>
				<th style="background-color: #8AFEFF">4</th>
				<th style="background-color: #50C65B">5</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>1</th>
				<td>
					<strong>Trabajo en Equipo-</strong> Capacidad de colaborar y cooperar con los demás, en donde promueve, fomenta y mantiene relaciones de colaboración adecuadas dentro de un grupo de personas que trabajan en procesos, tareas u objetivos compartidos.
				</td>
				<td style="text-align: center;">Prefiere trabajar solo</td>
				<td style="text-align: center;">Dificultad para relacionarse pero lo procura</td>
				<td style="text-align: center;">Se integra al equipo facilmente</td>
				<td style="text-align: center;">Hace trabajo en equipo y se adapta</td>
				<td style="text-align: center;">Promueve la integración en el equipo</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>2</th>
				<td>
					<strong>Innovación-</strong> Capacidad y habilidad mental para adaptar ideas y conceptos a esquemas existentes, optimizando tiempos, recursos, procesos y esfuerzos en su puesto de trabajo.
				</td>
				<td style="text-align: center;">No muestra interes para emitir ideas innovadoras</td>
				<td style="text-align: center;">Poca participación</td>
				<td style="text-align: center;">Genera ideas innovadoras</td>
				<td style="text-align: center;">Desarrolla  Ideas Innovadoras y productivas  que favorecen al area</td>
				<td style="text-align: center;">Desarrolla e implementa ideas innovadoras</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>3</th>
				<td>
					<strong>Integridad-</strong> Capacidad de conducirse con una actitud asertiva y  alineada a los valores organizacionales de la empresa. 
				</td>
				<td style="text-align: center;">Muestra una actitud negativa</td>
				<td style="text-align: center;">Algunas veces muestra una actitud negativa</td>
				<td style="text-align: center;">Se conduce de manera congruente</td>
				<td style="text-align: center;">Muestra una actitud asertiva aún a pesar de situaciones de estrés o de enojo</td>
				<td style="text-align: center;">Se conduce asertivamente y fomenta en los demás la misma actitud.</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>4</th>
				<td>
					<strong>Lealtad-</strong> Actitud de compromiso hacia la empresa, área, y puesto que desempeña, reflejando una actitud de respeto.
				</td>
				<td style="text-align: center;">Expresiones negativas de su puesto, área y de la organización</td>
				<td style="text-align: center;">Algunas veces se expresa mal de otras personas</td>
				<td style="text-align: center;">Muestra lealtad hacia la organizaicón</td>
				<td style="text-align: center;">Se muestra con lealtad y evita comentar comentarios a favor y encontra de otros</td>
				<td style="text-align: center;">Muestra lealtad y la fomenta entre sus compañeros</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>5</th>
				<td>
					<strong>Enfoque al Cliente-</strong> Capacidad de conocer las características y necesidades del cliente interno y externo, y asegurar el cumplimiento de los compromisos adquiridos.
				</td>
				<td style="text-align: center;">No cumple con los requerimientos</td>
				<td style="text-align: center;">La mayoria de las veces no se apega a requerimientos del cliente</td>
				<td style="text-align: center;">Cubre los requerimientos que se le solicitan</td>
				<td style="text-align: center;">Cubre los requerimientos y en ocasiones supera las expectativas </td>
				<td style="text-align: center;">Cubre los requerimientos y supera expectativas de los clientes</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>6</th>
				<td>
					<strong>Liderazgo-</strong> Capacidad de influenciar y conducir a otros en el logro de los objetivos de la empresa.
				</td>
				<td style="text-align: center;">No muestra interes en influir en otros </td>
				<td style="text-align: center;">Se muestra desinteresado en su equipo de trabajo y mantiene distancia</td>
				<td style="text-align: center;">Dirige al personal a su cargo al cumplimiento de objetivos.</td>
				<td style="text-align: center;">Influye predicando con el ejemplo y hace cumplir los objetivos grupales</td>
				<td style="text-align: center;">Influye de manera positiva y productiva a otros y supera los objetivos grupales</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>7</th>
				<td>
					<strong>Toma de decisión-</strong> Capacidad para tomar decisiones lógicas y documentadas en el momento oportuno, basándose en análisis y observaciones previas.
				</td>
				<td style="text-align: center;">No toma decisiones </td>
				<td style="text-align: center;">Se le dificulta tomar decisiones </td>
				<td style="text-align: center;">Toma decisiones acorde a su puesto</td>
				<td style="text-align: center;">Toma decisiones productivas y objetivas para beneficio del área y la empresa</td>
				<td style="text-align: center;">Toma decisiones inteligentes y fomenta en otros  la toma decisión</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>8</th>
				<td>
					<strong>Análisis y Solución de Problemas-</strong> Capacidad para buscar las causas de los problemas que se presenten y encontrar la resolución de los mismos en tiempo y forma.
				</td>
				<td style="text-align: center;">No muestra capacidad para analisis y solución de problemas</td>
				<td style="text-align: center;">Dififultad para analizar los problemas y dar solución</td>
				<td style="text-align: center;">Analiza y da solución a los problemas</td>
				<td style="text-align: center;">Analiza los problemas y desarrolla soluciones eficientes y productivas </td>
				<td style="text-align: center;">Analiza los problemas y brinda diferentes opciones de solución productivas</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>9</th>
				<td>
					<strong>Comunicación Efectiva-</strong> Capacidad de expresar las propias ideas y entender las de los demás de manera clara y efectiva 
				</td>
				<td style="text-align: center;">No muestra interes para comunicarse</td>
				<td style="text-align: center;">Dificultad para comunicarse de manere efectiva</td>
				<td style="text-align: center;">Se comunica de manera efectiva</td>
				<td style="text-align: center;">Facilidad para comunicarse de manera estratégica </td>
				<td style="text-align: center;">Aplica y formenta en otros la comunicación efectiva</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
			<th>10</th>
				<td>
					<strong>Profesionalismo-</strong> Organiza las actividades propias del puesto, El conocimiento técnico y dominio del puesto, permiten un desarrollo eficiente de sus responsabilidades y dar resultados, ejecuta las acciones  para garantizar el cumplimiento de las actividades propias de su puesto
				</td>
				<td style="text-align: center;">No tiene una planeación y muestra una desorganización de las actividades</td>
				<td style="text-align: center;">Dificultad para planear y organizar sus actividades</td>
				<td style="text-align: center;">Capacidad para planear y orgnaizar </td>
				<td style="text-align: center;">Desarrolla una planeación y organización estrategica </td>
				<td style="text-align: center;">Desarrolla, implementa y controla la planeación y organización estratégica</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>11</th>
				<td>
					<strong>Cumplimiento de lineamientos Organizacionales Vigentes-</strong> Cumplir con las políticas y leyes para el cuidado del Medio Ambiente, Salud y Seguridad en el trabajo,  Cumplir con el Código de Ética y Conducta de la Organización vigente
				</td>
				<td style="text-align: center;">No se apega a lineamientos</td>
				<td style="text-align: center;">Manifiesta disciplina relajada</td>
				<td style="text-align: center;">Disciplinado  y de buena conducta, cumple los linemientos de Seguridad e Higiene aplicado a la tarea</td>
				<td style="text-align: center;">Cumple con los valores y respeto</td>
				<td style="text-align: center;">Mantiene relaciones de respeto y con valores</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>12</th>
				<td>
					<strong>Garantizar la continuidad del proceso productivo-</strong> a través de las mejoras en las máquinas, equipos, métodos y procedimientos. Velar por el cumplimiento de los procedimientos,  normas y estándares establecidos.
				</td>
				<td style="text-align: center;">No ejecuta </td>
				<td style="text-align: center;">Dificultad para supervisar y asegurar el cumplimiento </td>
				<td style="text-align: center;">Calidad enfocada a la tarea</td>
				<td style="text-align: center;">Aplica calidad  y establece acciones de mejora</td>
				<td style="text-align: center;">Aplica calidad  e implementa acciones de mejora</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>13</th>
				<td>
					<strong>Cuidado de los recursos-</strong> Administrar y cuidar los recursos humanos, tecnológicos y materiales, supervisa que se ejecuten los lineamientos de calidad, monitorea que el indicador de rechazos internos y externos se cumpla sin que este fuera de lo permitido.
				</td>
				<td style="text-align: center;">No ejecuta</td>
				<td style="text-align: center;">Dificultad para supervisar y asegurar el cumplimiento </td>
				<td style="text-align: center;">Calidad enfocada a la tarea</td>
				<td style="text-align: center;">Aplica calidad  y establece acciones de mejora</td>
				<td style="text-align: center;">Aplica calidad  e implementa acciones de mejora</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>14</th>
				<td>
					<strong>Pasión por resultados-</strong>Es la capacidad para actuar con velocidad y sentido de urgencia, responder a las necesidades del cliente. Es el deseo apremiante por garantizar los resultados con rapidez, flexibilidad y oportunidad para generar mayor rentabilidad.
				</td>
				<td style="text-align: center;">No hay compromiso por dar resultados</td>
				<td style="text-align: center;">No siempre cumple con los resultados esperados</td>
				<td style="text-align: center;">Cumple y responde a las demandas del puesto</td>
				<td style="text-align: center;">Se enfoca al resultado y administra su tiempo</td>
				<td style="text-align: center;">Tiene sentido de urgencia y responde con eficiencia</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th>15</th>
				<td>
					<strong>Puntualidad y Asistencia-</strong> Muestra responsabilidad hacía su trabajo, la frecuencia en la asistencia es constante y tiene la disponibilidad cuando es requerido, la llegada a su área de trabajo es puntual y en condiciones adecuadas para iniciar sus labores.
				</td>
				<td style="text-align: center;">Siempre llega tarde y ha tenido faltas durante el periodo</td>
				<td style="text-align: center;">A veces ha tenido retrasos y tuvo no mas de dos faltas durante el periodo</td>
				<td style="text-align: center;">Llega puntual y en condiciones para trabajar, tuvo una falta durante el periodo</td>
				<td style="text-align: center;">A veces llega antes y no tuvo faltas durante el periodo</td>
				<td style="text-align: center;">Siempre llega antes y no tuvo faltas durante el periodo</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" style="border: none;"></td>
				<td colspan="5" style="text-align: center;"><strong>EVALUACIÓN FINAL</strong></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table><br><br><br><br>
	<table style="width: 100%; border-spacing: 5px; font-size: 12px;">
		<tbody>

			<tr>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 25%;">
					<center>
						Nombre y Firma Evaluado
					</center>
				</td>
				<td style="width: 10%;"></td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 25%;"> 
					<center>
						Nombre y Firma Evaluador
					</center>
				</td>
				<td style="width: 10%;"></td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 25%;"> 
					<center>
						Nombre y Firma Revisó
					</center>
				</td>
				<td style="width: 10%;"></td>
				<td style="border-top: 1px solid black; border-left: none; border-right: none; border-bottom: none; width: 25%;"> 
					<center>
						Nombre y Firma Recibió
					</center>
				</td>
			</tr>
		</tbody>	
	</table>
</body>
</html>