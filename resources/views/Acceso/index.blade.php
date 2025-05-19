@php
    $acceso = $empleado->Accesos->last();
@endphp
<div class="row">
    <div class="col-lg-3"> 
        <center>
            <label class="Datos">Sistema Intranet: </label><br>
            {{ Acceso_Intranet($acceso->Intranet) }}
        </center> 
    </div>
    <div class="col-lg-3"> 
        <center>
            <label class="Datos">Sistema Recursos Humanos: </label><br>
            {{ Acceso_RH($acceso->RRHH) }}
        </center> 
    </div>
    <div class="col-lg-3"> 
        <center>
            <label class="Datos">Sistema Mantenimiento: </label><br>
            {{ Acceso_Mantenimiento($acceso->Mantenimiento) }}
        </center> 
    </div>
    <div class="col-lg-3"> 
        <center>
            <label class="Datos">Sistema Manufactura: </label><br>
            {{ Acceso_Manufactura($acceso->Manufactura) }}
        </center> 
    </div>
</div>
