@extends('layouts.app')

@section('title', 'Empleados')
@section('Pag', 'Empleados / Bajas de Empleados / Información del Empleado')

@section('content')
@php 
  $bajas = Recursos_Humanos\Baja_Empleado::where('Employee_id', $empleado->id)->get();
  $fecha_alta = $contratacion->High_date;
  $dias_disfrutados = Dias_disfrutados($contratacion, $empleado);
  $saldo =  Saldo($fecha_alta, $dias_disfrutados);
  $periodos_historial = Periodos_historial($empleado);

  if($puesto->Parent_Puesto != NULL){
    $puesto_superior = $puesto->Parent_Puesto;
    $jefe_directo = $puesto_superior->empleado->last();
  }else{
    $puesto_superior = "";
    $jefe_directo = "";
  }
  
@endphp
<br>
<div class="row">
	<div class="col-lg-3">
		<div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ nombre($empleado, 'Mostrar') }}</h3>
        <p class="text-muted text-center">
          @foreach($bajas as $baja)
            Fecha de Baja: {{$baja->output_date}}
          @endforeach
      	</p>
        <div class="box-body">
				</div>
      </div>
    </div>
	</div>
	<div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#information" data-toggle="tab">Información</a></li>
        <li><a href="#career" data-toggle="tab">Carrera Profesional</a></li>
        <li><a href="#attacheds" data-toggle="tab">Anexos</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="information">
          <div class="row">
          	<div class="col-lg-12"> 
						  <center><label class="Datos">Datos Personales</label></center> 
					  </div>
				  </div>
				  <div class="row">
            <div class="col-lg-6"> 
  						<label class="Datos">Nombre:</label> {{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}<br>
  						<label class="Datos">Género:</label> {{ $datos->Gender }}<br>
  						<label class="Datos">Edad:</label><br>
  						<label class="Datos">Fecha de Nacimiento:</label> {{ Formato($datos->Birthdate) }}<br>
  						<label class="Datos">Lugar de nacimiento:</label> {{ $datos->Tows.', '.$datos->Municipality.', '.$datos->State.', '.$datos->Pais->Country }}<br>
  						<label class="Datos">Domicilio:</label> {{ $domicilio->Address.', '.$domicilio->Tows.', '.$domicilio->Municipality.', '.$domicilio->State.', '.$domicilio->Pais->Country.', C.P: '.$domicilio->Postcode }}<br>
  						<label class="Datos">Seguro social:</label> {{ $datos->Nss }}<br>
  						<label class="Datos">RFC:</label> {{ $datos->Rfc }}<br>
  						<label class="Datos">CURP:</label> {{ $datos->Curp }}<br>
					  </div>
					  <div class="col-lg-6">
  						<label class="Datos">Tipo de sangre:</label> {{ $datos->Blood }}<br>
  						<label class="Datos">Alergías:</label> {{ $datos->Allergy }}<br>
  						<label class="Datos">Estado civil:</label> {{ $datos->Marital_status }}<br>
  						<label class="Datos">Hijos:</label> {{ $datos->Children }}<br>
  						<label class="Datos">Grado de estudios:</label> @if($datos->Scholarchip_id == 0) {{ ' ' }} @else {{ $datos->Escolaridad->Scholarship }} @endif <br>
  						<label class="Datos">Comprobante de estudios:</label>@if($datos->Voucher_id == 0) {{ ' ' }} @else {{ $datos->Voucher->Voucher }} @endif <br>
  						<label class="Datos">Email:</label> {{ $contacto->Personal_mail }}<br>
  						<label class="Datos">Celular:</label> {{ $contacto->Personal_phone }}<br>
  						<label class="Datos">Teléfono fijo:</label> {{ $contacto->Landline }}<br>
					  </div>
          </div><br>
          <div class="row">
          	<div class="col-lg-12"> 
          		<center><label class="Datos">En caso de emergencia:</label></center>
          	</div>
          </div>
          <div class="row">
          	<div class="col-lg-4"> 
			        <center><label class="Datos">Llamar a:</label> {{ $contacto->Family }} </center>
          	</div>
          	<div class="col-lg-4"> 
			        <center><label class="Datos">Parentesco:</label> {{ $contacto->Relationship }} </center>
          	</div>
          	<div class="col-lg-4"> 
			        <center><label class="Datos">Teléfono:</label> {{ $contacto->Emergency_phone }} </center>
          	</div>
          </div>
          <hr>
          <div class="row">
          	<div class="col-lg-12"> 
          		<center><label class="Datos">Datos de Empleado</label></center>
          	</div>
          </div>
          <div class="row">
  					<div class="col-lg-6">
  						<label class="Datos">Empresa:</label> {{ $empleado->Empresa->Name }}<br>
  						<label class="Datos">Código de Empleado:</label> {{ $empleado->Code }}<br>
  						<label class="Datos">Fecha de Contratación:</label> {{ Formato($contratacion->High_date) }}<br>
  						<label class="Datos">Tipo de empleado:</label> {{ $tipo->Type }}<br>
  						<label class="Datos">Departamento:</label> {{ $departamento->Departament_ES }}<br>
  						<label class="Datos">Puesto:</label> {{ $puesto->Position_ES }}<br>
  						@if($puesto->Parent_id != null)
                @if($jefe_directo == null || empty($jefe_directo))
  						      <label class="Datos">Superior:</label> {{ $puesto_superior->Position_ES }}<br>
                @else
                  <label class="Datos">Superior:</label> 
                  {{ $puesto_superior->Position_ES.' - '.$jefe_directo->Names.' '.$jefe_directo->Paternal }}<br>
                @endif
  						@endif	
  					</div>
  					<div class="col-lg-6">
  						<label class="Datos">Email:</label> {{ $contacto->Business_mail }}<br>
  						<label class="Datos">Extensión:</label> {{ $contacto->Extension }}<br>
  						<label class="Datos">Celular:</label> {{ $contacto->Business_phone }}<br>
  						<label class="Datos">Banco:</label><br>
  						<label class="Datos">Número de cuenta:</label> <br>
  						<label class="Datos">Clabe interbancaria:</label><br>
  					</div>
          </div><br>
          <div class="row">
            <div class="col-lg-3"> 
			        <center>
			          <label class="Datos">Antiguedad:</label><br>
			          
			        </center> 
				    </div>
				    <div class="col-lg-3"> 
			        <center>
			          <label class="Datos">Periodo:</label><br>
			          
			        </center> 
				    </div>
				    <div class="col-lg-3"> 
			        <center>
			            <label class="Datos">Dias a disfrutar:</label><br>
			            
			        </center> 
				    </div>
				    <div class="col-lg-3"> 
				      <center>
			            <label class="Datos">Saldo:</label><br>
			           
				      </center> 
				    </div>
          </div>
          <div class="row">
    				<div class="col-lg-12">
    					@can('Vacaciones.index')
    					@include('Vacaciones.index', ['coleccion', $coleccion, 'empleado', $empleado, 'saldo', $saldo])
    					@endcan
    				</div>
    			</div>
        </div>
        <div class="tab-pane" id="career">
         	@include('Empleado.career', ['empleado', $empleado])
        </div>
        <div class="tab-pane" id="attacheds">
           @include('Empleado.anexos', ['empleado', $empleado])
        </div>
      </div>
    </div>
  </div>
</div>
{!! Html::script('plugins/jquery/jquery-3.3.1.js') !!}
@endsection