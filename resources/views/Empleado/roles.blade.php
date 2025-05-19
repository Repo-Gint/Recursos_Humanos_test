{!! Form::open(['route' => ['Empleado.roles', $empleado->id], 'method' => 'PUT']) !!}
	<h5 style="text-align: center;">Contacto Administrativo</h5>
	<div class="form-group row">
        <div class="col-lg-4">
            {!!  Form::label('Email', 'Email coorporativo: ', ['class' => 'col-form-label']) !!}
            {!!  Form::email('Business_mail', $contacto->Business_mail, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'Email_corp']) !!}
        </div>
        <div class="col-lg-4">
            {!!  Form::label('Celular', 'Celular coorporativo: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('Business_phone', $contacto->Business_phone, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div> 
        <div class="col-lg-4">
            {!!  Form::label('Extension', 'Extensión: ', ['class' => 'col-form-label']) !!}
            {!!  Form::number('Extension', $contacto->Extension, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>
    </div>
	<hr>
    <h5 style="text-align: center;">Datos de Usuario</h5>
    <div class="form-group row">
        <div class="col-lg-6">
            {!!  Form::label('Usuario', 'Usuario: ', ['class' => 'col-form-label']) !!}
            {!!  Form::text('name', $usuario->name, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>
        <div class="col-lg-6">
            {!!  Form::label('Contraseña', 'Contraseña: ', ['class' => 'col-form-label']) !!}
            {!!  Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div> 
    </div>
    <hr>
    <h5 style="text-align: center;">Rol de Usuario</h5>
	<div class="list-unstyled">
	    @php
	    	$usuario_roles = $usuario->roles;
	    	$ban = 0;
	    @endphp
	   	@foreach($roles as $rol)
        <li>
        	<label>
	            @foreach($usuario_roles as $usuario_rol)
	                @if($usuario_rol->id == $rol->id)
	                    @php
	                        $ban = 1; 
	                    @endphp
	                @endif
	            @endforeach
	            @if($ban==1)
	                {{ Form::radio('roles[]', $rol->id, true) }}
	                @php
	                    $ban = 0;
	                @endphp         
	           	@else
	                {{ Form::radio('roles[]', $rol->id, null) }}
	                @php
	                    $ban = 0;
	                @endphp
	           	@endif
	           	{{ $rol->name }}
	            <em>({{ $rol->description ?: 'Sin descripción' }})</em>
        	</label>
        </li>
	    @endforeach
	</div>
	<div class="box-footer" style="text-align: center;">
		
				{!!  Form::submit('Editar', ['class' => 'btn btn-success btn-sm btn-block']); !!}
	
		
	</div>
{!! Form::close() !!}