@extends('layouts.app')

@section('title', 'Departamentos')
@section('Pag', 'Departamentos / Organigrama ')
@section('content')
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
            echo "  <tr>
                        <td colspan='".$celdas."'>
                            <a href=".route('Departamento.show', $departamentos[0]['slug'])." class='link-dep'>
                                <div class ='recuadro'>";
                                    echo $departamentos[0]['departamento'];
            echo "                  <span><br>
                                        <i class='fa fa-users'></i>
                                        ".total_empleados_departamento($departamentos[0]['id'])."
                                    </span>
                                </div>
                            </a>
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
                            <a href=".route('Departamento.show', $departamentos[$i]['slug'])." class='link-dep'>
                                <div class ='recuadro'>";
                                    echo $departamentos[$i]['departamento'];
                    echo"           <span><br>
                                        <i class='fa fa-users'></i>
                                        ".total_empleados_departamento($departamentos[$i]['id'])."
                                    </span>
                                </div>
                            </a>";
                    if($celdas > 0){
                        echo"<table class='org'>
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
     
<div class="row">
    <div class="col-lg-12"> 
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Organigrama Empresarial</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class='org'>
                        @if(empty($org_array ))
                            No se tienen registros referente a este departamento. 
                        @else
                            {{ arbol($org_array, 0, 0) }}
                        @endif
                    </table>
                    <a href="{{ route('orgchartpdf') }}">
                        <button class="btn btn-default" style="float: right; margin-right: 10px;">
                            <i class="fa fa-file-pdf-o"></i> Descargar PDF
                        </button>
                    </a>
                </div>
                
            </div>
        </div>
    </div> 
</div>


@endsection