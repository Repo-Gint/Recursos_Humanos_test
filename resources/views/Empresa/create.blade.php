@extends('layouts.app')

@section('title', 'Empresas')
@section('Pag', 'Empresas / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Registro</h3>
            </div>
            {!! Form::open(['route' => 'Empresa.store', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-3">
                            {!!  Form::label('Nomenclatura', '* Nomenclatura: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Acronym', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                         <div class="col-lg-3">
                            {!!  Form::label('Nombre', '* Nombre: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            {!!  Form::label('Pais', '* Pais: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::select('Country_id', $paises, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un pais']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Estado', '* Estado: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('State', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Municipio', '* Municipio: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Municipality', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            {!!  Form::label('Localidad', '*Localidad: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Tows', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Direccion', '*Dirección: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Address', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Telefono', 'Teléfono: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                            {!!  Form::text('Phone', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                        <div class="row">
                            <div class="col-md-6">
                                {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                            </div>
                            <div class="col-md-6">
                                 <a class="btn btn-danger btn-sm btn-block" href="{{ route('Empresa.index') }}" role="button">Cancelar</a>
                            </div>
                        </div>   
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection