@extends('layouts.app')

@section('title', 'Puestos')
@section('Pag', 'Puestos / Editar ')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Registro</h3>
            </div>
            {!! Form::open(['route' => array('Puesto.update', $puesto->id), 'method' => 'PUT']) !!}
            <div class="box-body">
                <div class="form-group row">
                     <div class="col-lg-3">
                        {!!  Form::label('Puesto', '* Código de puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Code', $puesto->Code, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                     </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!!  Form::label('Puesto', '* Puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Position_ES', $puesto->Position_ES, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Position', '* Position: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Position_EN', $puesto->Position_EN, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Vacantes', 'Vacantes: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::number('Vacancies', $puesto->Vacancies, ['class' => 'form-control', 'autocomplete' => 'off', 'min' => 1]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        {!!  Form::label('Departamento', '* Departamento: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Departament_id', $departamentos, $puesto->Departament_id, ['class' => 'form-control Departamento', 'placeholder' => 'Selecciona un departamento']) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Jerarquia', '* Jerarquia: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Hierarchy_id', $jerarquias, $puesto->Hierarchy_id, ['class' => 'form-control', 'placeholder' => 'Selecciona un nivel' ]) !!}
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('Superior', 'Puesto Superior: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Parent_id', $puestos, $puesto->Parent_id, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona al jefe inmediato']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {!!  Form::label('Descricion', 'Descripción del puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::textarea('Descripcion', $puesto->Descripcion, ['class' => 'form-control', 'placeholder' => 'Selecciona al jefe inmediato']) !!}
                    </div>
                    <div class="col-lg-6">
                        {!!  Form::label('Responsabilidades', 'Responsabilidades: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::textarea('Responsability', $puesto->Responsability, ['class' => 'form-control', 'placeholder' => 'Selecciona al jefe inmediato']) !!}
                    </div>
                </div>
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
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
{!! Html::script('plugins/jquery/functions/Puesto/edit.js') !!}
@endsection