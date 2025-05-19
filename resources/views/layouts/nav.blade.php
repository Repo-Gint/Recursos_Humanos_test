<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/Fotografias/'.auth()->user()->Empleado->Photo) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ nombre(auth()->user()->Empleado, 'Mostrar') }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                {!! Form::open(['route' => 'Login.logout', 'method' => 'POST']) !!}
                    {!!  Form::submit('Cerrar Sesión', ['style' => 'background-color: transparent; border: none; padding: 0.5em;']); !!}
                {!! Form::close() !!}
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Panel de Navegación</li>
            <li class="">
                <a href="{{ url('/Panel') }}">
                    <i class="glyphicon glyphicon-th"></i> 
                    <span>Panel</span>
                </a>
            </li>
            @can('Empleado.index')
            <li class="treeview">
                <a href="{{ route('Empleado.index') }}"><i class="fa fa-odnoklassniki"></i> <span>Empleado</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('Empleado.index') }}">
                            <i class="fa fa-arrow-up"></i>Altas
                        </a>
                    </li>
                    @can('Empleado.bajas_empleados')
                    <li>
                        <a href="{{ route('Empleado.bajas_empleados') }}">
                            <i class="fa fa-arrow-down"></i>Bajas
                        </a>
                    </li>
                    @endcan
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-plus"></i> <span>Mas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                         </a>
                         <ul class="treeview-menu">
                            @can('Estado_Civil.index')
                            <li>
                                <a href="{{ route('Estado_Civil.index') }}">
                                    <i class="fa fa-circle-o"></i>Estado Civil
                                </a>
                            </li>
                            @endcan
                            @can('Familiar.index')
                            <li>
                                <a href="{{ route('Familiar.index') }}">
                                    <i class="fa fa-circle-o"></i>Parentescos
                                </a>
                            </li>
                            @endcan
                            @can('Banco.index')
                            <li>
                                <a href="{{ route('Banco.index') }}">
                                    <i class="fa fa-circle-o"></i>Bancos
                                 </a>
                            </li>
                            @endcan
                            @can('Baja.index')
                            <li>
                                <a href="{{ route('Baja.index') }}">
                                    <i class="fa fa-circle-o"></i>Tipo de Bajas
                                </a>
                            </li>
                            @endcan
                            @can('Escolaridad.index')
                            <li>
                                <a href="{{ route('Escolaridad.index') }}">
                                    <i class="fa fa-circle-o"></i>Grados de estudios
                                </a>
                            </li>
                            @endcan
                            @can('Voucher.index')
                            <li>
                                <a href="{{ route('Voucher.index') }}">
                                    <i class="fa fa-circle-o"></i>Voucher
                                </a>
                            </li>
                            @endcan
                            @can('Tipoempleado.index')
                            <li>
                                <a href="{{ route('Tipoempleado.index') }}">
                                    <i class="fa fa-circle-o"></i>Tipo de empleados
                                </a>
                            </li>
                            @endcan
                            @can('Documento.index')
                            <li>
                                <a href="{{ route('Documento.index') }}">
                                    <i class="fa fa-circle-o"></i>Documentos
                                </a>
                            </li>
                            @endcan
                            @can('Dias_Festivos.index')
                            <li>
                                <a href="{{ route('Dias_Festivos.index') }}">
                                    <i class="fa fa-circle-o"></i>Dias Festivos
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        @can('Puesto.index')
        <li>
          <a href="{{ route('Puesto.index') }}">
            <i class="fa fa-suitcase"></i> 
            <span>Puestos</span>
          </a>
        </li>
        @endcan
        @can('Departamento.index')
        <li>
          <a href="{{ route('Departamento.index') }}">
            <i class="fa fa-users"></i> 
            <span>Departamentos</span>
          </a>
       </li>
        @endcan
        @can('Jerarquia.index')
       <li class="treeview">
          <a href="{{ route('Jerarquia.index') }}">
            <i class="fa fa-odnoklassniki"></i> 
            <span>Org. Empresarial</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ route('Jerarquia.index') }}">
                <i class="fa fa-sitemap"></i>Jerarquias
              </a>
            </li>
            @can('Departamento.Organigrama_general')
            <li>
              <a href="{{ route('Departamento.Organigrama_general') }}">
                <i class="fa fa-sitemap"></i>Organigrama
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        @can('Empresa.index')
        <li>
          <a href="{{ route('Empresa.index') }}">
            <i class="fa fa-industry"></i> 
            <span>Empresas</span>
          </a>
        </li>
        @endcan
        @can('Pais.index')
        <li>
          <a href="{{ route('Pais.index') }}">
            <i class="fa  fa-globe"></i> 
            <span>Paises</span>
          </a>
        </li>
        @endcan
        @can('Reporte.index')
        <li>
          <a href="{{ route('Reporte.index') }}">
            <i class="glyphicon glyphicon-list-alt"></i> 
            <span>Reportes</span>
          </a>
        </li>
        @endcan
        @can('Rol.index')
        <li>
          <a href="{{ route('Rol.index') }}">
            <i class="fa fa-tags"></i> 
            <span>Roles</span>
          </a>
        </li>
        @endcan
      </ul>
  </section>
</aside>