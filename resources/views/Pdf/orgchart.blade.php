<!--
    * Creado por: Samuel Lechuga - 
    * Editado por: Samuel Lechuga - 
    * Nombre: orgchart.blade.php
    * Función: Generar archivo pdf.
    * Descripción: Estructura base para la creación del organigrama general mostrando los departamentos
    * conforman la empresa.
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
            height: 10px;
        }

        .lines .topLine {
          border-top: 2px solid rgba(152, 152, 152, 0.8);
          height: 20px;
        }

        .lines .rightLine {
          border-right: 1px solid rgba(152, 152, 152, 0.8);
          float: none;
          border-radius: 0;
        }

         .lines .leftLine {
          border-left: 1px solid rgba(152, 152, 152, 0.8);
          float: none;
          border-radius: 0;
        }

         .lines .downLine {
          background-color: rgba(152, 152, 152, 0.8);
          margin: 0 auto;
          height: 20px;
          width: 2px;
          float: none;
        }

        .recuadro{
            margin: 0;
            padding: 2px;
            border-radius: 5px;
            font-size: 12px;
            margin-left: auto;
            margin-right: auto;
            width: 80px;
            height: 40px;
            border: 0.5 solid #C9C9C9;
            color: white;
            background: rgba(73,155,234,1);
            background: -moz-linear-gradient(left, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(73,155,234,1)), color-stop(100%, rgba(32,124,229,1)));
            background: -webkit-linear-gradient(left, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -o-linear-gradient(left, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -ms-linear-gradient(left, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: linear-gradient(to right, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5', GradientType=1 );
            -webkit-box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.5);
            -moz-box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.5);
            box-shadow: 1px 1px 10px 0px rgba(0,0,0,0.5);
        }
        header {
                position: fixed;
                top: 0cm;
                left: 1cm;
                right: 1cm;
                height: 2cm;
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
        $org_array = array();
        $i = 0;
        $j = 0;

        foreach($departamentos as $departamento){
            if($departamento->Active == 1){
                $org_array[$i] = array('id' => $departamento->id, 'departamento' => $departamento->Departament_ES, 'padre' => $departamento->Parent_id, 'slug' => $departamento->Slug);
                $i++;
            }
        }
        function arbol ($departamentos, $ancestro, $celdas_padre){
            if($ancestro == 0){
                $celdas = celdas_hijos($departamentos,$departamentos[0]['id']);
                echo " <tr>
                            <td colspan='".$celdas."'>
                                <div class ='recuadro'>";
                                    echo $departamentos[0]['departamento'];
                echo "          </div>
                            </td>
                        </tr>
                        <tr class='lines'>
                            <td colspan='".$celdas."'>
                                <div class='downLine'></div>
                            </td>
                        </tr>";
                echo lineas($celdas);
                echo arbol($departamentos, $departamentos[0]['id'], $celdas);
            }else{
                echo "<tr class='lines'> ";
                for ($i=0; $i < count($departamentos); $i++) {
                    $celdas = celdas_hijos($departamentos,$departamentos[$i]['id']);
                    if($departamentos[$i]['padre'] == $ancestro){
                        echo "<td colspan='2'>
                                <div class ='recuadro'>";
                                    echo $departamentos[$i]['departamento'];
                        echo "  </div>";
                        if($celdas > 0){
                            echo"<table>
                                    <tr>
                                        <td colspan='".$celdas."'>
                                            <div class='downLine'></div>
                                        </td>
                                    </tr>
                                    <tr class='lines'>
                                        <td colspan='".$celdas."'></td>
                                    </tr>";
                            echo lineas($celdas);
                            echo arbol($departamentos, $departamentos[$i]['id'], $celdas);
                            echo"</table>";
                        }else{
                            echo "</td>";
                        }
                    }
                }
                echo "</tr>";
            }
        }

        function celdas_hijos($arreglo, $ancestro){
            $x = 0;
            for ($i=0; $i < count($arreglo); $i++) {
                if($arreglo[$i]['padre'] == $ancestro){
                    $x++;
                }
            }

            return $x * 2;
        }

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
                    <STRONG>GRUPO INTERCONSULT S.A. DE C.V.</STRONG><br>
                    ORGANIZATION CHART<br>
                    GENERAL
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
        @if(empty($org_array ))
            No se tienen registros referente a este departamento. 
        @else
            {{ arbol($org_array, 0, 0) }}
        @endif
    </table>
</body>
</html>