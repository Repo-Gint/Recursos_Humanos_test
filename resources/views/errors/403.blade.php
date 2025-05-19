@extends('layouts.app')

@section('title', 'Error')
@section('Pag', 'Acción no autorizada')

@section('content')
<center><h2>Whooops !!</h2></center>
<center><h3>Lo sentimos, Usted no tiene acceso a este apartado.</h3></center>
<div style="text-align: center">
	<img src="{{ asset('images/stop.png') }}" class="img-fluid" width="400"><br>
	<a href="{{ url("/Panel") }}"><button class="boton btn-rojo">Ir al panel</button></a>
</div>
<br>
@endsection