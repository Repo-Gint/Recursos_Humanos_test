@extends('layouts.app')

@section('title', 'Documentos')
@section('Pag', 'Documentos / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Registro</h3>
            </div>
            {!! Form::open(['route' => 'Documento.store', 'method' => 'POST']) !!}
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Documento', 'Documento: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('Document', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Tipo', 'Tipo de documento: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">             
                        {!!  Form::select('Type_document', $tipos, null, ['class' => 'form-control', 'placeholder' => 'selecciona una opción']) !!}
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Importante', 'Importante: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">             
                        {!!  Form::select('Important', $importante, null, ['class' => 'form-control', 'placeholder' => 'selecciona una opción']) !!}
                    </div>
                </div> 
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Documento.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection