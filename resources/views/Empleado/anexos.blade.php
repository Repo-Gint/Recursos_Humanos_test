{!! Form::open(['route' => array('Empleado.anexos', $empleado->Slug), 'method' => 'POST', 'files' => true ]) !!}

    <div class="form-group row">
        <div class="col-lg-3"></div>
        {!!  Form::label('Nombre', 'Nombre del archivo: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
         <div class="col-lg-4">
            {!!  Form::text('Name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'true']) !!}
        </div>
    </div>
    <center>{!!  Form::File('Archive', ['accept' => '.pdf, .docx, .xlsx', 'required' => 'true']) !!}<br></center>
    <div style="text-align: center;">
        
        {!!  Form::submit('Subir', ['class' => 'btn btn-success']); !!}
    </div>
 {!! Form::close() !!}
 @php
 $i = 1;
 @endphp
 <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
              <th>#</th>
              <th>Archivo</th>
            </tr>
        </thead>
        <tbody>          
            @foreach($empleado->Anexos as $anexo)
              <tr>
                <td>{{ $i++ }}</td>
                <td><i class="fa fa-file-o"></i> {{ $anexo->Name }}</td>
                <td>
                    <a href="{{ route('Empleado.eliminar_anexos', [$anexo->id, $empleado->Slug]) }}">
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar el archivo?')"><i class="fa fa-trash-o"></i></button>
                    </a> 
                </td>
                <td>
                    <a href="{{ route('descargar_anexo', $anexo->Name) }}">
                        <button class="btn btn-default" ><i class="fa fa-download"></i></button>
                    </a> 
                </td>
              </tr>

            @endforeach
        </tbody>
    </table>
</div>