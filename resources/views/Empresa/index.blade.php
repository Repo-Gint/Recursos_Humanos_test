@extends('layouts.app')

@section('title', 'Empresas')
@section('Pag', 'Empresas')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Empresas Registradas</h3>
                @can('Empresa.create')
                <a href="{{ route('Empresa.create') }}">
                    <button class="btn btn-success" style="float: right; margin-right: 10px;">
                        <i class="fa fa-plus"></i> Añadir Empresa
                    </button>
                </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_empresa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Colonia</th>
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th>Pais</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Pais</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($empresas as $empresa)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $empresa->Name }}</td>
                                <td>{{ $empresa->Address }}</td>
                                <td>{{ $empresa->Tows }}</td>
                                <td>{{ $empresa->Municipality }}</td>
                                <td>{{ $empresa->State }}</td>
                                <td>{{ $empresa->Country }}</td>
                                <td>{{ $empresa->Phone }}</td>
                                <td style="text-align: center;">
                                    @can('Empresa.edit')
                                    <a href="{{ route('Empresa.edit', $empresa->Company_slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Empresa.destroy')
                                    <a href="{{ route('Empresa.destroy', $empresa->Company_id) }}">
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
        $('#tb_empresa').DataTable();
        select: true
    });
 </script>
 @endsection