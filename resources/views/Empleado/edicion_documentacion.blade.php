@php
    $cnt = 0;
    $t = 0;
    $cnt2 = 0;
    $t2 = 0;
    $cnt_documents = 0;
    $fecha_ingreso = $empleado->Contrataciones->last();
    $dif = diferencia_fechas(date('Y-m-d'), $fecha_ingreso->High_date, 'y');
@endphp
@extends('layouts.app')

@section('title', 'Documentación')
@section('Pag', 'Editar Documentación del empleado - '. $empleado->Names)
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Documentación</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                    {!! Form::open(['route' => array('Empleado.edicion_documentacion_edit', $empleado->id), 'method' => 'PUT']) !!}
                        <h4>DOCUMENTOS PERSONALES</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Documento</td>
                                    <td>Entrego</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                    @if($documento->Type_document == "Personal")
                                        @if(validar_documento_entregado($documento->id, $empleado->id))
                                        <tr>
                                            <td>
                                                <div style="display: none">
                                                    {!!  Form::number('documentos[]', $documento->id, ['class' => 'form-control']) !!}
                                                </div>
                                                @can('Empleado.documentacion')
                                                {!!  Form::select('Success[]', ['N/A' => 'N/A', 'OK' => 'OK'], null, ['class' => 'form-control', 'placeholder' => '', 'style' => 'width: 70%;']) !!}
                                                @endcan
                                            </td>
                                            <td>{{ $documento->Document }}</td>
                                            <td>Falta</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>
                                                <div style="display: none">
                                                    {!!  Form::number('documentos[]', $documento->id, ['class' => 'form-control']) !!}
                                                </div>
                                                @can('Empleado.documentacion')
                                                {!!  Form::select('Success[]', ['N/A' => 'N/A', 'OK' => 'OK'], documento_entregado($documento->id, $empleado->id), ['class' => 'form-control', 'placeholder' => '', 'style' => 'width: 70%;']) !!}
                                                @endcan
                                            </td>
                                            <td>{{ $documento->Document }}</td>
                                            <td>{{ documento_entregado($documento->id, $empleado->id) }}</td>
                                        </tr>
                                        @endif

                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4>DOCUMENTOS DE CONTRATACIÓN</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Documento</td>
                                    <td>Entrego</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                    @if($documento->Type_document == "Contratacion")
                                        @if(validar_documento_entregado($documento->id, $empleado->id))
                                        <tr>
                                            <td>
                                                <div style="display: none">
                                                    {!!  Form::number('documentos[]', $documento->id, ['class' => 'form-control']) !!}
                                                </div>
                                                @can('Empleado.documentacion')
                                                {!!  Form::select('Success[]', ['N/A' => 'N/A', 'OK' => 'OK'], null, ['class' => 'form-control', 'placeholder' => '', 'style' => 'width: 70%;']) !!}
                                                @endcan
                                            </td>
                                            <td>{{ $documento->Document }}</td>
                                            <td>Falta</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>
                                                <div style="display: none">
                                                    {!!  Form::number('documentos[]', $documento->id, ['class' => 'form-control']) !!}
                                                </div>
                                                @can('Empleado.documentacion')
                                                {!!  Form::select('Success[]', ['N/A' => 'N/A', 'OK' => 'OK'], documento_entregado($documento->id, $empleado->id), ['class' => 'form-control', 'placeholder' => '', 'style' => 'width: 70%;']) !!}
                                                @endcan
                                            </td>
                                            <td>{{ $documento->Document }}</td>
                                            <td>{{ documento_entregado($documento->id, $empleado->id) }}</td>
                                        </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="text-align: center;">
                <div class="row">
                    <div class="col-md-6">
                        {!!  Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
                    </div>
                    <div class="col-md-6">
                         <a class="btn btn-danger btn-sm btn-block" href="{{ route('Empleado.show', $empleado->Slug) }}" role="button">Cancelar</a>
                    </div>
                </div>   
            </div>
            {!! Form::close() !!}
        </div> 
    </div>
</div>   
@endsection