<html>
<head>
    <title>RRHH | Login </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body class="fondo">
    <div class="row" style="padding: 5em;">
        <div class="col-lg-4 col-md-3 col-sm-2 col-xs-2"></div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-8">
            {!! Form::open(['route' => 'Login.login', 'method' => 'POST']) !!} 
            <div class="card">
              <div class="card-header" style="text-align: center;">
                <h3>Login</h3>
                @if(session()->has('flash'))
                  <div class="alert alert-danger">{{ session('flash') }}</div>
                @endif  
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!!  Form::label('Usuario', 'Usuario: ') !!}
                    {!!  Form::text('name', old('name'), ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    {!! $errors->first('name', '<span>:message</span>') !!}
                  </div>
                  <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!!  Form::label('Contraseña', 'Contraseña: ') !!}
                    {!!  Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    {!! $errors->first('password', '<span >:message</span>') !!}
                  </div>
                  <br>
                  {!!  Form::submit('Entrar', ['class' => 'boton btn-azul btn-block']); !!}
                  <footer class="footer" style="text-align: center;">
                    Sistema de Recursos Humanos <br> 
                    <cite title="Source Title">
                      <img src="{{ asset('images/logo.png') }}" style="width: 30%;"><br>
                      @Grupo_Interconsult
                  </cite>
                   </footer>
                </blockquote>
              </div>
            </div>  
            {!! Form::close() !!}      
        </div>
        <div class="col-lg-4 col-md-3 col-sm-2 col-xs-2"></div>
    </div>
    
</body>
</html>