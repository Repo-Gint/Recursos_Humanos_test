<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\DepartamentoRequest;
use Recursos_Humanos\Departamento; 
use Laracasts\Flash\Flash; 
use Recursos_Humanos\Puesto;
use Recursos_Humanos\Empleado;
use Exception;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Departamento.create')->only(['create', 'store']);
        $this->middleware('permissions:Departamento.edit')->only(['create', 'update']);
        $this->middleware('permissions:Departamento.show')->only(['show']);
        $this->middleware('permissions:Departamento.index')->only(['index']);
        $this->middleware('permissions:Departamento.destroy')->only(['destroy']);
        $this->middleware('permissions:Departamento.Organigrama_general')->only(['Organigrama_general']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->where('Active', '=', 1)->get();
            $list = Departamento::orderBy('Departament_ES', 'ASC')->where('Active', '=', 1)->pluck('Departament_ES', 'id');
            $inactivos = Departamento::orderBy('Departament_ES', 'ASC')->where('Active', '=', 0)->get();
            return view('Departamento.index')->with('departamentos', $departamentos)->with('inactivos', $inactivos)->with('list', $list);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->url('/Panel');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->where('Active', '=', 1)->pluck('Departament_ES', 'id');
        return view('Departamento.create')->with('departamentos', $departamentos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {     
        try{
            $departamento = new Departamento($request->all());
            $departamento->Active = 1;
            $departamento->save();
            
            flash('Se guardo con éxito el departamento '. $departamento->Departament_ES .'')->success();
            
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Departamento.create');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try{
            $departamento = Departamento::whereSlug($slug)->firstOrFail();
            if($departamento->Parent_id != NULL){
                $departamento_padre = Departamento::where('id', '=', $departamento->Parent_id)->firstOrFail();
            }else{
                $departamento_padre = NULL;
            }
            if($departamento->Departament_ES == 'Dirección General'){
                $puestos = Puesto::where('positions.Active', '=', 1)
                ->orderBy('Hierarchy_id', 'ASC')
                ->with('empleado')
                ->get();
                $empleados = Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
                ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('employees.Active','=', 1)
                ->get();
            }else{
                $puestos = Puesto::select('positions.id','Code', 'Position_ES', 'Position_EN', 'Descripcion', 'Responsability', 'Vacancies', 'positions.Active', 'positions.Slug', 'Parent_id', 'Hierarchy_id', 'Departament_id')
                ->join('hierarchies', 'positions.Hierarchy_id', '=', 'hierarchies.id')
                ->where('positions.Active', '=', 1)
                ->orderBy('hierarchies.Level', 'ASC')
                ->get();

                $empleados = Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
                ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('employees.Active','=', 1)
                ->get();
            }

            
            return view('Departamento.show')->with('departamento', $departamento)->with('departamento_padre', $departamento_padre)->with('puestos', $puestos)->with('empleados', $empleados);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Departamento.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPosition($slug)
    {
        try{
            $departamento = Departamento::whereSlug($slug)->firstOrFail();
            if($departamento->Parent_id != NULL){
                $departamento_padre = Departamento::where('id', '=', $departamento->Parent_id)->firstOrFail();
            }else{
                $departamento_padre = NULL;
            }
            if($departamento->Departament_ES == 'Dirección General'){
                $puestos = Puesto::where('positions.Active', '=', 1)
                ->orderBy('Hierarchy_id', 'ASC')
                ->with('empleado')
                ->get();
                $empleados = Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
                ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('employees.Active','=', 1)
                ->get();
            }else{
                $puestos = Puesto::select('positions.id','Code', 'Position_ES', 'Position_EN', 'Descripcion', 'Responsability', 'Vacancies', 'positions.Active', 'positions.Slug', 'Parent_id', 'Hierarchy_id', 'Departament_id')
                ->join('hierarchies', 'positions.Hierarchy_id', '=', 'hierarchies.id')
                ->where('positions.Active', '=', 1)
                ->orderBy('hierarchies.Level', 'ASC')
                ->get();

                $empleados = Empleado::select('employees.id AS Employee_Id', 'positions.id AS Position_Id', 'employees.Slug AS Employee_Slug', 'employees.Parent_id AS Employee_Parent', 'Photo', 'Names', 'Paternal', 'Maternal')
                ->join('employee_position', 'employees.id', '=','employee_position.Employee_id')
                ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                ->where('employees.Active','=', 1)
                ->get();
            }

            
            return view('Departamento.showPositions')->with('departamento', $departamento)->with('departamento_padre', $departamento_padre)->with('puestos', $puestos)->with('empleados', $empleados);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Departamento.index');
        }
        
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
            $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id');
            $departamento = departamento::whereSlug($slug)->firstOrFail();
            return view('Departamento.edit')->with('departamento', $departamento)->with('departamentos', $departamentos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Departamento.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoRequest $request, $id)
    {
        try{    
            $departamento = Departamento::find($id);
            
            $departamento->Departament_ES=$request['Departament_ES'];
            $departamento->Departament_EN=$request['Departament_EN'];
            $departamento->Acronym=$request['Acronym'];
            
            $array = array();
            $i=0;

            //validamos si el departamento cambio de departamento superior
            if($departamento->Parent_id != $request['Parent_id']){
                //Colsultamos a personal del departamento superior actual.
                $personal_departamento_superior = Puesto::where('Departament_id', $departamento->Parent_id)->get();
                //Consultamos al personal del departamento a modificar
                $personal_departamento = Puesto::where('Departament_id', $departamento->id)->get();

                //Recorremos el personal del departamento superior contra el departamento a modificar
                foreach ($personal_departamento_superior as $superior) {
                    foreach ($personal_departamento as $personal){
                        //Si existe personal que se diriga a un puesto superior se guardara el id en un arreglo
                        if($superior->id == $personal->Parent_id){
                            $array[$i] = $personal->id;
                            $i++;
                        }
                    }
                }

                //Ahora consultamos al personal con el nivel gerarquico mayor del nuevo departamento superior
                $personal_nuevo_departamento_superior = Puesto::select('positions.id')->join('hierarchies', 'positions.Hierarchy_id', '=', 'hierarchies.id')->where('Departament_id', $request['Parent_id'])->orderBy('hierarchies.Level', 'ASC')->first();

                $empleado_superior = Empleado::select('employees.id')->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
                    ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                    ->where('positions.id', $personal_nuevo_departamento_superior->id)
                    ->first();

                for ($j=0; $j < count($array) ; $j++) { 

                    $puesto = Puesto::find($array[$j]);
                    $puesto->Parent_id = $personal_nuevo_departamento_superior->id;
                    $puesto->save();
                    
                    $empleado = Empleado::select('employees.id')->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
                    ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
                    ->where('positions.id', $puesto->id)
                    ->get();

                    foreach ($empleado as $emp) {
                        $e = Empleado::find($emp->id);
                        $e->Parent_id = $empleado_superior->id;
                        $e->save();
                    }
                    

                }


                $departamento->Parent_id = $request['Parent_id'];
            }

            $departamento->save();

            flash('Se editó con éxito el departamento '. $departamento->Departament_ES .'')->success();
            return redirect()->route('Departamento.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Departamento.edit', $departamento->Slug);
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
            $departamento = Departamento::find($request['id_departamento']);          
            $departamento->Active = 1;
            $departamento->Parent_id= $request['Parent_id'];
            $departamento->save();

            flash('Se ha inactivado con éxito el departamento '. $departamento->Departament_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Departamento.index');
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
            $departamento = Departamento::find($id);
            if($departamento->Puestos->isNotEmpty()){
                throw new Exception('El departamento no se puede inactivar porque tiene puestos asociados.');
            }
            
            $departamento->Active = 0;
            $departamento->Parent_id= null;
            $departamento->save();

            flash('Se ha inactivado con éxito el departamento '. $departamento->Departament_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Departamento.index');
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
            $departamento = Departamento::find($id);
            if($departamento->Puestos->isNotEmpty()){
                throw new Exception('El departamento no se puede eliminar porque tiene puestos asociados a este registro. ');
            }
            
            $departamento->Active = 0;
            $departamento->Slug = "";
            $departamento->Parent_id= null;
            $departamento->save();

            flash('Se ha borrado con éxito el departamento '. $departamento->Departament_ES .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Departamento.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Organigrama_general()
    {
        try{
            $departamentos = Departamento::where('Active', '=', 1)->get();
            return view('Departamento.Organigrama_general')->with('departamentos', $departamentos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
             return redirect()->route('Departamento.index');
        }
        
    }
}
