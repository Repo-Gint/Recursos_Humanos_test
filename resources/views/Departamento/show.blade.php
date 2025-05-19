@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Departamentos / Información del Departamento')
@section('content')
 <?php
    $puestos_array= array();
    $i = 0;
    $j = 0;
    $llave = 1001; //llave interna, tomara el lugar de la id del puesto
    $ban = false;

    /*
    * Con el primer foreach creamos array y guardamos los datos del puesto y creamos espacion para asignar empleado.
    * De acuerdo al numero de vacantes de cada puesto se repetira el registro con una llave unica.
    */
    foreach($puestos as $puesto){
        if($departamento->id == $puesto->Departament_id){ //el puesto pertenece al departamento a consultar
            $padre = $puesto->Parent_Puesto; //vemos si el puesto tiene un padre

            if($departamento_padre != NULL && $departamento_padre->id == $padre->Departament_id){ 
                // Si tiene padre el puesto y el departamento al que pertenece 

                for ($z=0; $z < count($puestos_array); $z++) { //nos aseguramos que el puesto no se duplique
                    if($padre->id == $puestos_array[$z]['puesto_id']){
                        $ban = true;
                        break;
                    }
                }

                if($ban != true){ //si no existe el puesto padre se ingresa dentro del array
                    for ($x=0; $x < $padre->Vacancies; $x++) { 
                        $puestos_array[$i] = array('puesto_id' => $padre->id, 'puesto' => $padre->Position_ES, 'puesto_padre' => $padre->Parent_id, 'llave' => $llave, 'llave_padre' => 0, 'empleado_id' => 0,  'nombre' => "", 'slug' => 0, 'foto' => "", 'padre_empleado' => 0);
                        $i++;
                        $llave ++;
                    }
                    $ban = false;
                }
            }
            
            for ($x=0; $x < $puesto->Vacancies; $x++) { 
                $puestos_array[$i] = array('puesto_id' => $puesto->id, 'puesto' => $puesto->Position_ES, 'puesto_padre' => $puesto->Parent_id, 'llave' => $llave, 'llave_padre' => 0, 'empleado_id' => 0,  'nombre' => "", 'slug' => 0, 'foto' => "", 'padre_empleado' => 0);
                $i++;
                $llave ++;

            }
            
        }
        
    }

    /*
    * Con el segundo foreach asignamos el empleado para cada puesto.
    * 
    */
    foreach($empleados as $empleado){
        for ($a=0; $a < count($puestos_array) ; $a++) { 
            if($puestos_array[$a]['puesto_id'] == $empleado->Position_Id) {
                if($puestos_array[$a]['empleado_id'] == 0){
                    $puestos_array[$a]['empleado_id'] = $empleado->Employee_Id;
                    $puestos_array[$a]['nombre'] = nombre($empleado, 'Mostrar');
                    $puestos_array[$a]['slug'] = $empleado->Employee_Slug;
                    $puestos_array[$a]['foto'] = $empleado->Photo;
                    $puestos_array[$a]['padre_empleado'] = $empleado->Employee_Parent;
                    break;
                }
            }
        }
    }  

    $temporal = $puestos_array; //creamos un array temporal que nos ayudara para asignar llaves padres para cada puesto (Parent)
    $temporal2 = $puestos_array;
    for ($a=0; $a < count($temporal); $a++) { 
        for ($b=0; $b <count($puestos_array) ; $b++) { 
            if($puestos_array[$b]['empleado_id'] != 0){ //Tiene empleado asignado
                if($puestos_array[$b]['padre_empleado'] == null){
                    for ($z=0; $z < count($temporal2); $z++) { 
                        if($puestos_array[$b]['puesto_padre'] == $temporal2[$z]['puesto_id']){
                            if($puestos_array[$b]['llave_padre'] == 0){
                                $puestos_array[$b]['llave_padre'] = $temporal2[$z]['llave'];
                            }
                        }
                        $break;   
                    }
                }else{
                    if($temporal[$a]['empleado_id'] == $puestos_array[$b]['padre_empleado']){
                        if($puestos_array[$b]['llave_padre'] == 0){
                            $puestos_array[$b]['llave_padre'] = $temporal[$a]['llave'];
                            $break;
                        }
                    }
                }                
            }else{ //en caso de que no tenga empleado, se coloca el parent del puesto que trae por defecto.
                
                for ($z=0; $z < count($temporal2); $z++) { 
                    if($puestos_array[$b]['puesto_padre'] == $temporal2[$z]['puesto_id']){
                        if($puestos_array[$b]['llave_padre'] == 0){
                            $puestos_array[$b]['llave_padre'] = $temporal2[$z]['llave'];
                        }
                    }
                    $break;   
                }
            }
        }
    }
//print_r($puestos_array);
    /*
    * Esta funcion creara el arbol de forma recursiva.
    */
    function arbol ($puestos, $ancestro){
        if($ancestro == 0){ //Se configuro desde la consulta iniciar con el de jerarquia mas alta
            $celdas = celdas_hijos($puestos,$puestos[0]['llave']);
            if($celdas > 2){
                echo "  <tr>
                        <td colspan='".$celdas."'>";
                            echo personal($puestos[0]['empleado_id'], $puestos[0]['puesto'], $puestos[0]['nombre'], $puestos[0]['foto']);
                echo "      </td>
                        </tr>
                        <tr class='lines'>
                            <td colspan='".$celdas."'>
                                <div class='downLine'></div>
                            </td>
                        </tr>";
                echo lineas($celdas);
            }else{
                echo "  <tr class='lines'>
                        <td colspan='".$celdas."'>";
                            echo personal($puestos[0]['empleado_id'], $puestos[0]['puesto'], $puestos[0]['nombre'], $puestos[0]['foto']);
                echo "     <div class='downLine'></div> </td>";
                
            }
            echo arbol($puestos, $puestos[0]['llave']);
        }else{
            echo "<tr class='lines'> ";
            for ($i=0; $i < count($puestos); $i++) {
                $celdas = celdas_hijos($puestos,$puestos[$i]['llave']);
                if($puestos[$i]['llave_padre'] == $ancestro){
                    echo "  <td colspan='2'>";
                    echo        personal($puestos[$i]['empleado_id'], $puestos[$i]['puesto'], $puestos[$i]['nombre'], $puestos[$i]['foto']);
                    if($celdas > 0){
                         if($celdas > 2){
                            echo"<table class='org'>
                                <tr>
                                    <td colspan='".$celdas."'>
                                        <div class='downLine'></div>
                                    </td>
                                </tr>
                                <tr class='lines'>
                                    <td colspan='".$celdas."'></td>
                                </tr>";
                            echo    lineas($celdas);
                        }else{
                            echo"<table class='org'>
                                <tr class='lines'>
                                    <td colspan='".$celdas."'>
                                        <div class='downLine'></div>
                                    </td>
                                </tr>";
                        }
                        echo    arbol($puestos, $puestos[$i]['llave']);
                        echo"</table>";
                    }else{
                        echo "</td>";
                    }
                }
            }
            echo "</tr>";
        }
    }

    /*
    * Funcion que retorna los datos del empleado en un estilo de tarjeta (css)
    */
    function personal($id_empleado, $puesto, $nombre, $foto){
        if($id_empleado != 0){ // si el id es diferente de 0
            echo "  <div class='tarjeta'>
                        <img src='".asset('images/Fotografias/'.$foto)."' class='foto'>
                        <div class='texto'>
                            <strong>".$nombre."</strong><br>
                            <i>".$puesto."</i><br>
                        </div>
                    </div>";
        }else{ //en caso de que sea 0 (que no tenga empleado asignado)
            echo "  <div class='tarjeta'>
                        <img src='".asset('images/Fotografias/user.jpg')."' class='foto'>
                        <div class='texto'>
                            <strong>Vacante</strong><br>
                            <i>".$puesto."</i><br>
                        </div>
                    </div>";
        }
    }

    /*
    * Funcion que retorna el numero de celdas a ocupar de acuerdo a los hijos que se tiene
    */
    function celdas_hijos($arreglo, $ancestro){
        $x = 0;
        for ($i=0; $i < count($arreglo); $i++) {
            if($arreglo[$i]['llave_padre'] == $ancestro){
                $x++;
            }
        }
        
        return $x * 2; //Se multiplica por 2 para que se ocupe dos celdas por hijo
    }

    /*
    * Función que retorna las lineas para conectar hijos con padres
    */
    function lineas($celdas){
        $ban = true;
        echo "<tr class='lines'>";
        for ($i=0; $i < $celdas; $i++) { 
            if($i == 0){
                echo "<td class='rightLine'></td>";
            }else{
                if(($i + 1) == $celdas){
                    echo "<td class='leftLine'></td>";
                }else{
                    if($ban == true){
                        echo "<td class='leftLine topLine'></td>";
                        $ban = false;
                    }else{
                        echo "<td class='rightLine topLine'></td>";
                        $ban = true;
                    }
                }
            }
        }
        echo "</tr>";
    }

?>
  <div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Organigrama: {{ $departamento->Departament_ES }}</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class='org'>
                        @if(empty($puestos_array ))
                            No se tienen registros referente a este departamento. 
                        @else
                            {{ arbol($puestos_array, 0) }}
                        @endif
                    </table>
                </div>
                <br>
                <a href="{{ route('Departamento.showPosition', $departamento->Slug) }}">
                    <button class="btn btn-default" style="float: right; margin-right: 10px;">
                        <i class="fa fa-sitemap"></i> Puestos
                    </button>
                </a>
                <a href="{{ route('orgchartdeppdf', $departamento->Slug) }}">
                    <button class="btn btn-default" style="float: right; margin-right: 10px;">
                        <i class="fa fa-file-pdf-o"></i> Descargar PDF
                    </button>
                </a>
            </div>
        </div>
    </div> 
</div>   

@endsection