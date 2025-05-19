@extends('layouts.app')

@section('title', 'Puestos')
@section('Pag', 'Puestos / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Registro</h3>
            </div>
            {!! Form::open(['route' => 'Puesto.store', 'method' => 'POST' ]) !!}
            <div class="box-body">
                <div class="form-group row">
                     <div class="col-lg-3">
                        {!!  Form::label('Puesto', '* Código de puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Code', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                     </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!!  Form::label('Puesto', '* Puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Position_ES', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Position', '* Position: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Position_EN', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Vacantes', 'Vacantes: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::number('Vacancies', 1, ['class' => 'form-control', 'autocomplete' => 'off', 'min' => 1]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!!  Form::label('Departamento', '* Departamento: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Departament_id', $departamentos, null, ['class' => 'form-control Departamento', 'placeholder' => 'Selecciona un departamento', 'value' => old('Departament_id')]) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Jerarquia', '* Jerarquia: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Hierarchy_id', $jerarquias, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un nivel', 'value' => old('Hierarchy_id') ]) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Superior', 'Puesto Superior: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Parent_id', [], null, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona al jefe inmediato', 'value' => old('Parent_id')]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {!!  Form::label('Descricion', 'Descripción del puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::textarea('Descripcion', null, ['class' => 'form-control', 'placeholder' => 'Describe el puesto']) !!}
                    </div>
                    <div class="col-lg-6">
                        {!!  Form::label('Responsabilidades', 'Responsabilidades: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::textarea('Responsability', null, ['class' => 'form-control', 'placeholder' => 'Describe las Responsabilidades del puesto']) !!}
                    </div>
                </div>
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Puesto.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('javascript')
{!! Html::script('plugins/jquery/jquery-3.3.1.js') !!}
{!! Html::script('plugins/jquery/functions/Puesto/function_generals.js') !!}
@endsection