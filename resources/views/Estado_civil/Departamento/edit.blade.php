@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Departamentos / Editar')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Registro</h3>
            </div>
            {!! Form::open(['route' => array('Departamento.update', $departamento->id), 'method' => 'PUT']) !!}
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Departamento', 'Departamento: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('Departament_ES', $departamento->Departament_ES, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Departament', 'Departament: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('Departament_EN', $departamento->Departament_EN, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Nomenclatura', 'Nomenclatura: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('Acronym', $departamento->Acronym, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Parent', 'Departamento superior: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::select('Parent_id', $departamentos, $departamento->Parent_id, ['class' => 'form-control', 'placeholder' => 'Selecciona un superior']) !!}
                    </div>
                </div> 
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Departamento.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div> 
</div>   
@endsection