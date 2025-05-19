@extends('layouts.app')

@section('title', 'Panel')
@section('Pag', 'Inicio')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{ total_empleados() }}</h3>
          <p>Empleados Registrados</p>
        </div>
        <div class="icon" style="padding: 9px;">
          <i class="ion-person-stalker"></i>
        </div>
        @can('Empleado.index')
         {{--  <a href="{{ route('Empleado.index') }}" class="small-box-footer">Ver Más <i class="fa fa-arrow-circle-right"></i></a>  --}}
        @endcan
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ total_empleados_altas('Conteo') }}</h3>
          <p>Altas del Mes</p>
        </div>
        <div class="icon" style="padding: 9px;">
          <i class="ion-plus"></i>
        </div>
        {{--  
        @can('Empleado.index')
          <a href="{{ route('Empleado.outputs') }}" class="small-box-footer">Ver Más <i class="fa fa-arrow-circle-right"></i></a>
        @endcan--}}
      </div>
      </div>
      <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ total_empleados_bajas('Conteo') }}</h3>
              <p>Bajas del Mes</p>
            </div>
          <div class="icon" style="padding: 9px;">
              <i class="ion-minus-circled"></i>
          </div>
          {{-- @can('Empleado.index')
            <a href="{{ route('Empleado.outputs') }}" class="small-box-footer">Ver Más <i class="fa fa-arrow-circle-right"></i></a>
          @endcan--}}
        </div>
      </div>
  </div>
  <!---->
  <div class="row">
    <div class="col-lg-6">
      <!--Inicio Contrato Definido-->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Contrato definido</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="height: 200px; overflow-x: auto;">
          <ul class="products-list product-list-in-box">
            @php 
              $cnt = total_empleados_contrato('Conteo');
              $empleados =  total_empleados_contrato('Coleccion'); 
            @endphp
            @foreach($empleados as $empleado)  
              @if($empleado->Active == 1)         
              <li class="item">
                <div class="product-img">
                   <img src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" style="width: 40px; height: 50px;" >
                </div>
                <div class="product-info">
                  <a href="{{ route('Empleado.show', $empleado->Slug) }}" class="product-title">{{ nombre($empleado, 'Mostrar')}}</a>
                  @php 
                    $fecha_actual = date('Y-m-d');
                    $dias = diferencia_fechas($empleado->Ending,$fecha_actual,"days"); 
                  @endphp
                  @if($dias <= 0)
                    <span class="label label-danger pull-right"><i class="fa fa-calendar"></i> Su contrato finalizo</span>
                  @else
                    @if($dias <= 15)
                      <span class="label label-warning pull-right"><i class="fa fa-calendar"></i> {{ $dias }} para finalizar contrato</span>
                    @endif
                  @endif
                  <span class="product-description">
                    Fecha de termino de contrato: {{ formato($empleado->Ending) }}
                  </span>
                </div>
              </li>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
      <!--Fin Contrato Definido-->
      <!--Inicio genero-->   
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Genéro</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @php
            $mujeres = total_genero('Mujer', null, null);
            $hombres = total_genero('Hombre', null, null);
          @endphp
          <div id="chartdivPie" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
           <table class="table">
                <tr>
                  <th></th>
                  <th style="text-align: center;">Nómina</th>
                  <th style="text-align: center;">Sindicalizado</th>
                  <th style="text-align: center;">Dual / Practicante</th>
                </tr>
                <tr>
                  <th>Hombres</th>
                  <td style="text-align: center;">{{ total_empleados_categorias('Hombre', 'Confianza') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Hombre', 'Sindicalizado') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Hombre', 'Dual') }}</td>
                </tr>
                <tr>
                  <th>Mujeres</th>
                  <td style="text-align: center;">{{ total_empleados_categorias('Mujer', 'Confianza') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Mujer', 'Sindicalizado') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Mujer', 'Dual') }}</td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td style="text-align: center;">{{ total_empleados_categorias('Ambos', 'Confianza') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Ambos', 'Sindicalizado') }}</td>
                  <td style="text-align: center;">{{ total_empleados_categorias('Ambos', 'Dual') }}</td>
                </tr>
            </table>
        </div>
        <div class="box-footer text-center">
          <a href="{{ route('Grafica.genero') }}" class="uppercase">Ver más</a>
        </div>
      </div>
      <!--Fin genero-->    
      <!--Inicio de personal recien ingresado-->  
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Personal recién ingresado : {{ mes_espanol(date('m')) }}</h3>
          <div class="box-tools pull-right">
            <span class="label label-primary">{{ total_empleados_mes('Conteo') }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          @if(total_empleados_mes('Conteo') == 0)
            <center><h4>No hay nuevos registros que mostrar</h4></center>
            <div class="box-footer text-center"></div>
          @else
            <ul class="users-list clearfix">
              @php 
                $empleados =  total_empleados_mes('Coleccion'); 
                $i = 0;
              @endphp
              @foreach($empleados as $empleado)
                @if($i >= 4)
                 
                @endif
                  <li>
                    <img src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" style="width: 100px;" alt="User Image">
                    <a class="users-list-name" href="{{ route('Empleado.show', $empleado->Slug) }}">{{ nombre($empleado, 'Mostrar') }}</a>
                    <span class="users-list-date">{{ formato($empleado->High_date) }}</span><br>
                  </li>
                  @php 
                  $i++;
                  @endphp
              @endforeach
            </ul>
            <div class="box-footer text-center">
              <!--<a href="javascript:void(0)" class="uppercase">View All Users</a>-->
            </div>
          @endif
        </div>
      </div>
      <!--Fin de personal recien ingresado-->
      <!--Inicio Edades-->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Edades</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @php
            $edades = edades_sexo(null, null);
          @endphp
          <div id="chartEdades" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
          <table class="table">
                <tr>
                  <th></th>
                  <th style="text-align: center;">-18</th>
                  <th style="text-align: center;">18 - 25</th>
                  <th style="text-align: center;">26 - 35</th>
                  <th style="text-align: center;">36 - 45</th>
                  <th style="text-align: center;">46 - 55</th>
                  <th style="text-align: center;">+56</th>
                </tr>
                <tr>
                  <th>Hombres</th>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '18') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '18-25') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '26-35') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '36-45') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '46-55') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Hombre', '56') }}</td>
                </tr>
                <tr>
                  <th>Mujeres</th>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '18') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '18-25') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '26-35') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '36-45') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '46-55') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Mujer', '56') }}</td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '18') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '18-25') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '26-35') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '36-45') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '46-55') }}</td>
                  <td style="text-align: center;">{{ total_empleados_edad_sexo('Ambos', '56') }}</td>
                </tr>
            </table>
        </div>
        <div class="box-footer text-center">
          <a href="{{ route('Grafica.edades') }}" class="uppercase">Ver más</a>
        </div>
      </div>
      <!--Fin Edades-->  
    </div> 
    <div class="col-lg-6">
      <!--Inicio razones de baja--> 
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Razones de Baja</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @php
            $bajas = razon_baja(null, null);
          @endphp
          <div id="chartBar" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
        </div>
        <div class="box-footer text-center">
          <a href="{{ route('Grafica.razones_baja') }}" class="uppercase">Ver más</a>
        </div>
      </div>
      <!--Fin razones de baja--> 
      <!--Inicio Cumpleaños del Mes-->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cumpleaños del Mes de {{ mes_espanol(date('m')) }}</h3>
          <div class="box-tools pull-right">
            <span class="label label-blue">{{ total_empleados_cumple('Conteo') }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            @php 
              $empleados =  total_empleados_cumple('Coleccion'); 
            @endphp
            @foreach($empleados as $empleado)
              @php
                $date = date_create($empleado->Birthdate);
              @endphp
              <li>
                <img src="{{ asset('images/Fotografias/'.$empleado->Photo) }}" style="width: 50px;" alt="User Image">
                <a class="users-list-name" href="#">{{ nombre($empleado, 'Mostrar')}}</a><br>
                <span class="badge bg-blue"><i class="fa fa-gift"></i> {{ date_format($date, 'd') }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <!--Fin Cumpleaños del Mes-->
      <!--Inicio Estado Civil-->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Estado Civil</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          @php
            $estados = estado_civil(null, null);
          @endphp
          <div id="estado_civil" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
        </div>
        <div class="box-footer text-center">
          <a href="{{ route('Grafica.estado_civil') }}" class="uppercase">Ver más</a>
        </div>
      </div>
      <!--Fin Estado Civil-->
    </div>
  </div>
</section>

<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/amcharts/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/serial.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/plugins/responsive/responsive.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('plugins/amcharts/plugins/export/export.js') }}"></script>
<link  type="text/css" href="{{ asset('plugins/amcharts/plugins/export/export.css') }}" rel="stylesheet">
<script>
  AmCharts.makeChart("chartdivPie",
    {
      "type": "pie",
      "angle": 34.2,
      "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
      "depth3D": 23,
      "innerRadius": 0,
      "labelRadius": 0,
      "colors": [
        "#0077E3",
        "#F348DE"
      ],
      "titleField": "category",
      "valueField": "column-1",
      "theme": "default",
      "allLabels": [],
      "balloon": {},
      "legend": {
        "enabled": true,
        "align": "center",
        "markerType": "circle"
      },
      "titles": [],
      "dataProvider": [
        {
          "category": "Hombres",
          "column-1": {{ $hombres }}
        },
        {
          "category": "Mujeres",
          "column-1": {{ $mujeres }}
        }
      ]
    }
  );

AmCharts.makeChart("chartBar",
        {
          "type": "serial",
          "categoryField": "category",
          "startDuration": 1,
          "categoryAxis": {
            "autoRotateAngle": 45,
            "autoRotateCount": 0,
            "gridPosition": "start",
            "fontSize": 9
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "",
              "labelText": "[[value]]",
              "title": "",
              "type": "column",
              "valueField": "column-1",
              "visibleInLegend": false
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": ""
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },

          "dataProvider": [
            {!! $bajas !!}
          ]
        }
      );
AmCharts.makeChart("estado_civil",
        {
          "type": "pie",
          "angle": 45,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "depth3D": 15,
          "innerRadius": "40%",
          "titleField": "category",
          "valueField": "column-1",
          "colors": [
            "#0D52D1",
            "#2A0CD0",
            "#8A0CCF",
            "#CD0D74",
            "#754DEB",
            "#DDDDDD"
          ],
          
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "align": "center",
            "markerType": "circle"
          },
          "titles": [],
          "dataProvider": [
            {!! $estados !!}
          ]
        }
      );
/*AmCharts.makeChart("chartEdades",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 10,
          "depth3D": 20,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "colors": [
            "#FF4000"
          ],
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "",
              "labelText": "[[value]]",
              "title": "",
              "type": "column",
              "valueField": "column-1",
              "visibleInLegend": false
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": ""
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },

          "dataProvider": [
            {!! $edades !!}
          ]
        }
      );*/
      AmCharts.makeChart("chartEdades",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 0,
          "depth3D": 0,
          "colors": [
            "#0077E3",
            "#F348DE"
          ],
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "Hombres",
              "type": "column",
              "valueField": "hombres"
            },
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-2",
              "title": "Mujeres",
              "type": "column",
              "valueField": "mujeres"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": "Empleados"
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },
          "dataProvider": [
            {!! $edades !!}
          ]
        }
      );
</script>

<!-- HTML -->

@endsection