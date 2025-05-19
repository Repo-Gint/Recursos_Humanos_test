<div class="wrapper">
  <header class="main-header">
    <a href="{{ url('/Panel') }}" class="logo">
      <span class="logo-mini"><b>RRHH</b></span>
      <span class="logo-lg"><b>GIM - </b>RRHH</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          {{--
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('images/Fotografias/'.auth()->user()->Empleado->Photo) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('images/Fotografias/'.auth()->user()->Empleado->Photo) }}" class="img-circle" alt="User Image">
                <p>
                  {{ auth()->user()->name }}
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  {!! Form::open(['route' => 'Login.logout', 'method' => 'POST']) !!}
                    {!!  Form::submit('Cerrar Sesión', ['class' => 'btn btn-default btn-flat']); !!}
                  {!! Form::close() !!}
                </div>
              </li> 
            </ul>
          </li>--}}
        </ul>
      </div>
    </nav>
  </header>

