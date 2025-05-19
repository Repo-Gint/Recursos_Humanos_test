@php
    $cnt = 0;
    $t = 0;
    $t2 = 0;
    $cnt_documents = 0;
    $fecha_ingreso = $empleado->Contrataciones->last();
    $dif = diferencia_fechas(date('Y-m-d'), $fecha_ingreso->High_date, 'y');
@endphp
<br>
<div class="table-responsive">
    <table class="table">
        <thead>
        	<tr>
                <th>Documento</th>
                <th>Acciones</th>
        	</tr>
        </thead>
        <tbody>
            <tr>
                <td style="">Caratula de expediente</td>
                <td style="">
                    <a href="{{ route('caratula', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="">Carta compromiso</td>
                <td style="">
                    <a href="{{ route('carta', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
            @if($dif > 0)
            <tr>
                <td style="">Constancia de vacaciones</td>
                <td style="">
                    <a href="{{ route('constancia_vacaciones', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
            @endif
            <tr>
                <td style="">Acuerdo laboral sobre confidencialidad</td>
                <td style="">
                    <a href="{{ route('acuerdo', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="">Credito INFONAVIT y FONACOT</td>
                <td style="">
                    <a href="{{ route('credito', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="">Evaluación</td>
                <td style="">
                    <a href="{{ route('evaluacion', $empleado->Slug) }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    {!! Form::open(['route' => array('Empleado.documentacion', $empleado->id), 'method' => 'PUT']) !!}
    <div class="col-lg-6">
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
                        @php
                            $cnt_documents++;
                        @endphp
                        @if(validar_documento_entregado($documento->id, $empleado->id))
                        @php
                            $cnt++;
                        @endphp
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
                            @php
                            $t++;
                            @endphp
                            <td></td>
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
                {!! Form::open(['route' => array('Empleado.documentacion', $empleado->id), 'method' => 'PUT']) !!}
                @foreach($documentos as $documento)
                    @if($documento->Type_document == "Contratacion")
                        @php
                            $cnt_documents++;
                        @endphp
                        @if(validar_documento_entregado($documento->id, $empleado->id))
                        @php
                            $cnt++;
                        @endphp
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
                            @php
                            $t2++;
                            @endphp
                            <td></td>
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
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    @if($cnt > 0)
        @can('Empleado.documentacion')
         {!!  Form::submit('Actualizar', ['class' => 'btn btn-success btn-sm btn-block']) !!}
        @endcan
        {!! Form::close() !!}

    @else
         {!! Form::close() !!}
        @can('Empleado.edicion_documentacion')
        <a href="{{ route('Empleado.edicion_documentacion', $empleado->Slug) }}">
            <button class="btn btn-primary  btn-sm btn-block" style="float: right; margin-right: 10px;">
                <i class="fa fa-edit"></i> Editar documentación
            </button>
        </a>
        @endcan
    @endif
    
    </div>
    <div class="col-md-4"></div>
</div>

<br>
@php
$porcentaje = 0;
if($cnt_documents>0){
    $num = (($t + $t2)*100)/$cnt_documents ;
   $porcentaje = number_format($num, 2);
}
   
@endphp
Expediente completo: {{ $porcentaje }}% 

@if($porcentaje > 0 && $porcentaje <= 33.33)
<div class="progress active">
    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $porcentaje }}%;">
    </div>
</div>
@else
    @if($porcentaje > 33.33 && $porcentaje <= 66.66)
        <div class="progress active">
            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $porcentaje }}%;">
            </div>
        </div>
    @else
        <div class="progress active">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $porcentaje }}%;">
            </div>
        </div>
    @endif
@endif
