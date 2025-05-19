
@extends('layouts.app')
@section('title', 'Empleados')
@section('Pag', 'Empleados / Información del empleado ')
@section('content')
@php 
  $edad = Edad($datos->Birthdate);
	$fecha_alta = $contratacion->High_date;
	$antiguedad = Antiguedad($fecha_alta);
	$periodo_actual = Periodo_actual($fecha_alta);
	$dias_disfrutar =  Dias_Disfrutar($fecha_alta, $tipo->id);
	$dias_disfrutados = Dias_disfrutados($contratacion, $empleado);
  /*
  *excepciones para cierto empleados, se agregaran dias a su saldo
  * Juan Martinez, César Rojas, Jesus Alvarez, Jorge Aldaco, Aldair
  */
  $saldo =  Saldo($fecha_alta, $dias_disfrutados);
  if($empleado->Code == 2074){
    $saldo = $saldo + 8;
  }
  if($empleado->Code == 2244){
    $saldo = $saldo + 10;
  }
  if($empleado->Code == 2246){
    $saldo = $saldo + 5;
  }
  if($empleado->Code == 2243){
    $saldo = $saldo + 19;
  }
  if($empleado->Code == 2242){
    $saldo = $saldo + 17;
  }
   $periodos_historial = Periodos_historial($empleado);

   if($puesto_actual->Parent_Puesto != NULL){
      $puesto_superior = $puesto_actual->Parent_Puesto;
      $jefe_directo = $puesto_superior->empleado->last();
   }else{
      $puesto_superior = "";
      $jefe_directo = "";
   }
   if($empleado->User != NULL){
      $usuario = $empleado->User;
   }
  
@endphp
<br>
<div class="row">
	<div class="col-lg-3">
		<div class="box box-primary">
         <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $empleado->Code.' | '.nombre($empleado, 'Mostrar') }}</h3>
            <p class="text-muted text-center">
      		   {{ $puesto_actual->Position_ES }}<br>
      		    @can('Empleado.edit')
               <a href="{{ route('Empleado.edit', $empleado->Slug) }}">
                  <i class="fa fa-edit"></i> Editar
               </a>
               @endcan
      	   </p>
            <div class="box-body">
              <strong> Fecha de Contratación:</strong> {{ Formato($contratacion->High_date) }}
      					<hr>
      					{{--<strong>Edad:</strong>{{ $edad }}
      					<hr>
                     <strong>Celular:</strong> {{ $contacto->Personal_phone }}
      					<hr>
                     <strong>Correo:</strong> <p class="text-muted">{{ $contacto->Personal_mail }}</p>
      					<hr>--}}
               <center><strong>Acciones</strong></center><br>
               <div class="btn-group-vertical" style="width: 100%;">
   					@if($contratacion->Typecontract_id != 1)
   					   @php 
   		               $dias = diferencia_fechas($contratacion->Ending,date('Y-m-d'),"days"); 
   		            @endphp
                     @if($dias <= 15&& ($tipo->Type == "Confianza" || $tipo->Type == "Sindicalizado"))
                       @can('Empleado.contratar')
      	               <button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#modal-contrato-empleado">Contratar</button>
                       @endcan
      			      @endif
                  @endif
                  @if($tipo->Type != "Confianza" && $tipo->Type != "Sindicalizado")
                      @can('Empleado.contratar')
                      <button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#modal-contrato-dual">Contratar</button>
                      @endcan
                  @endif
                  @can('Empleado.asignar')
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-nuevo-puesto">Asignar nuevo puesto</button>
                  @endcan
               </div>
            </div>
         </div>
      </div>
	</div>
	<div class="col-md-9">
      <div class="nav-tabs-custom">
         <ul class="nav nav-tabs">
              <li class="active"><a href="#information" data-toggle="tab">Información</a></li>
              <li><a href="#documents" data-toggle="tab">Documentos</a></li>
              <li><a href="#career" data-toggle="tab">Carrera Profesional</a></li>
              @can('Vacaciones.create')
              <li><a href="#holidays" data-toggle="tab">Vacaciones</a></li>
              @endcan
              @can('Empleado.roles')
              <li><a href="#roles" data-toggle="tab">Roles y Usuario</a></li>
              @endcan
              <li><a href="#attacheds" data-toggle="tab">Anexos</a></li>
         </ul>
         <div class="tab-content">
            <div class="active tab-pane" id="information">
               <center><label class="Datos">Datos Personales</label></center> 
					<div class="row">
                  <div class="col-lg-6"> 
     						<label class="Datos">Nombre:</label> {{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}<br>
     						<label class="Datos">Género:</label> {{ $datos->Gender }}<br>
     						<label class="Datos">Edad:</label> {{ $edad }}<br>
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
               <hr>
               <center><label class="Datos">En caso de emergencia:</label></center>
               <div class="row">
          	      <div class="col-lg-4"> 
			            <center><label class="Datos">Llamar a:</label> {{ $contacto->Family }} </center>
          	      </div>
          	      <div class="col-lg-4"> 
			            <center><label class="Datos">Parentesco:</label> {{ ($contacto->Relationship_id == null) ? ' ' : $contacto->Familiar->relationship }} </center>
          	      </div>
          	      <div class="col-lg-4"> 
			            <center><label class="Datos">Teléfono:</label> {{ $contacto->Emergency_phone }} </center>
          	      </div>
               </div>
               <hr>
               <center><label class="Datos">Datos de Empleado</label></center>
               <div class="row">
        				<div class="col-lg-6">
        					<label class="Datos">Empresa:</label> {{ $empleado->Empresa->Name }}<br>
        					<label class="Datos">Código de Empleado:</label> {{ $empleado->Code }}<br>
        					<label class="Datos">Fecha de Contratación:</label> {{ Formato($contratacion->High_date) }}<br>
        					<label class="Datos">Tipo de empleado:</label> {{ $tipo->Type }}<br>
        					<label class="Datos">Departamento:</label> {{ $departamento->Departament_ES }}<br>
        					<label class="Datos">Puesto:</label> {{ $puesto_actual->Position_ES }}<br>
        					@if($puesto_actual->Parent_id != null)
                        @if($jefe_directo == null || empty($jefe_directo))
        					      <label class="Datos">Superior:</label> {{ $puesto_superior->Position_ES }}<br>
                        @else
                           <label class="Datos">Superior:</label> {{ $puesto_superior->Position_ES.' - '.$jefe_directo->Names.' '.$jefe_directo->Paternal }}<br>
                        @endif
        					@endif	
        				</div>
        				<div class="col-lg-6">
        					<label class="Datos">Email:</label> {{ $contacto->Business_mail }}<br>
        					<label class="Datos">Extensión:</label> {{ $contacto->Extension }}<br>
        					<label class="Datos">Celular:</label> {{ $contacto->Business_phone }}<br>
        					<label class="Datos">Banco:</label> {{ ($banco->Banco == Null) ? ' ' : $banco->Banco->Name }}<br>
        					<label class="Datos">Número de cuenta:</label> {{ $banco->Count }}<br>
        					<label class="Datos">Clabe interbancaria:</label> {{ $banco->Clabe_bank }}<br>
        				</div>
               </div><br>
               <div class="row">
                  <div class="col-lg-3"> 
   			        <center>
   			            <label class="Datos">Antiguedad:</label><br>
   			            {{ $antiguedad }}
   			        </center> 
				      </div>
				      <div class="col-lg-3"> 
			            <center>
			               <label class="Datos">Periodo:</label><br>
			               {{ $periodo_actual }}
			            </center> 
				      </div>
				      <div class="col-lg-3"> 
			            <center>
			               <label class="Datos">Dias a disfrutar nueva ley:</label><br>
			               {{ $dias_disfrutar }}
			            </center> 
				      </div>
				      <div class="col-lg-3"> 
				         <center>
			               <label class="Datos">Saldo:</label><br>
			               {{ $saldo }}
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
            <div class="tab-pane" id="documents">
               @include('Empleado.documentacion', ['empleado', $empleado])
            </div>
            <div class="tab-pane" id="career">
         	  @include('Empleado.career', ['empleado', $empleado])
            </div>
            @can('Vacaciones.create')
            <div class="tab-pane" id="holidays">
              @include('Vacaciones.create', ['empleado', $empleado, 'periodo', $periodo_actual, 'contratacion', $fecha_alta, 'saldo', $saldo])
            </div>
            @endcan
            @can('Empleado.roles')
            <div class="tab-pane" id="roles">
              @include('Empleado.roles', ['usuario', $usuario, 'roles', $roles, 'empleado', $empleado, 'contacto', $contacto])
	  			  </div>
            @endcan
            <div class="tab-pane"  id="attacheds">
               @include('Empleado.anexos', ['empleado', $empleado])
            </div>
         </div>
      </div>
   </div>
</div>
@php
  $dias_festivos =dias_festivos();
@endphp
@include('Empleado.modals.modals_show')
@endsection

@section('javascript')
  {!! Html::script('plugins/jquery/functions/Empleado/function_generals.js') !!}
  <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker3.css')}}">
  
  <script type="text/javascript" src="https://cdn.datatables.net/w/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>
  <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
  <script type="text/javascript">
    //Funcion para la tabla de registro de vacaciones.
    var groupColumn = 1;
    $('#tb_vacaciones').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'desc' ]],

        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ){
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" ><th colspan="6" style="text-align: center;">'+group+'</th></tr>'
                    );
                    last = group;
                }
            });
        }
    });

    //Funcion para los calendarios del modulo asignas vacaciones
     $(document).ready( function () {
    /*$('.datepicker').datepicker({
          language: "es",
          format: "yyyy-mm-dd",
          todayHighlight: true,
          autoclose: true,
          daysOfWeekDisabled: "0,6",
          daysOfWeekHighlighted: "0,6"
      });*/
      var natDays = [{!! $dias_festivos !!}];
$('.datepicker').datepicker({
  language: "es",
          format: "yyyy-mm-dd",
          todayHighlight: true,
          autoclose: true,
          daysOfWeekDisabled: "0,6",
          daysOfWeekHighlighted: "0,6",
    beforeShowDay: function(date){
      
         for (var i = 0; i < natDays.length; i++) {

            if (date.getMonth() == natDays[i][0] - 1 && date.getDate() == natDays[i][1]) {
            
                return { enabled: false, tooltip: natDays[i][2], classes:'selected'};
        }
      }
      
    }

});
    });
  </script>
 @endsection