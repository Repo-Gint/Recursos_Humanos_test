@extends('layouts.app')

@section('title', 'Empleados')
@section('Pag', 'Empleados')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Empleados Registrados</h3>
                @can('Empleado.create')
                <a href="{{ route('Empleado.create') }}">
                    <button class="btn btn-success" style="float: right; margin-right: 10px;">
                        <i class="fa fa-user-plus"></i> Añadir Empleado
                    </button>
                </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_empleado" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th>F. de Ingreso</th>
                                <th>Antiguedad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th>F. de Ingreso</th>
                                <th>Antiguedad</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($empleados as $empleado)
                            @php
                                $i++;
                                $fecha_alta = $empleado->Contrataciones->last();
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" class="img-circle" width="50">
                                </td>
                                <td style="vertical-align: middle;">{{ $empleado->Employee_Code }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Names." ".$empleado->Paternal." ".$empleado->Maternal  }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Position_ES }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Departament_ES }}</td>
                                <td style="vertical-align: middle;"><span style="display: none;">{{ Formato_ingles($fecha_alta->High_date) }}</span>{{ Formato($fecha_alta->High_date) }}</td>
                                <td style="vertical-align: middle;">{{ Antiguedad($fecha_alta->High_date) }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @can('Empleado.show')
                                    <a href="{{ route('Empleado.show', $empleado->Employee_Code) }}">
                                        <button class="btn btn-default badge badge-default" ><i class="fa fa-eye"></i></button>
                                    </a>
                                    @endcan
                                    @can('Empleado.edit')
                                    <a href="{{ route('Empleado.edit', $empleado->Employee_Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                </td>     
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<!--
<script type="text/javascript" src="https://cdn.datatables.net/w/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>-->
<script type="text/javascript" src="{{ asset('plugins/datatables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.bootstrap4.js') }}"></script>
 <script type="text/javascript">
    $(document).ready( function () {
        $('#tb_empleado').DataTable( {
            "order": [[ 5, "desc" ]]
        });
    });
 </script>
 @endsection