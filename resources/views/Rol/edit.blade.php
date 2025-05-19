@extends('layouts.app')

@section('title', 'Roles')
@section('Pag', 'Roles / Editar')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edición de Registro</h3>
            </div>
		    {!! Form::model($role,  ['route' => ['Rol.update', $role->id], 'method' => 'PUT']) !!}
		        <div class="box-body">
				    <div class="form-group row">
				        <div class="col-lg-3"></div>
				        {!!  Form::label('Rol', 'Rol: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
				         <div class="col-lg-4">
				            {!!  Form::text('name', null, ['class' => 'form-control']) !!}
				        </div>
				    </div>
				    <div class="form-group row">
				        <div class="col-lg-3"></div>
				        {!!  Form::label('Descripcion', 'Descripción: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
				         <div class="col-lg-4">
				            {!!  Form::text('description', null, ['class' => 'form-control']) !!}
				        </div>
				    </div>
				    <div class="form-group row">
				        <div class="col-lg-3"></div>
				        <div class="col-lg-6">
				            <center>
				            <h5>Permiso Especial</h3>
				            <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
				            @if($role->special == NULL)
				            <label>{{ Form::radio('special', 'personalizado', true) }} Personalizado</label>
				            @else
				            <label>{{ Form::radio('special', 'personalizado') }} Personalizado</label>
				            @endif
				            <label>{{ Form::radio('special', 'no-access') }} Ningún Acceso</label>
				            </center>
				        </div>
				    </div>
				    <div id="permisos" style="display: none;">
                    <div class="row">
                    	 @php
	                    $p = $role->permissions;
	                    $ban = 0;
	                    @endphp
                        @foreach($grupos as $grupo)
                            <div class="col-md-4">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ $grupo->group }}</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                    @foreach($permissions as $permission)
                                        @if($permission->group == $grupo->group)
	                                        @foreach($p as $pe)
					                            @if($pe->id == $permission->id)
					                                @php
					                                    $ban = 1; 
					                                @endphp
					                            @endif
					                        @endforeach
					                        @if($ban==1)
					                            {{ Form::checkbox('permission[]', $permission->id, true) }}
					                            @php
					                                $ban = 0;
					                            @endphp         
					                            @else
					                                {{ Form::checkbox('permission[]', $permission->id, null) }}
					                                @php
					                                    $ban = 0;
					                                @endphp
					                            @endif
                                            <strong>{{ $permission->name }}</strong>
                                            ({{ $permission->description ?: 'Sin descripción'}})<br>
                                        @endif    
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

				    <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Editar', ['class' => 'btn btn-primary btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Rol.index') }}" role="button">Cancelar</a>
                        </div>
                    </div>   
                </div>
				</div>
		    {!! Form::close() !!}
        </div>
    </div> 
</div>  
@endsection
@section('javascript')

<script type="text/javascript">
	if($('input:radio[name=special]:checked').val() == 'personalizado'){
        $("#permisos").show();
    }else{
        $("#permisos").hide();
    }
	$("input[name=special]").click(function () {  
	    if($('input:radio[name=special]:checked').val() == 'personalizado'){
	        $("#permisos").show();
	    }else{
	        $("#permisos").hide();
	    }
	});
</script>
@endsection
                {{--  
				    <div class="form-group row">
				        <div class="col-lg-3"></div>
				        <div class="col-lg-6">
				            <div class="table-responsive">
				              <table class="table" style="font-size: 12px;">
				                <thead>
				                    <tr>
				                        <th></th>
				                        <th>Permisos</th>
				                        <th>Descripción</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @php
				                    $p = $role->permissions;
				                    $ban = 0;
				                    @endphp
				                    @foreach($permissions as $permission)
				                    <tr>
				                        <td>
				                        @foreach($p as $pe)
				                            @if($pe->id == $permission->id)
				                                @php
				                                    $ban = 1; 
				                                @endphp
				                            @endif
				                        @endforeach
				                        @if($ban==1)
				                            {{ Form::checkbox('permission[]', $permission->id, true) }}
				                            @php
				                                $ban = 0;
				                            @endphp         
				                            @else
				                                {{ Form::checkbox('permission[]', $permission->id, null) }}
				                                @php
				                                    $ban = 0;
				                                @endphp
				                            @endif
				                        </td>
				                        <td>{{ $permission->name }}</td>
				                        <td>{{ $permission->description ?: 'Sin descripción'}}</td>  
				                    </tr>
				                    @endforeach
				                </tbody>
				              </table>
				            </div>
				        </div>
				    </div>--}}