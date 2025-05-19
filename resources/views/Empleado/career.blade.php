@php
 $historial = Carrera_profesional($empleado);
@endphp
<br>
<div class="row">
    <div class="col-md-12">
        <ul class="timeline">
          @foreach($historial->sortBy('fecha') as $h)
             
                <li class="time-label">
                  <span class="{{ $h['Color'] }}">
                    {{ Formato($h['fecha']) }}
                  </span>
                </li>
                <li>
                  <i class="{{ $h['Icono'] }}"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</a> {{ $h['Titulo']}}</h3>   
                     <div class="timeline-body">
                      {{ $h['Descripcion1'] }}<br>
                      {{ $h['Descripcion2'] }}<br>
                      {{ $h['Descripcion3'] }}
                  </div>             
                  </div>
                </li>
              
            @endforeach
            {{--  @for($i = 0; $i < count($historial); $i++)
              @if($i == 0)
                <li class="time-label">
                  <span class="bg-green">
                    {{ Formato($historial[$i]['fecha']) }}
                  </span>
                </li>
                <li>
                  <i class="fa fa-user bg-green"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header"><a href="#">{{ $empleado->Names.' '.$empleado->Paternal.' '.$empleado->Maternal }}</a> {{ $historial[$i]['Titulo'] }}</h3>   
                     <div class="timeline-body">
                      {{ $historial[$i]['Descripcion1'] }}<br>
                      {{ $historial[$i]['Descripcion2'] }}<br>
                      {{ $historial[$i]['Descripcion3'] }}
                  </div>             
                  </div>
                </li>
              @else
                @if($fecha != $historial[$i]['fecha'])
                  @php
                  $fecha = $historial[$i]['fecha'];
                  @endphp
                  <li class="time-label">
                    <span class="bg-blue">
                      {{ Formato($historial[$i]['fecha']) }}
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-tag bg-aqua"></i>
                    <div class="timeline-item">
                      @for($j = 0; $j < count($historial); $j++)
                        @if($fecha == $historial[$j]['fecha'])
                          <h3 class="timeline-header">{{ $historial[$j]['Titulo'] }}</h3>                
                    
                          <div class="timeline-body">
                              {{ $historial[$j]['Descripcion1'] }}<br>
                              {{ $historial[$j]['Descripcion2'] }}<br>
                              {{ $historial[$j]['Descripcion3'] }}
                          </div>
                        @endif
                      @endfor
                    </div>
                  </li>
                @endif
                  
              @endif
            @endfor--}}
        </ul>
    </div>
</div>
