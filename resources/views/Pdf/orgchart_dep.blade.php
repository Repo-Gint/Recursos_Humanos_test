<!--
    * Creado por: Samuel Lechuga - 
    * Editado por: Samuel Lechuga - 
    * Nombre: orgchartdep.blade.php
    * Función: Generar archivo pdf.
    * Descripción: Estructura base para la creación del organigrama general mostrando los integrantes del
    * departamento seleccionado.
-->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
	    table{
          width: 100%;
          border-spacing: 0px;
          border-collapse: separate;
          float: center;
        }
        
        table :first-child{
            margin: 10px auto;
        }
        
        table td {
            text-align: center;
            vertical-align: top;
            padding: 0;
        }
        
        .lines:nth-child(3) td {
            box-sizing: border-box;
            height: 5px;
        }

        .lines .topLine {
            border-top: 2px solid rgba(152, 152, 152, 0.8);
          /*border-top: 2px solid rgba(6, 50, 150, 0.8);*/
          height: 20px;
        }

        .lines .rightLine {
            border-right: 1px solid rgba(152, 152, 152, 0.8);
          /*border-right: 1px solid rgba(6, 50, 150, 0.8);*/
          float: none;
          border-radius: 0;
        }

         .lines .leftLine {
            border-left: 1px solid rgba(152, 152, 152, 0.8);
          /*border-left: 1px solid rgba(6, 50, 150, 0.8);*/
          float: none;
          border-radius: 0;
        }

         .lines .downLine {
            background-color:  rgba(152, 152, 152, 0.8);
          /*background-color: rgba(6, 50, 150, 0.8);*/
          margin: 0 auto;
          height: 15px;
          width: 2px;
          float: none;
        }
        <?php
            if($departamento->Departament_EN == "Manufacturing CNC"){
        ?>
        .tarjeta{
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            text-align: center;
            width: 50px;
            height: 70px;
            border: 0.3 solid #8A8A8A;
        }

        .tarjeta .nombre{
            font-family: Arial, Sans-serif; 
            font-size: 6px;
            text-align: center;
            margin-bottom: 2px;
        }
        .tarjeta .puesto{
            font-family: Arial, Sans-serif; 
            font-size: 6px;
            text-align: center;
        }
        .foto{
            width: 30px;
            height: 30px;
            padding: 0.5em;
            border-radius: 15px;
        }
        <?php
           }else{
            
        ?>
        .tarjeta{
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            text-align: center;
            width: 80px;
            height: 80px;
            border: 0.3 solid #8A8A8A;
        }

        .tarjeta .nombre{
            font-family: Arial, Sans-serif; 
            font-size: 8px;
            text-align: center;
            margin-bottom: 2px;
        }
        .tarjeta .puesto{
            font-family: Arial, Sans-serif; 
            font-size: 7px;
            text-align: center;
        }
        .foto{
            width: 35px;
            height: 35px;
            padding: 0.5em;
            border-radius: 17.5px;
        }
        <?php
            
           }
        ?>
        header {
                position: fixed;
                top: 0cm;
                left: 0.5cm;
                right: 0.5cm;
                height: 1cm;
            }
            footer {
                position: fixed; 
                bottom: -1px; 
                left: 1cm;
                right: 1cm;
                height: 50px; 
                font-size: 10px;
            }
            body {
                margin-top: 2cm;
                margin-left: 0cm;
                margin-right: 0cm;
                margin-bottom: 3cm;
            }
    </style>
</head>
<body style="font-family: Arial, Sans-serif;">
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
        /*
        for ($x=0; $x < $puesto->Vacancies; $x++) { 
            $puestos_array[$i] = array('puesto_id' => $puesto->id, 'puesto' => $puesto->Position_ES, 'puesto_padre' => $puesto->Parent_id, 'llave' => $llave, 'llave_padre' => 0, 'empleado_id' => 0,  'nombre' => "", 'slug' => 0, 'foto' => "", 'padre_empleado' => 0);
            $i++;
            $llave ++;
        }*/
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

    for ($a=0; $a < count($temporal); $a++) { 
        for ($b=0; $b <count($puestos_array) ; $b++) { 
            if($puestos_array[$b]['empleado_id'] != 0){ //Tiene empleado asignado
                if($puestos_array[$b]['padre_empleado'] == null){
                    if($puestos_array[$b]['llave_padre'] == 0){
                        $puestos_array[$b]['llave_padre'] = 0;
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
                $temporal2 = $puestos_array;
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

    /*
    * Esta funcion creara el arbol de forma recursiva.
    */
    function arbol ($puestos, $ancestro){
        if($ancestro == 0){ //Se configuro desde la consulta iniciar con el de jerarquia mas alta
            $celdas = celdas_hijos($puestos,$puestos[0]['llave']);
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
            echo arbol($puestos, $puestos[0]['llave']);
        }else{
            echo "<tr class='lines'> ";
            for ($i=0; $i < count($puestos); $i++) {
                $celdas = celdas_hijos($puestos,$puestos[$i]['llave']);
                if($puestos[$i]['llave_padre'] == $ancestro){
                    echo "  <td colspan='2'>";
                    echo        personal($puestos[$i]['empleado_id'], $puestos[$i]['puesto'], $puestos[$i]['nombre'], $puestos[$i]['foto']);
                    if($celdas > 0){
                        echo"<table >
                                <tr>
                                    <td colspan='".$celdas."'>
                                        <div class='downLine'></div>
                                    </td>
                                </tr>
                                <tr class='lines'>
                                    <td colspan='".$celdas."'></td>
                                </tr>";
                        echo    lineas($celdas);
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
                        <div class='nombre'>
                            <img src='../public/images/Fotografias/".$foto."' class='foto'><br>
                            <strong>".$nombre."</strong><br>
                        </div>
                        <div class='puesto'>
                            ".$puesto."<br>
                        </div>
                    </div>";
        }else{ //en caso de que sea 0 (que no tenga empleado asignado)
            echo "  <div class='tarjeta'>
                        <div class='nombre'>
                            <img src='../public/images/Fotografias/user.jpg' class='foto'><br>
                            <strong>Vacante</strong><br>
                        </div>
                        <div class='puesto'>
                            ".$puesto."<br>
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
    <header>
        <table style="width: 100%;">
            <tr style=" border: 1px solid #333;">
                <td style="width: 20%; border: 1px solid #333;">
                    <img src="../public/images/logo.png" width="200">
                </td>
                <td style="width: 60%; border: 1px solid #333;">
                    <br>
                    <STRONG>GRUPO INTERCONSULT S.A. DE C.V.</STRONG><br><br>
                    ORGANIZATION CHART<br>
                    {{ 'Departament: '.$departamento->Departament_EN }}
                </td>
                <td style="width: 20%; border: 1px solid #333;">
                </td>
            </tr>
        </table>
    </header>
    <footer>
        <table style="width: 100%;">
            <tr>
                <td style="width: 33.33%;">
                    Elaboró:<br>
                    Head Human Rosurces
                </td>
                <td style="width: 33.33%;">
                    Revisó:<br>
                    VP Finance & Administration
                </td>
                <td style="width: 33.33%;">
                    Autorizó:<br>
                    Managing Director
                </td>
            </tr>
        </table>
    </footer>
    <br><br><br>
   <table >
        @if(empty($puestos_array ))
            No se tienen registros referente a este departamento. 
        @else
            @php

           /* for ($i=0; $i < count($puestos_array); $i++) { 
                echo "<tr>";
                    echo "<td>".$puestos_array[$i]['puesto']."</td>";
                echo "</tr>";
            }*/
            
            @endphp
            {{ arbol($puestos_array, 0)  }}
        @endif
    </table>
</body>
</html>