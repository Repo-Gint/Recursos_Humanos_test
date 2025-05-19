@extends('layouts.app')

@section('title', 'Roles')
@section('Pag', 'Roles')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Roles Registrados</h3>
                @can('Rol.create')
                    <a href="{{ route('Rol.create') }}">
                        <button class="btn btn-success" style="float: right; margin-right: 10px;"><i class="fa fa-plus"></i> Añadir Rol
                        </button>
                    </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_rol" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($roles as $rol)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $rol->name }}</td>
                                <td>{{ $rol->description }}</td>
                                <td style="text-align: center;">
                                    @can('Rol.edit')
                                    <a href="{{ route('Rol.edit', $rol->slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Rol.destroy')
                                    <a href="{{ route('Rol.destroy', $rol->id) }}">
                                        <button class="btn btn-danger badge badge-dange" onclick="return confirm('¿Seguro de eliminar el registro?')"><i class="fa fa-trash-o"></i></button>
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
        $('#tb_rol').DataTable();
    });
 </script>
 @endsection