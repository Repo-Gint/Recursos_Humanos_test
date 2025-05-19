@php
$i = 0;
$periodos = Periodos_historial($empleado);
@endphp
<br>
<div class="table-responsive">

    <table class="table table-bordered table-sm" id="tb_vacaciones" width="100%" cellspacing="0">
        <thead>
        	<tr>
                <th>#</th>
                <th>Periodo</th>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Dias Solicitados</th>
                <th>Tipo de Vacaciones</th>
        		<th>Eliminar Registro</th>
        	</tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Periodo</th>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Dias Solicitados</th>
                <th>Tipo de Vacaciones</th>
                <th>Eliminar Registro</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($coleccion as $vacaciones)
                @php
				$tip_advanced=$vacaciones->Advanced;
					if($tip_advanced<>3){
                    $i++;
                @endphp
			
                <tr>
                    <td style="">{{ $i }}</td>
                    <td style="">{{ $vacaciones->Period }}</td>
                    <td style="">{{ Formato($vacaciones->Start_date) }}</td>
                    <td style="">{{ Formato($vacaciones->Ending_date) }}</td>
                    <td style="">{{ $vacaciones->Days }}</td>
					
                    <td style="">{{ Tipo_Vacacion($vacaciones->Paid, $vacaciones->Advanced)}}</td>
                    <td style="text-align: center; ">
                        @can('Vacaciones.destroy')
                        <a href="{{ route('Vacaciones.destroy', [$vacaciones->id, $empleado->Slug]) }}">
                            <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar el registro?')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </a>
                        @endcan
                    </td>       
                </tr>
				@php
					}
				@endphp
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
    </div>
    <div class="col-lg-6">
        <a href="{{ route('vacaciones_usuario', $empleado->Slug) }}">
            <button class="btn btn-default" style="float: right;">
                <i class="fa fa-file-pdf-o"></i> Descargar Reporte
            </button>
        </a>
    </div>
</div>