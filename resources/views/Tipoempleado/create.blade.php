@extends('layouts.app')

@section('title', 'Tipo de Empleados')
@section('Pag', 'Tipo de Empleados / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Registro</h3>
            </div>
            {!! Form::open(['route' => 'Tipoempleado.store', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        {!!  Form::label('Tipo', 'Tipo: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                         <div class="col-lg-4">
                            {!!  Form::text('Type', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Tipoempleado.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>  
@endsection