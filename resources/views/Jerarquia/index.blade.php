@extends('layouts.app')

@section('title', 'Jerarquias')
@section('Pag', 'Jerarquias')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Jerarquias Registradas</h3>
                @can('Jerarquia.create')
                    <a href="{{ route('Jerarquia.create') }}">
                        <button class="btn btn-success" style="float: right; margin-right: 10px;">
                            <i class="fa fa-plus"></i> Añadir Jerarquia
                        </button>
                    </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_jerarquia" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Nombre</th>
                                <th>Name</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nivel</th>
                                <th>Nombre</th>
                                <th>Name</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($jerarquias as $jerarquia)
                            <tr>
                                <td>{{ $jerarquia->Level }}</td>
                                <td>{{ $jerarquia->Name_ES }}</td>
                                <td>{{ $jerarquia->Name_EN }}</td>
                                <td style="text-align: center;">
                                    @can('Jerarquia.edit')
                                    <a href="{{ route('Jerarquia.edit', $jerarquia->Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Jerarquia.destroy')
                                    <a href="{{ route('Jerarquia.destroy', $jerarquia->id) }}">
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
        $('#tb_jerarquia').DataTable();
        select: true
    });
 </script>
 @endsection