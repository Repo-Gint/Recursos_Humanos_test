@extends('layouts.app')

@section('title', 'Roles')
@section('Pag', 'Roles / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Rol</h3>
            </div>
            {!! Form::open(['route' => 'Rol.store', 'method' => 'POST' ]) !!}
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Rol', 'Rol: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    {!!  Form::label('Descripcion', 'Descripción: ', ['class' => 'col-lg-2 col-xs-3 col-form-label']) !!}
                     <div class="col-lg-4">
                        {!!  Form::text('description', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <center>
                        <h5>Permiso Especial</h3>
                        <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
                        <label>{{ Form::radio('special', 'personalizado') }} Personalizado</label>
                        <label>{{ Form::radio('special', 'no-access') }} Ningún Acceso</label>
                        </center>
                    </div>
                </div>
                <div id="permisos" style="display: none;">
                    <div class="row">
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
                                            {{ Form::checkbox('permission[]', $permission->id, null) }}
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
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Rol.index') }}" role="button">Cancelar</a>
                        </div>
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
$("input[name=special]").click(function () {  
    if($('input:radio[name=special]:checked').val() == 'personalizado'){
        $("#permisos").show();
    }else{
        $("#permisos").hide();
    }
});
</script>
@endsection

                {{--  <div class="form-group row">
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
                                @foreach($grupos as $grupo)
                                    @foreach($permissions as $permission)
                                        @if($permission->group == $grupo->group)
                                            <tr>
                                                <td>{{ Form::checkbox('permission[]', $permission->id, null) }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>{{ $permission->description ?: 'Sin descripción'}}</td>  
                                            </tr>
                                        @endif    
                                    @endforeach
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>--}}