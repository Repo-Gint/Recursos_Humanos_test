<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Tipo_empleado;
use Laracasts\Flash\Flash; 
use Recursos_Humanos\Http\Requests\TipoempleadoRequest;
use Exception;
class TipoempleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Tipoempleado.create')->only(['create', 'store']);
        $this->middleware('permissions:Tipoempleado.edit')->only(['create', 'update']);
        $this->middleware('permissions:Tipoempleado.show')->only(['show']);
        $this->middleware('permissions:Tipoempleado.index')->only(['index']);
        $this->middleware('permissions:Tipoempleado.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo_empleado::orderBy('Type', 'ASC')->paginate(5);
        return view('Tipoempleado.index')->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Tipoempleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoempleadoRequest $request)
    {
        try{
            $tipo = new Tipo_empleado($request->all());
            $tipo->save();
            
            flash('Se guardo con éxito el tipo de empleado '. $tipo->Type .'')->success();
            return redirect()->route('Tipoempleado.create');
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
            $tipo = Tipo_empleado::whereSlug($slug)->firstOrFail();
            return view('Tipoempleado.edit')->with('tipo', $tipo);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Tipoempleado.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoempleadoRequest $request, $id)
    {
        try{
            $tipo = Tipo_empleado::find($id);
            $tipo->fill($request->all());
            
            $tipo->save();

            flash('Se editó con éxito el tipo de empleado '. $tipo->Type .'')->success();
            return redirect()->route('Tipoempleado.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Tipoempleado.edit', $tipo->Slug);
        }

        
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
            $tipo = Tipo_empleado::find($id);
            if(($tipo->Empleados->isNotEmpty()) && ($tipo->Empleados_historial->isNotEmpty())){
                throw new Exception('El tipo de empleado no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $tipo->delete();

            flash('Se ha borrado con éxito el tipo de empleado '. $tipo->Tipo .'')->success();
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Tipoempleado.index');
    }
}
