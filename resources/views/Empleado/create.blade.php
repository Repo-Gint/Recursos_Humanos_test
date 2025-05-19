@extends('layouts.app')

@section('title', 'Empleados')
@section('Pag', 'Empleados / Añadir')
@section('content')
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Empleado</h3>
            </div>
            {!! Form::open(['route' => 'Empleado.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="box-body">
                <h4 style="text-align: center;">Datos Personales</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                               {!!  Form::label('Nombre', '*Nombre(s): ', ['class' => 'col-form-label']) !!}
                               {!!  Form::text('Names', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'Nombre']) !!}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                 {!!  Form::label('Paterno', '*Apellido Paterno: ', ['class' => 'col-form-label']) !!}
                               {!!  Form::text('Paternal', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'Apellido']) !!}
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6" >
                                {!!  Form::label('Materno', '*Apellido Materno: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Maternal', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>             
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                               {!!  Form::label('Genero', '*Género: ', ['class' => 'col-form-label']) !!}
                               {!!  Form::select('Gender', $generos, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un género']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                {!!  Form::label('Nss', '* NSS: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Nss', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Rfc', '* RFC: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Rfc', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Curp', '* CURP: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Curp', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!} 
                            </div>               
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                {!!  Form::label('Credencial', '* INE: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Credential', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                {!!  Form::label('Estudios', 'Estudios: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::select('Scholarchip_id', $estudios, null, ['class' => 'form-control', 'placeholder' => 'Grado de Estudios']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Comprobante', 'Comprobante de estudios: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::select('Voucher_id', $vouchers, null, ['class' => 'form-control', 'placeholder' => 'Comprobante']) !!}
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Civil', '*Estado civil: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::select('Marital_status_id', $estados, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un estado civil']) !!} 
                            </div>               
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                {!!  Form::label('Hijos', 'Hijos: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::number('Children', null, ['class' => 'form-control', 'placeholder' => 'Hijos', 'min' => '0', 'max' => '20']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                {!!  Form::label('Credito', 'Credito infonavit: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Infonavit', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Credito', 'Credito Fonacot: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Fonacot', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-6" >
                                {!!  Form::label('Blood', 'Tipo de Sangre: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::text('Blood', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!} 
                            </div>               
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-6">
                                {!!  Form::label('Allergy', 'Alergias: ', ['class' => 'col-form-label']) !!}
                                {!!  Form::textarea('Allergy', null, ['class' => 'form-control', 'autocomplete' => 'off', 'style' => 'height: 50px;']) !!}
                            </div>             
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('Foto', 'Fotografia: ', ['class' => 'col-form-label']) !!}<br>
                        <center>
                            <img id='img_destino' src='{{ asset('images/photo.png') }}' alt='Tu imagen' style='width: 200px; height: 260px;'>
                        </center><br>
                        <center>
                            {!!  Form::File('Photo', ['id' => 'imagen', 'accept' => '.jpeg, .jpg, .png', 'class' => 'input-file']) !!}
                            <label for="imagen"><i class="fa fa-upload"></i> Elegir Fotografía</label>
                            <p class="help-block">Resolución de fotografia 440 x 575 px</p>
                        </center>
                    </div>
                </div>
                <hr>
                <h4 style="text-align: center;">Lugar de Nacimiento</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                       {!!  Form::label('Nacimiento', '*Fecha de Nacimiento: ', ['class' => 'col-form-label']) !!}
                       {!!  Form::date('Birthdate', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Localidad', '*Localidad: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Tows', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-6">
                       {!!  Form::label('Municipio', '*Municipio: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Municipality', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">                   
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Estado', '*Estado: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('State', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Pais', '*Pais: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Country_id', $paises, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un pais']) !!}
                    </div>
                </div>
                <hr>
                <h4 style="text-align: center;">Domicilio</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                       {!!  Form::label('Dirección', '*Dirección: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Address', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Localidad', '*Localidad: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Tows_D', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Codigo', '*Código Postal: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Postcode', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                       {!!  Form::label('Municipio', '*Municipio: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Municipality_D', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Estado', '*Estado: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('State_D', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Pais', '*Pais: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Country_id_D', $paises, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un pais']) !!}
                    </div> 
                </div>
                <hr>
                <h4 style="text-align: center;">Contacto</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                       {!!  Form::label('Email', '* Email: ', ['class' => 'col-form-label']) !!}
                       {!!  Form::email('Personal_mail', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Celular', '*Celular personal: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Personal_phone', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Telefono', 'Teléfono de casa: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Landline', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>    
                </div>
                <hr>
                <h4 style="text-align: center;">En caso de emergencia llamar a</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Family', '* Conocido: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Family', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Parentesco', '* Parentesco: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Relationship_id', $parentescos, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una opción']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Emergencia', '* Teléfono de emergencia: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Emergency_phone', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>    
                </div>
                <hr>
                <h4 style="text-align: center;">Datos de Contratación</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Empresa', '*Empresa: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Company_id', $empresas, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una opción']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Tipo_empleado', '*Tipo de empleado: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Typeemployee_id', $tipos, null, ['class' => 'form-control Tipo_Empleado', 'placeholder' => 'Selecciona un tipo de empleado']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6" >
                        {!!  Form::label('Codigo', '*Código: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::number('Code', null, ['class' => 'form-control Codigo', 'autocomplete' => 'off']) !!}
                    </div>               
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Contratación', '*Fecha de Contratación: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::date('High_date', null, ['class' => 'form-control']) !!}
                    </div> 
                     <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Contrato', '*Tipo de contrato: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Typecontract_id', $contratos, null, ['class' => 'form-control Tipo_contrato', 'placeholder' => 'Selecciona un tipo de contrato']) !!}
                    </div>  
                    <div class="col-lg-4 col-md-4 col-sm-6 Duracion" style="display: none;">
                        {!!  Form::label('Duracion', 'Duración del contrato: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Duration', ['30' => '30', '90' => '90', '180' => '180'], null, ['class' => 'form-control Duracion_Dias', 'placeholder' => 'Selecciona un periodo de duración', 'required'=>'true']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Departamento', '*Departamento: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Departament_id', $departamentos, null, ['class' => 'form-control Departament', 'placeholder' => 'Selecciona un departamento']) !!}
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Puesto', '*Puesto: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Position_id', [], null, ['class' => 'form-control Position', 'placeholder' => 'Selecciona un puesto','value' => old('Position_id')  ]) !!}
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Reporta', '*Reporta a: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Parent_id', [], null, ['class' => 'form-control Parent', 'placeholder' => 'Selecciona a su superior', 'value' => old('Parent_id')]) !!}
                    </div>    
                </div>
                <hr>
                <h4 style="text-align: center;">Datos de bancos</h4>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Banco', 'Banco: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::select('Bank_id', $bancos, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un banco']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        {!!  Form::label('Cuenta', 'Número de cuenta: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Count', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6" >
                        {!!  Form::label('Clave', 'Clabe interbancaria: ', ['class' => 'col-form-label']) !!}
                        {!!  Form::text('Clabe_bank', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>               
                </div>
                <div class="box-footer" style="text-align: center;">
                    <div class="row">
                        <div class="col-md-6">
                            {!!  Form::submit('Agregar', ['class' => 'btn btn-success btn-sm btn-block']); !!} 
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-danger btn-sm btn-block" href="{{ route('Empleado.index') }}" role="button">Cancelar</a>
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
{!! Html::script('plugins/jquery/jquery-3.3.1.js') !!}
{!! Html::script('plugins/jquery/functions/Empleado/function_generals.js') !!}
@endsection