@extends('layouts.app')

@section('title', 'Empleados')
@section('Pag', 'Empleados / Bajas de Empleados')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Empleados Inactivos</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_empleado" width="100%" cellspacing="0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th>F. ingreso</th>
                                <th>F. baja</th>
                                <th>Duración</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Departamento</th>
                                <th>F. ingreso</th>
                                <th>F. baja</th>
                                <th>Duración</th>
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
                                $contratacion = $empleado->Contrataciones->last();
                            @endphp
                            <tr>
                                <td style="vertical-align: middle;">{{ $i }}</td>
                                <td><img src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" class="img-circle" width="50"></td>
                                <td style="vertical-align: middle;">{{ $empleado->Employee_Code }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Names." ".$empleado->Paternal." ".$empleado->Maternal  }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Position_ES }}</td>
                                <td style="vertical-align: middle;">{{ $empleado->Departament_ES }}</td>
                                <td style="vertical-align: middle;">{{ formato($contratacion->High_date) }}</td>
                                <td style="vertical-align: middle;"><span style="display: none;">{{ Formato_ingles($contratacion->Low_date) }}</span>{{ formato($contratacion->Low_date) }}</td>
                                <td style="vertical-align: middle;">{{ empleado_duracion($contratacion->High_date, $contratacion->Low_date) }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @can('Empleado.información_del_empleado_baja')
                                    <a href="{{ route('Empleado.información_del_empleado_baja', $empleado->Employee_Slug) }}">
                                        <button class="btn btn-default badge badge-default" ><i class="fa fa-eye"></i></button>
                                    </a>
                                    @endcan
                                    @can('Empleado.edit')
                                    <a href="{{ route('Empleado.recontratar', $empleado->Employee_Slug) }}">
                                        <button class="btn btn-warning badge badge-warning" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Empleado.destroy')
                                    <a href="{{ route('Empleado.destroy', $empleado->id) }}">
                                      <button class="btn btn-danger badge badge-danger" onclick="return confirm('¿Seguro de eliminar el registro? Si se elimina al empleado, se eliminara todo lo relacionado a este.')"><i class="fa fa-trash"></i></button>
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
<!--<script type="text/javascript" src="https://cdn.datatables.net/w/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-print-1.5.6/r-2.2.2/datatables.min.js"></script>-->
<script type="text/javascript" src="{{ asset('plugins/datatables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.bootstrap4.js') }}"></script>
 <script type="text/javascript">
    $(document).ready( function () {
         $('#tb_empleado').DataTable( {
            "order": [[ 7, "desc" ]]
        } );
    });
 </script>
 @endsection