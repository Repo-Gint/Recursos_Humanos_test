@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Estados civiles / Editar')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de registro</h3>
            </div>
            {!! Form::open(['route' => array('Estado_Civil.update', $estado->id), 'method' => 'PUT']) !!}
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Baja', 'Estado: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('status', $estado->status, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
                    </div>
                    <div class="col-md-6">
                         <a class="btn btn-danger btn-sm btn-block" href="{{ route('Estado_Civil.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div> 
</div>   
@endsection