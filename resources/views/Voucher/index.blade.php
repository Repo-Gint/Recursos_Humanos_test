
@extends('layouts.app')
@section('title', 'Vouchers')
@section('Pag', 'Vouchers')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vouchers Registrados</h3>
                @can('Vouchers.create')
                <a href="{{ route('Voucher.create') }}">
                    <button class="btn btn-success" style="float: right; margin-right: 10px;"><i class="fa fa-plus"></i> Añadir Vouchers
                    </button>
                </a>
                @endcan
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="tb_voucher" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vouchers</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Voucher</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php 
                                $i = 0
                            @endphp
                            @foreach($vouchers as $voucher)
                            @php
                                $i++
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $voucher->Voucher }}</td>
                                <td style="text-align: center;">
                                    @can('Voucher.edit')
                                    <a href="{{ route('Voucher.edit', $voucher->Slug) }}">
                                        <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                    </a>
                                    @endcan
                                    @can('Voucher.destroy')
                                   <a href="{{ route('Voucher.destroy', $voucher->id) }}">
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
        $('#tb_voucher').DataTable();
    });
 </script>
 @endsection