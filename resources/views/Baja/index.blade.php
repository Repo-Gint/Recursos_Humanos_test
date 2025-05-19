@extends('layouts.app')

@section('title', 'Bajas')
@section('Pag', 'Bajas')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tipos de Bajas Registradas</h3>
                @can('Baja.create')
                <a href="{{ route('Baja.create') }}">
                    <button class="btn btn-success" style="float: right; margin-right: 10px;">
                        <i class="fa fa-plus"></i> Añadir Baja
                    </button>
                </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_baja" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Baja</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Baja</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $i = 0
                            @endphp
                            @foreach($bajas as $baja)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $baja->Type }}</td>
                                <td style="text-align: center;">
                                    @can('Baja.edit')
                                    <a href="{{ route('Baja.edit', $baja->Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Baja.destroy')
                                   <a href="{{ route('Baja.destroy', $baja->id) }}">
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
        $('#tb_baja').DataTable();
    });
 </script>
 @endsection