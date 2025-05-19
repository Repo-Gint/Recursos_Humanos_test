@extends('layouts.app')

@section('title', 'Puestos')
@section('Pag', 'Puestos')

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
                            @can('Puesto.create')
                            <a href="{{ route('Puesto.create') }}">
                                <button class="btn btn-success" style="float: right; margin-right: 10px;">
                                    <i class="fa fa-plus"></i>Añadir Puesto
                                </button>
                            </a>
                            @endcan
                        </div>
                    </div>
                    
                    <div class="table-responsive"><br>
                        <table class="table table-bordered table-sm tb_puestos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Puesto</th>
                                    <th>Position</th>
                                    <th>Departamento</th>
                                    <th>Nivel Jerarquico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Puesto</th>
                                    <th>Position</th>
                                    <th>Departamento</th>
                                    <th>Nivel Jerarquico</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $i = 0
                                @endphp
                                @foreach($puestos as $puesto)
                                @php
                                    $i++
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $puesto->Code }}</td>
                                    <td>{{ $puesto->Position_ES }}</td>
                                    <td>{{ $puesto->Position_EN }}</td>
                                    <td>{{ $puesto->Departamento->Departament_ES }}</td>
                                    <td>{{ $puesto->Jerarquia->Name_ES }}</td>
                                    <td style="text-align: center;">
                                        @can('Puesto.edit')
                                        <a href="{{ route('Puesto.edit', $puesto->Slug) }}">
                                            <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                        </a>
                                        @endcan
                                        @can('Puesto.destroy')
                                        <a href="{{ route('Puesto.disable', $puesto->id) }}">
                                            <button class="btn btn-warning badge badge-warning"  data-toggle="tooltip" data-placement="bottom" title="Inactivar registro" onclick="return confirm('¿Deseas inactivar el puesto? Al inactivar el puesto, el registro permanecera, sin embargo, no se podra utilizar.')"><i class="fa fa-arrow-circle-down"></i></button>
                                        </a> 
                                        {{--  <a href="{{ route('Puesto.destroy', $puesto->Position_id) }}">
                                            <button class="btn btn-danger badge badge-danger" onclick="return confirm('¿Seguro de eliminar el registro?')"><i class="fa fa-trash-o"></i></button>
                                        </a>--}}
                                        @endcan
                                    </td>  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="inactivos">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm tb_puestos"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Puesto</th>
                                    <th>Position</th>
                                    <th>Departamento</th>
                                    <th>Nivel Jerarquico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Puesto</th>
                                    <th>Position</th>
                                    <th>Departamento</th>
                                    <th>Nivel Jerarquico</th>
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
                                    <td>{{ $inactivo->Code }}</td>
                                    <td>{{ $inactivo->Position_ES }}</td>
                                    <td>{{ $inactivo->Position_EN }}</td>
                                    <td>{{ $inactivo->Departamento->Departament_ES }}</td>
                                    <td>{{ $inactivo->Jerarquia->Name_ES }}</td>
                                    <td style="text-align: center;">
                                        @can('Puesto.edit')
                                        <a href="{{ route('Puesto.edit', $inactivo->Slug) }}">
                                            <button class="btn btn-primary badge badge-primary" ><i class="fa fa-edit"></i></button>
                                        </a>
                                        @endcan
                                        @can('Puesto.destroy')
                                         <button class="btn btn-warning badge badge-warning"   onclick="modal_activar({{ $inactivo->id }})" data-toggle="modal" data-target="#modal-activar-puesto"><i class="fa fa-arrow-circle-up"></i></button>

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
<div class="modal modal-warning fade" id="modal-activar-puesto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Activar puesto</h4>
                </div>
            <div class="modal-body">
                <p></p>
                {!! Form::open(['route' => 'Puesto.enable', 'method' => 'POST']) !!}
                    ¿Esta seguro de habilitar el puesto? De ser asi, debe de seleccionar el departamento y puesto superior.
                    <br>
                    {!!  Form::hidden('id_puesto', null, ['class' => 'form-control', 'id'=>'id_puesto']) !!}
                    {!!  Form::label('Departamento', '* Departamento: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Departament_id', $departamentos, null, ['class' => 'form-control Departamento', 'placeholder' => 'Selecciona un departamento', 'value' => old('Departament_id')]) !!}
                    {!!  Form::label('Superior', 'Puesto Superior: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Parent_id', [], null, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona al jefe inmediato', 'value' => old('Parent_id')]) !!}
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
        $(".Departamento").change(function(event){
            $.get("../Puesto/"+event.target.value+"/obtener_puestos_superiores", function(response,departamento){
                console.log(departamento);
                $('.Parent').empty();
                for(i=0; i<response.length; i++){
                    $('.Parent').append('<option value="'+response[i].id+'">'+response[i].Code+' - '+response[i].Position_ES+'</option>');
                }
            });
        });
        $('.tb_puestos').DataTable({
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
        $("#id_puesto").val(id);
    }
 </script>
 @endsection