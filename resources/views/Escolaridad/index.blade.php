@extends('layouts.app')
@section('title', 'Escolaridades')
@section('Pag', 'Escolaridad')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Grados de Estudio Registrados</h3>
                @can('Escolaridad.create')
                    <a href="{{ route('Escolaridad.create') }}">
                        <button class="btn btn-success" style="float: right; margin-right: 10px;">
                            <i class="fa fa-plus"></i> Añadir Escolaridad
                        </button>
                    </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_escolaridad" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Escolaridad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Escolaridad</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($escolaridades as $escolaridad)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $escolaridad->Scholarship }}</td>
                                <td style="text-align: center;">
                                    @can('Escolaridad.edit')
                                    <a href="{{ route('Escolaridad.edit', $escolaridad->Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Escolaridad.destroy')
                                   <a href="{{ route('Escolaridad.destroy', $escolaridad->id) }}">
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
        $('#tb_escolaridad').DataTable();
    });
 </script>
 @endsection