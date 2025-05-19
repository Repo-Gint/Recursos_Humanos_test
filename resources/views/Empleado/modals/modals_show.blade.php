
<!--Modal para contratar empleado de sistema dual-->
<div class="modal modal-success fade" id="modal-contrato-dual">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Contratar Dual/Practicante</h4>
      		</div>
      		<div class="modal-body">
        		<p>Favor de llenar los siguientes campos</p>
        		{!! Form::open(['route' => array('Empleado.contratar', $empleado->id), 'method' => 'PUT']) !!}
            		{!!  Form::label('Tipo_empleado', '*Tipo de empleado: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Typeemployee_id', $tipos, null, ['class' => 'form-control Tipo_Empleado', 'placeholder' => 'Selecciona un tipo de empleado', 'required']) !!}   
                    {!!  Form::label('Codigo', '*Código: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::number('Code', null, ['class' => 'form-control Codigo', 'autocomplete' => 'off', 'required']) !!}
                    {!!  Form::label('Contratación', '*Fecha de Contratación: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::date('High_date', null, ['class' => 'form-control', 'required']) !!}
                    {!!  Form::label('Contrato', '*Tipo de contrato: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Typecontract_id', $contratos, null, ['class' => 'form-control Tipo_contrato', 'placeholder' => 'Selecciona un tipo de contrato', 'required']) !!}
                    <div class="Duracion" style="display: none;">
                        {!!  Form::label('Duracion', 'Duración del contrato: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Duration', ['30' => '30', '90' => '90', '180' => '180'], null, ['class' => 'form-control Duracion_Dias', 'placeholder' => 'Selecciona un periodo de duración', 'required'=>'true']) !!}
                    </div>
                    {!!  Form::label('Departamento', '*Departamento: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Departament_id', $departamentos, null, ['class' => 'form-control Departament', 'placeholder' => 'Selecciona un departamento', 'required']) !!}
                    {!!  Form::label('Puesto', '*Puesto: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Position_id', [], null, ['class' => 'form-control Position', 'placeholder' => 'Selecciona un puesto', 'required']) !!}
                    {!!  Form::label('Reporta', '*Reporta a: ', ['class' => 'col-form-label']) !!}
                    {!!  Form::select('Parent_id', [], null, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona a su superior', 'required']) !!}             
      		</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
	        	{!!  Form::submit('Contratar Dual', ['class' => 'btn btn-outline']); !!}
	      	</div>
	      	{!! Form::close() !!}
    	</div>
  	</div>
</div>
<!--Modal para contratar empleado de sistema dual FIN-->




<!--Modal para contratar empleado de contrato tipo prueba y/o capacitación-->
<div class="modal modal-primary fade" id="modal-contrato-empleado">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Contratar Empleado</h4>
      		</div>
      		<div class="modal-body">
        		<p>Al contratar al empleado, el tipo de contrato pasara a <strong>Indefinido</strong></p>
        		{!! Form::open(['route' => array('Empleado.contratar', $empleado->id), 'method' => 'PUT']) !!}     
      		</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
	        	{!!  Form::submit('Contratar Empleado', ['class' => 'btn btn-outline']); !!}
	      	</div>
	      	{!! Form::close() !!}
    	</div>
  	</div>
</div>
<!--Modal para contratar empleado de contrato tipo prueba y/o capacitación FIN-->


<!--Modal para contratar empleado de contrato tipo prueba y/o capacitación-->
<div class="modal modal-primary fade" id="modal-nuevo-puesto">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Asignar Nuevo Puesto</h4>
          </div>
          <div class="modal-body">
            <p>Favor de llenar los siguientes campos</p>
            {!! Form::open(['route' => array('Empleado.asignar_nuevo_puesto', $empleado->id), 'method' => 'PUT']) !!}
              
                {!!  Form::label('Fecha', '*Fecha de asignación del puesto: ', ['class' => 'col-form-label']) !!}
                {!!  Form::date('Start_date', null, ['class' => 'form-control', 'required']) !!}
                {!!  Form::label('Departamento', '*Departamento: ', ['class' => 'col-form-label']) !!}
                {!!  Form::select('Departament_id', $departamentos, null, ['class' => 'form-control Departament', 'placeholder' => 'Selecciona un departamento', 'required']) !!}
                {!!  Form::label('Puesto', '*Puesto: ', ['class' => 'col-form-label']) !!}
                {!!  Form::select('Position_id', [], null, ['class' => 'form-control Position', 'placeholder' => 'Selecciona un puesto', 'required']) !!}
                {!!  Form::label('Reporta', '*Reporta a: ', ['class' => 'col-form-label']) !!}
                {!!  Form::select('Parent_id', [], null, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona a su superior', 'required']) !!}             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            {!!  Form::submit('Asignar', ['class' => 'btn btn-outline']); !!}
          </div>
          {!! Form::close() !!}
      </div>
    </div>
</div>
<!--Modal para contratar empleado de contrato tipo prueba y/o capacitación FIN-->