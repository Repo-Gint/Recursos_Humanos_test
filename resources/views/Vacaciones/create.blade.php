<div class="row">
    <div class="col-lg-12"> 
        <center><label class="Datos">Asignar Vacaciones</label></center> 
    </div>
</div>
@php
    $dias = diferencia_fechas(date('Y-m-d'), $contratacion->High_date, 'days'); 
    $tipo = $empleado->Tipo_empleado->last();
    $msj = validar_asignacion_vacaciones($dias, $saldo, $tipo);    
@endphp
<div class="row">
	<div class="col-lg-12"> 
        @if($msj == 'Ninguno')
    		{!! Form::open(['route' => 'Vacaciones.store', 'method' => 'POST']) !!}
                <div class="form-group row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-2">
                         <center>
                            {!! Form::label('monday', 'Pagadas:', ['class' => 'col-form-label']) !!}
                            {!! Form::select('Paid', [ 0 => 'NO', 1 => 'SI'], 0, ['class' => 'form-control', 'id'=>'pagadas']) !!}
                        </center>
                    </div>
                    <div class="col-lg-5"></div>
                </div>
                <div id="NO">
                     <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            {!!  Form::label('F_Inicio', '*Fecha de Inicio: ', ['class' => 'col-form-label']) !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!!  Form::text('Start_date', null, ['class' => 'form-control pull-right datepicker', 'autocomplete' => 'off', 'id' => 'Start_date']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!!  Form::label('F_Fin', '*Fecha de Fin: ', ['class' => 'col-form-label']) !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!!  Form::text('Ending_date', null, ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'id' => 'Ending_date']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
                <div id="SI" style="display: none;">
                     <div class="form-group row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            {!!  Form::label('F_pago', '*Fecha de pago: ', ['class' => 'col-form-label']) !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!!  Form::text('Paid_date', null, ['class' => 'form-control pull-right datepicker', 'autocomplete' => 'off', 'id' => 'Paid_date']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!!  Form::label('Dias', '*Dias pagados: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::number('Paid_days', null, ['class' => 'form-control', 'min' => '1', 'id' => 'Paid_days']) !!}
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
                    {!!  Form::hidden('Period', $periodo_actual, ['class' => 'form-control']) !!}
                    {!!  Form::hidden('Saldo', $saldo, ['class' => 'form-control']) !!}
                    {!!  Form::hidden('Employee_id', $empleado->id, ['class' => 'form-control']) !!}
                    {!!  Form::hidden('Contratacion', $contratacion->High_date, ['class' => 'form-control']) !!}
                    {!!  Form::hidden('Employee_slug', $empleado->Slug, ['class' => 'form-control']) !!}
                <div class="row">
                     <div class="col-lg-4"></div>
                     <div class="col-lg-4">
                         {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block', 'style'=>'margin-top: 40px;']); !!}
                     </div>
                     <div class="col-lg-4"></div>
                </div>
            {!! Form::close() !!}
        @else
            <center><h3>{{ $msj }}</h3></center>
        @endif
	</div>
</div>

