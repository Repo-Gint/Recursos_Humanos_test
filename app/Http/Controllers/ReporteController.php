<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Recursos_Humanos\Departamento;
use Recursos_Humanos\Empleado;
use Barryvdh\Dompdf\Dompdf;
use Barryvdh\Dompdf\PDF;
use Illuminate\Support\Arr;

use Recursos_Humanos\Exports\EmpleadoExport;
use Recursos_Humanos\Exports\PuestosExport;
use Recursos_Humanos\Exports\VacacionesExport;
use Recursos_Humanos\Exports\Vacaciones_ConcentradoExport;
use Recursos_Humanos\Exports\Vacaciones_FechasExport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Reporte.index')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id');
        $departamentos->put('Todo', 'Todo');
        return view('Reporte.index')->with('departamentos', $departamentos);
    }

    public function listado_empleados (Request $request){
        try{

            $ban = 0;
            for ($i=0; $i < count($request['Departaments']) ; $i++) { 
                if($request['Departaments'][$i] == "Todo"){
                    $ban = 1;
                }
            }

            $empleados = Empleado::where('Active', 1)->get();
            $lista_empleados = collect([]);

            if($ban == 1){
                $lista_empleados = $empleados;
            }else{
                for ($i=0; $i < count($request['Departaments']) ; $i++) { 
                    foreach ($empleados as $empleado) {
                        $puesto = $empleado->Puesto->last();
                        $departamento = $puesto->Departamento;
                        if($departamento->id == $request['Departaments'][$i]){
                            $lista_empleados->push($empleado);
                        }                       
                    }
                }
                 
            }

            if($request['formato'] == "PDF"){
                if($request['campos'] == "Datos"){
                    $pdf = \PDF::loadView('Pdf.listado_empleados', ['empleados' => $lista_empleados, 'campos' => $request['campos']])->setPaper('legal', 'landscape');
                    return $pdf->download('listado_empleados.pdf');        
                }else{
                    $pdf = \PDF::loadView('Pdf.listado_empleados', ['empleados' => $lista_empleados, 'campos' => $request['campos']])->setPaper('letter', 'landscape');
                    return $pdf->download('listado_empleados.pdf');
                }
            }
            
            if($request['formato'] == "XLS"){
                return (new EmpleadoExport($lista_empleados, $request['campos']))->download('empleados.xlsx');
            }

        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
             return redirect()->route('Reporte.index');
        }
    }

    public function catalogo_puestos (Request $request){

        $query = DB::table('departaments')
        ->join('positions', 'departaments.id', '=', 'positions.Departament_id')
        ->select('positions.id AS Position_id','positions.Code','Position_ES','Position_EN', 'Vacancies', 'positions.Active', 'Departament_ES');

        $empleados = DB::table('employees')
        ->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
        ->get();

        $ban = 0;
        for ($i=0; $i < count($request['Departaments']) ; $i++) { 
            if($request['Departaments'][$i] == "Todo"){
                $ban = 1;
            }
        }
        if($ban == 1){
            $puestos = $query->where('positions.Active', '=', 1)->orderBy('Departament_ES', 'ASC')->get();
        }else{
            for ($i=0; $i < count($request['Departaments']) ; $i++) { 
                $query->orWhere('departaments.id', '=', $request['Departaments'][$i]);
            }
             $puestos = $query->where('positions.Active', '=', 1)->orderBy('Departament_ES', 'ASC')->get();
        }

        if($request['formato'] == "PDF"){
                $pdf = \PDF::loadView('Pdf.catalogo_puestos', ['puestos' => $puestos, 'empleados' => $empleados])->setPaper('letter', 'protrait');
                return $pdf->download('catalogo_puestos.pdf');
        }
        if($request['formato'] == "XLS"){
            return (new PuestosExport($request))->download('catalogo_puestos.xlsx');
        }
    }

    public function vacaciones (Request $request){
        try{

            /** Validación de reportes**/
            if(empty($request['tipo_reporte'])){
                throw new Exception("Debe de seleccionar una opción de reporte.");
            }

            if($request['Departaments'][0] == null){
                throw new Exception("Debe de seleccionar algun departamento.");
            }

            if(empty($request['formato'])){
                throw new Exception("Debe de elegir el formato a exportar.");
            }
            /** Validación de reportes **/

             $query = Empleado::select('employees.id', 'employees.Code','employees.Names', 'employees.Paternal', 'employees.Maternal', 'positions.Position_ES', 'positions.Departament_id')
            ->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
            ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
            ->join('departaments', 'positions.Departament_id', '=', 'departaments.id');

            $departamentos = Departamento::select('id', 'Departament_ES');
            
            
            
            $ban = 0;
            for ($i=0; $i < count($request['Departaments']) ; $i++) { 
                if($request['Departaments'][$i] == "Todo"){
                    $ban = 1;
                }
            }

            if($ban == 1){
                $empleados = $query->where('employees.Active', '=', 1)->orderBy('Paternal', 'ASC')->get();
            }else{
                for ($i=0; $i < count($request['Departaments']) ; $i++) { 
                    $query->orWhere('Departament_id', '=', $request['Departaments'][$i]);
                    $departamentos->orWhere('id', '=', $request['Departaments'][$i]);
                }
                 $empleados = $query->where('employees.Active', '=', 1)->orderBy('Paternal', 'ASC')->get();
                 
            }
            $departamentos = $departamentos->get();
            if($request['tipo_reporte'] == "Resumen"){
                if($request['formato'] == "PDF"){
                    $pdf = \PDF::loadView('Pdf.vacaciones_resumen', ['departamentos' => $departamentos, 'empleados' => $empleados])->setPaper('letter', 'protrait');
                    return $pdf->download('resumen_vacaciones.pdf');
                }
                if($request['formato'] == "XLS"){
                    return (new VacacionesExport($departamentos, $empleados))->download('resumen_vacaciones.xlsx');
                }
            }

            if($request['tipo_reporte'] == "Concentrado"){
                if($request['formato'] == "PDF"){

                    $pdf = \PDF::loadView('Pdf.vacaciones_concentrado', ['empleados' => $empleados])->setPaper('letter', 'protrait');
                    return $pdf->download('concentrado_vacaciones.pdf');
                }
                if($request['formato'] == "XLS"){
                    return (new Vacaciones_ConcentradoExport($departamentos, $empleados))->download('concentrado_vacaciones.xlsx');
                }
            }

            if($request['tipo_reporte'] == "Por_fechas"){
                /** Validación de reportes**/
                if(empty($request['date1']) || empty($request['date2'])){
                    throw new Exception("Debe de elegir fecha de inicio y fecha de fin.");
                }
                /** Validación de reportes**/
                if($request['formato'] == "PDF"){
                    $pdf = \PDF::loadView('Pdf.vacaciones_fechas', ['empleados' => $empleados, 'fecha_inicio' => $request['date1'], 'fecha_fin' => $request['date2'], 'departaments' => $request['Departaments']])->setPaper('letter', 'protrait');
                    return $pdf->download('fechas_vacaciones.pdf');
                }
                if($request['formato'] == "XLS"){
                     return (new Vacaciones_FechasExport($departamentos, $empleados, $request['date1'], $request['date2'], $request['Departaments']))->download('fechas_vacaciones.xlsx');
                }
            }


        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Reporte.index');
        } 
       
    }

}
