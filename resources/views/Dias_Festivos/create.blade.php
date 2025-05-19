@extends('layouts.app')

@section('title', 'Dias Festivos')
@section('Pag', 'Dias Festivos / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Registro</h3>
            </div>
            {!! Form::open(['route' => 'Dias_Festivos.store', 'method' => 'POST']) !!}
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                      <div class="col-lg-3">
                        {!!  Form::label('Mes', 'Mes: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Month', $meses, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una opción']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!!  Form::label('Dia', 'Dia: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::number('Day', null, ['class' => 'form-control', 'min' => 1, "max" => 31]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    
                     <div class="col-lg-6">
                        {!!  Form::label('Descripción', 'Descripción: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::textarea('Description', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Dias_Festivos.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection