<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\PuestoRequest;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Recursos_Humanos\Puesto;
use Recursos_Humanos\Departamento;
use Recursos_Humanos\Jerarquia;
use Recursos_Humanos\Empleado;
use Exception;

class PuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Puesto.create')->only(['create', 'store']);
        $this->middleware('permissions:Puesto.edit')->only(['create', 'update']);
        $this->middleware('permissions:Puesto.show')->only(['show']);
        $this->middleware('permissions:Puesto.index')->only(['index']);
        $this->middleware('permissions:Puesto.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $puestos = Puesto::orderBy('Position_ES', 'ASC')->where('Active', '=', 1)->get();  
        $inactivos = Puesto::orderBy('Position_ES', 'ASC')->where('Active', '=', 0)->get();  
        $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->where('Active', '=', 1)->pluck('Departament_ES', 'id');

       return view('Puesto.index')->with('puestos', $puestos)->with('inactivos', $inactivos)->with('departamentos', $departamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jerarquias = Jerarquia::orderBy('Level', 'ASC')->pluck('Name_ES', 'id'); //pasa los registros que se tiene en la tabla jerarquias
        $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id'); //pasa los registros que se tiene en la tabla departamentos
        $puestos = Puesto::select(DB::raw('CONCAT(Code," - ",Position_ES) AS Position'), 'id')->orderBy('Position_ES', 'ASC')->pluck('Position', 'id');
        return view('Puesto.create')->with('jerarquias', $jerarquias)->with('departamentos', $departamentos)->with('puestos', $puestos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuestoRequest $request)
    {
        try{
            $puesto = new Puesto($request->all());
            $puesto->Active = 1;
            $puesto->save();
            
            flash('Se guardo con éxito el puesto '. $puesto->Position_ES .'')->success();
            return redirect()->route('Puesto.create');
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try{
            $jerarquias = Jerarquia::orderBy('Level', 'ASC')->pluck('Name_ES', 'id');
            $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id');
            $puesto = Puesto::whereSlug($slug)->firstOrFail();
            $departamento = Departamento::where('id', $puesto->Departament_id)->firstOrFail();

            $puestos = Puesto::select(DB::raw('CONCAT(Code," - ",Position_ES) AS Position'), 'id')->where('id','<>', $puesto->id)->where('Departament_id', '=', $puesto->Departament_id)->orWhere('Departament_id','=', $departamento->Parent_id)->where('positions.Active', '=', 1)->orderBy('Hierarchy_id', 'ASC')->pluck('Position', 'id'); 

            return view('Puesto.edit')->with('puesto', $puesto)->with('jerarquias', $jerarquias)->with('departamentos', $departamentos)->with('puestos', $puestos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Puesto.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PuestoRequest $request, $id)
    {
        try{
            $puesto = Puesto::find($id);
            $puesto->Code = $request['Code'];
            $puesto->Position_ES = $request['Position_ES'];
            $puesto->Position_EN = $request['Position_EN'];
            $puesto->Descripcion = $request['Descripcion'];
            $puesto->Responsability = $request['Responsability'];
            $puesto->Vacancies = $request['Vacancies'];


            //Si el puesto superior cambia al actual, cambiaremos el parent del empleado

            if($puesto->Parent_id != $request['Parent_id']){

                $empleado_superior = Empleado::select('employees.id')->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('positions.id', $request['Parent_id'])->first();
               // dd($empleado_superior);
                $empleado = Empleado::select('employees.id')->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('positions.id', $puesto->id)->get();

                foreach ($empleado as $emp) {
                    $e = Empleado::find($emp->id);
                    if($empleado_superior == null){
                        $e->Parent_id = null;
                    }else{
                       $e->Parent_id = $empleado_superior->id; 
                    }
                    
                    $e->save();
                }
            }
            
            $puesto->Parent_id = $request['Parent_id'];
            $puesto->Hierarchy_id = $request['Hierarchy_id'];
            $puesto->Departament_id = $request['Departament_id'];
            $puesto->save();
            flash('Se editó con éxito el puesto '. $puesto->Position_ES .'')->success();
            return redirect()->route('Puesto.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Puesto.edit', $puesto->slug);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request)
    {
        try{
            $puesto = Puesto::find($request['id_puesto']);          
            $puesto->Active = 1;
            $puesto->Departament_id = $request['Departament_id'];
            $puesto->Parent_id= $request['Parent_id'];
            $puesto->save();

            flash('Se ha inactivado con éxito el puesto '. $puesto->Position_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Puesto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        try{
            $puesto = Puesto::find($id);
            if($puesto->empleado->isNotEmpty()){
                throw new Exception('El puesto no se puede inactivar porque tiene empleado(s) asociado(s).');
            }

            $puestos_a_cargo = Puesto::where('Parent_id', $id)->get();
            if($puestos_a_cargo->isNotEmpty()){
                throw new Exception('El puesto no se puede inactivar porque tiene puestos asociados.');
            }


            $puesto->Vacancies = 1;
            $puesto->Active = 0;
            $puesto->Parent_id= null;
            $puesto->save();

            flash('Se ha inactivado con éxito el departamento '. $puesto->Position_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Puesto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $puesto = Puesto::find($id);
            if($puesto->empleado->isNotEmpty()){
                throw new Exception('El puesto no se puede eliminar porque tiene empleados asociados a este registro. ');
            }
            $puesto->Code = null;
            $puesto->Slug = "";
            $puesto->Active = 0;
            $puesto->save();

            flash('Se ha borrado con éxito el puesto '. $puesto->Position_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    
        return redirect()->route('Puesto.index');
    }

    public static function obtener_puestos(Request $request, $id)
    {
        $puestos = Puesto::get_puestos($id);
        return response()->json($puestos);
    }

    public static function obtener_puestos_superiores(Request $request, $id)
    {
        $puestos = Puesto::get_puestos_superiores($id);
        return response()->json($puestos);
    }
}
