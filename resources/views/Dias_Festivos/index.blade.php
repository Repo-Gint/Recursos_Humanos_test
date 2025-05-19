@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Dias Festivos ')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Dias Festivos Registrados</h3>
                @can('Dias_Festivos.create')
                <a href="{{ route('Dias_Festivos.create') }}">
                    <button class="btn btn-success" style="float: right; margin-right: 10px;">
                        <i class="fa fa-plus"></i> Añadir Día
                    </button>
                </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_dia" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mes</th>
                                <th>Día</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Mes</th>
                                <th>Día</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($dias as $dia)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ mes_espanol($dia->Month) }}</td>
                                <td>{{ $dia->Day }}</td>
                                <td>{{ $dia->Description }}</td>
                                <td style="text-align: center;">
                                    @can('Dias_Festivos.edit')
                                    <a href="{{ route('Dias_Festivos.edit', $dia->Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Dias_Festivos.destroy')
                                   <a href="{{ route('Dias_Festivos.destroy', $dia->id) }}">
                                        <button class="btn btn-danger badge badge-danger" onclick="return confirm('¿Seguro de eliminar el registro?')"><i class="fa fa-trash-o"></i></button>
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
<script type="text/javascript" src="{{ asset('plugins/datatables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.bootstrap4.js') }}"></script>
 <script type="text/javascript">
    $(document).ready( function () {
        $('#tb_dia').DataTable();
    });
 </script>
 @endsection