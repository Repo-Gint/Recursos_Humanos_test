<div class="modal modal-warning fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Baja del empleado</h4>
                </div>
            <div class="modal-body">
                <p>Esta acción da de baja al empleado, sus datos permanecerán, sin embargo, no estará habilitado para ciertas acciones y/o consultas.</p>
                {!! Form::open(['route' => array('Empleado.baja_de_empleado', $empleado->id), 'method' => 'PUT']) !!}
                    {!!  Form::label('Fin', '*Fecha de baja: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::date('Ending_date', null, ['class' => 'form-control']) !!}
                    <br>
                    {!!  Form::label('Baja', '*Razón de Baja: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Output_id', $bajas, null, ['class' => 'form-control', 'placeholder' => 'Seleccione la razón de la baja', 'id' => 'Tipo']) !!}   
                          <br>
                    {!!  Form::label('Baja', 'Descripción de baja: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::textarea('Output_Description', null, ['class' => 'form-control']) !!}
            </div>
            <div class="modal-footer">
                {!!  Form::submit('Guardar Cambios', ['class' => 'btn btn-outline']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>