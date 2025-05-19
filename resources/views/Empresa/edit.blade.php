@extends('layouts.app')

@section('title', 'Empresas')
@section('Pag', 'Empresas / Editar');
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Registro</h3>
            </div>
            {!! Form::open(['route' => array('Empresa.update', $empresa->id), 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-3">
                            {!!  Form::label('Nomenclatura', '* Nomenclatura: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Acronym', $empresa->Acronym, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                         <div class="col-lg-3">
                            {!!  Form::label('Nombre', '* Nombre: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Name', $empresa->Name, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            {!!  Form::label('Pais', '* Pais: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::select('Country_id', $paises, $empresa->Country_id, ['class' => 'form-control', 'placeholder' => 'Selecciona un pais']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Estado', '* Estado: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('State', $empresa->State, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Municipio', '* Municipio: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Municipality', $empresa->Municipality, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            {!!  Form::label('Localidad', '*Localidad: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Tows', $empresa->Tows, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Direccion', '*Dirección: ', ['class' => 'col-form-label']) !!}
                            {!!  Form::text('Address', $empresa->Address, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-lg-4">
                            {!!  Form::label('Telefono', 'Teléfono: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                            {!!  Form::text('Phone', $empresa->Phone, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                    <div class="row">
                            <div class="col-md-6">
                                {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
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