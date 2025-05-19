<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, Sans-serif;">
	<h3>Se ha generado un nuevo registro en el Sistema de Recursos Humanos</h3>
	Nuevo Empleado
	<ul>
		<li><strong>Nombre:</strong> {!! $Names.' '.$Paternal.' '.$Maternal !!}</li>
		<li><strong>Cumpleaños:</strong>{!! $Birthdate !!}</li>
	</ul>
	<h3>Los datos generados para el ingreso de la intranet son los siguientes:</h3>
	<ul>
		<li><strong>Usuario:</strong> {!! $User !!}</li>
		<li><strong>Contraseña:</strong> {!! $Password !!}</li>
	</ul>

</body>
</html>