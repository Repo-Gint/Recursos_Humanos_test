@extends('layouts.app')

@section('title', 'Jerarquias')
@section('Pag', 'Jerarquias / Editar')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Registro</h3>
            </div>
            {!! Form::open(['route' => array('Jerarquia.update', $jerarquia->id), 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        {!!  Form::label('Nivel', 'Nivel: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                        <div class="col-lg-4">
                            {!!  Form::Number('Level', $jerarquia->Level, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        {!!  Form::label('Jerarquia', 'Nombre: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                         <div class="col-lg-4">
                            {!!  Form::text('Name_ES', $jerarquia->Name_ES, ['class' => 'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3"></div>
                        {!!  Form::label('Jerarquia', 'Name: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                         <div class="col-lg-4">
                            {!!  Form::text('Name_EN', $jerarquia->Name_EN, ['class' => 'form-control', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Jerarquia.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>
                </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div> 
</div> 
@endsection