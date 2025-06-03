@extends('layouts.app')

@section('title', 'Reportes')
@section('Pag', 'Listado - Reportes')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reportes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;">Reporte</th>
                        <th colspan="2" style="text-align: center;">Datos</th>
                        <th style="text-align: center;">Formato</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td style="vertical-align: middle; text-align: center;">
                            Listado de empleados
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {!! Form::open(['route' => array('Reporte.listado_empleados'), 'method' => 'POST']) !!}
                            {!!  Form::select('Departaments[]', $departamentos, null, ['class' => 'form-control  select-chose','multiple', 'placeholder' => 'Selecciona un departamento']) !!}
                        
                        </td>
                        <td>
                            <label>
                                {{ Form::radio('campos', 'Datos', null) }}
                                {{ 'Datos generales'}}
                            </label><br>
                            <label>
                                {{ Form::radio('campos', 'Bancos', null) }}
                                {{ 'Datos bancarios'}}
                            </label><br>
                            <label>
                                {{ Form::radio('campos', 'Contac_Personal', null) }}
                                {{ 'Datos de contacto (personales)'}}
                            </label><br>
                            <label>
                                {{ Form::radio('campos', 'Contac_Empresa', null) }}
                                {{ 'Datos de contacto (empresariales)'}}
                            </label><br>
                            
                        </td>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('formato', 'PDF', null) }}
                                <i class="fa fa-file-pdf-o" style="color: red;"></i>
                                {{ 'Pdf'}}
                            </label><br>
                            <label>
                                {{ Form::radio('formato', 'XLS', null) }}
                                <i class="fa fa-file-excel-o" style="color: green;"></i>
                                {{ 'Excel'}}
                            </label>
                            
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {!!  Form::submit('Exportar', ['class' => 'btn btn-default']); !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle; text-align: center;">
                            Catálogo de Puestos
                        </td>
                        <td  colspan="2" style="vertical-align: middle; text-align: center;">
                            {!! Form::open(['route' => array('Reporte.catalogo_puestos'), 'method' => 'POST']) !!}
                            {!!  Form::select('Departaments[]', $departamentos, null, ['class' => 'form-control select-chose','multiple', 'placeholder' => 'Selecciona un departamento']) !!}
                        
                        </td>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('formato', 'PDF', null) }}
                                <i class="fa fa-file-pdf-o" style="color: red;"></i>
                                {{ 'Pdf'}}
                            </label><br>
                            <label>
                                {{ Form::radio('formato', 'XLS', null) }}
                                <i class="fa fa-file-excel-o" style="color: green;"></i>
                                {{ 'Excel'}}
                            </label>
                            
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {!!  Form::submit('Exportar', ['class' => 'btn btn-default']); !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>
                    <tr >
                        <th colspan="5">Vacaciones</th>
                    </tr>
                    {!! Form::open(['route' => array('Reporte.vacaciones'), 'method' => 'POST']) !!}
                    <tr>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('tipo_reporte', 'Resumen', null, ['class'=>'tipo_reporte' ]) }}
                                {{ 'Resumen de Vacaciones'}}
                            </label><br>
                            <label>
                                {{ Form::radio('tipo_reporte', 'Concentrado', null, ['class'=>'tipo_reporte' ]) }}
                                {{ 'Concentrado de Vacaciones'}}
                            </label><br>
                             <label>
                                {{ Form::radio('tipo_reporte', 'Por_fechas', null, ['class'=>'tipo_reporte' ]) }}
                                {{ 'Por fechas'}}
                            </label>
                        </td>
                        <td  colspan="2" style="vertical-align: middle; text-align: center;">
                            <div id="fechas" style="display: none;">
                            <div class="row" >
                                <div class="col-lg-6">
                                    <label>Fecha Inicio</label>
                                    {!! Form::date('date1', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6">
                                    <label>Fecha Fin</label>
                                    {!! Form::date('date2', null, ['class' => 'form-control']) !!}
                                </div>
                            </div><br>
                            </div>
                            
                            {!!  Form::select('Departaments[]', $departamentos, null, ['class' => 'form-control select-chose','multiple', 'placeholder' => 'Selecciona un departamento']) !!}
                        
                        </td>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('formato', 'PDF', null) }}
                                <i class="fa fa-file-pdf-o" style="color: red;"></i>
                                {{ 'Pdf'}}
                            </label><br>
                            <label>
                                {{ Form::radio('formato', 'XLS', null) }}
                                <i class="fa fa-file-excel-o" style="color: green;"></i>
                                {{ 'Excel'}}
                            </label>
                            
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {!!  Form::submit('Exportar', ['class' => 'btn btn-default']); !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>
                    

                    <tr >
                        <th colspan="5">Rotacion de personal</th>
                    </tr>
                    {!! Form::open(['route' => array('Reporte.rotacion'), 'method' => 'POST']) !!}
                    <tr>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('rep_rotacion', 'anual', null, ['class'=>'rep_rotacion' ]) }}
                                {{ 'Concentrado'}}
                            </label><br>
                             <label>
                                {{ Form::radio('rep_rotacion', 'altas', null, ['class'=>'rep_rotacion' ]) }}
                                {{ 'Altas'}}
                            </label><br>
                            <label>
                                {{ Form::radio('rep_rotacion', 'bajas', null, ['class'=>'rep_rotacion' ]) }}
                                {{ 'Bajas'}}
                            </label>
                        </td>
                        <td  colspan="2" style="vertical-align: middle; text-align: center;">
                            <div id="calendario" style="display: none;">
                            <div class="row" >
                                <div class="col-lg-6">
                                    <label>Fecha Inicio</label>
                                    {!! Form::date('date1', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-lg-6">
                                    <label>Fecha Fin</label>
                                    {!! Form::date('date2', null, ['class' => 'form-control']) !!}
                                </div>
                            </div><br>
                            </div>
                            
                            
                        
                            
                           
                            {!!  Form::select('Departaments[]', $departamentos, null, ['class' => 'form-control select-chose','multiple', 'placeholder' => 'Selecciona un departamento']) !!}
                        
                        </td>
                        <td style="vertical-align: middle;">
                            <label>
                                {{ Form::radio('formato', 'PDF', null) }}
                                <i class="fa fa-file-pdf-o" style="color: red;"></i>
                                {{ 'Pdf'}}
                            </label><br>
                            <label>
                                {{ Form::radio('formato', 'XLS', null) }}
                                <i class="fa fa-file-excel-o" style="color: green;"></i>
                                {{ 'Excel'}}
                            </label>
                            
                        </td>
                        <td style="vertical-align: middle; text-align: center;">
                            {!!  Form::submit('Exportar', ['class' => 'btn btn-default']); !!}
                            {!! Form::close() !!}    
                        </td>
                    </tr>


                </tbody>
                
                    
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection
@section('javascript')
{!! Html::script('plugins/jquery/jquery-3.3.1.js') !!}
{!! Html::script('plugins/chosen/chosen.jquery.min.js') !!}
<script type="text/javascript">
$(document).ready(function(){
 $(".tipo_reporte").change(function () { //Emergencia
    if($('input:radio[name=tipo_reporte]:checked').val() == "Resumen" || $('input:radio[name=tipo_reporte]:checked').val() == "Concentrado"){
        $("#fechas").hide();
    }

    if($('input:radio[name=tipo_reporte]:checked').val() == "Por_fechas"){
        $("#fechas").show();
    }
});

 });

 $(document).ready(function(){
 $(".rep_rotacion").change(function () { //Rotacion de personal
    if($('input:radio[name=rep_rotacion]:checked').val() == "anual" ){
        $("#calendario").hide();
    }
        if($('input:radio[name=rep_rotacion]:checked').val() == "altas"){
        $("#calendario").show();
    }
});

 });
 $(document).ready(function(){
 $(".rep_rotacion").change(function () { //Rotacion de personal
    if($('input:radio[name=rep_rotacion]:checked').val() == "anual" ){
        $("#calendario").hide();
    }
        if($('input:radio[name=rep_rotacion]:checked').val() == "bajas"){
        $("#calendario").show();
    }
});

 });


$("#select-chosen").chosen({
    no_results_text: "Oops, nothing found!",
    width: "100%",
    placeholder_text_single: 'Sin opciones.'
}); 

</script>
@endsection