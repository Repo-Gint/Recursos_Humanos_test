@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Departamentos ')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Activos</a></li>
              <li><a href="#inactivos" data-toggle="tab">Inactivos</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activos">
                    <div class="row">
                        <div class="col-lg-12">
                            @can('Departamento.create')
                                <a href="{{ route('Departamento.create') }}">
                                    <button class="btn btn-success" style="float: right;">
                                        <i class="fa fa-plus"></i> Añadir Departamento
                                    </button>
                                </a>
                            @endcan
                        </div>
                    </div>
                    
                    <div class="table-responsive"><br>
                        <table class="table table-bordered table-sm tb_departamentos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Departament</th>
                                    <th>Nomenclatura</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Departament</th>
                                    <th>Nomenclatura</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $i = 0
                                @endphp
                                @foreach($departamentos as $departamento)
                                @php
                                    $i++
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $departamento->Departament_ES }}</td>
                                    <td>{{ $departamento->Departament_EN }}</td>
                                    <td>{{ $departamento->Acronym }}</td>
                                    <td style="text-align: center;">
                                        @can('Departamento.edit')
                                        <a href="{{ route('Departamento.edit', $departamento->Slug) }}">
                                            <button class="btn btn-primary badge badge-primary" data-toggle="tooltip" data-placement="bottom" title="Editar registro"><i class="fa fa-edit"></i></button>
                                        </a>
                                        @endcan
                                        @can('Departamento.show')
                                        <a href="{{ route('Departamento.show', $departamento->Slug) }}">
                                            <button class="btn btn-default badge badge-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro"><i class="fa fa-eye"></i></button>
                                        </a>
                                        @endcan
                                        @can('Departamento.destroy')
                                        <a href="{{ route('Departamento.disable', $departamento->id) }}">
                                            <button class="btn btn-warning badge badge-warning"  data-toggle="tooltip" data-placement="bottom" title="Inactivar registro" onclick="return confirm('¿Deseas inactivar el departamento? Al inactivar el departamento, el registro permanecera, sin embargo, no se podra utilizar.')"><i class="fa fa-arrow-circle-down"></i></button>
                                        </a> 
                                        @endcan
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="inactivos">
                    <div class="table-responsive"><br>
                        <table class="table table-bordered table-sm tb_departamentos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Departament</th>
                                    <th>Nomenclatura</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Departament</th>
                                    <th>Nomenclatura</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $i = 0
                                @endphp
                                @foreach($inactivos as $inactivo)
                                @php
                                    $i++
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $inactivo->Departament_ES }}</td>
                                    <td>{{ $inactivo->Departament_EN }}</td>
                                    <td>{{ $inactivo->Acronym }}</td>
                                    <td style="text-align: center;">
                                        @can('Departamento.destroy')
                                            <button class="btn btn-warning badge badge-warning"   onclick="modal_activar({{ $inactivo->id }})" data-toggle="modal" data-target="#modal-activar-departamento"><i class="fa fa-arrow-circle-up"></i></button>
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
</div>
<div class="modal modal-warning fade" id="modal-activar-departamento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Baja del empleado</h4>
                </div>
            <div class="modal-body">
                <p></p>
                {!! Form::open(['route' => 'Departamento.enable', 'method' => 'POST']) !!}
                    ¿Esta seguro de habilitar el departamento? De ser asi, debe de seleccionar al departamento superior.
                    <br>
                    {!!  Form::hidden('id_departamento', null, ['class' => 'form-control', 'id'=>'id_departamento']) !!}
                    {!!  Form::label('departamento', 'Departamento superior: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Parent_id', $list, null, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'id' => 'Tipo', 'required']) !!}   
            </div>
            <div class="modal-footer">
                {!!  Form::submit('Guardar Cambios', ['class' => 'btn btn-outline']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
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
        $('.tb_departamentos').DataTable({
            "language": {
              "lengthMenu": "Mostrar _MENU_ por página",
              "zeroRecords": "no se encontrarón datos - lo siento",
              "info": "Página _PAGE_ de _PAGES_",
              "infoEmpty": "No hay registros disponibles",
              "infoFiltered": "(filtered from _MAX_ total records)",
              "search": "Buscar",
              "oPaginate": {
                    "sFirst":    "<<",
                    "sLast":     ">>",
                    "sNext":     ">",
                    "sPrevious": "<"
                },
            }
        });

    });
    function modal_activar(id){
        $("#id_departamento").val(id);
    }
 </script>
 @endsection