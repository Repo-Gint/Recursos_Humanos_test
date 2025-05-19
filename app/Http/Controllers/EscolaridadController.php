<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\EscolaridadRequest;
use Recursos_Humanos\Escolaridad;
use Laracasts\Flash\Flash;
use Exception;

class EscolaridadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Escolaridad.create')->only(['create', 'store']);
        $this->middleware('permissions:Escolaridad.edit')->only(['create', 'update']);
        $this->middleware('permissions:Escolaridad.show')->only(['show']);
        $this->middleware('permissions:Escolaridad.index')->only(['index']);
        $this->middleware('permissions:Escolaridad.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escolaridades = Escolaridad::orderBy('Scholarship', 'ASC')->get();
        return view('Escolaridad.index')->with('escolaridades', $escolaridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Escolaridad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscolaridadRequest $request)
    {
        try{
            $escolaridad = new Escolaridad($request->all());
            $escolaridad->save();
            
            flash('Se guardo con éxito el escolaridad '. $escolaridad->Scholarship .'')->success();
            
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Escolaridad.create');
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
            $escolaridad = Escolaridad::whereSlug($slug)->firstOrFail();
            return view('Escolaridad.edit')->with('escolaridad', $escolaridad);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Escolaridad.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EscolaridadRequest $request, $id)
    {
        try{
            $escolaridad = Escolaridad::find($id);
            $escolaridad->fill($request->all());
             if($escolaridad->Datos){
                throw new Exception('La escolaridad no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $escolaridad->save();

            flash('Se editó con éxito el escolaridad '. $escolaridad->Scholarship .'')->success();
            return redirect()->route('Escolaridad.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Escolaridad.edit', $escolaridad->Slug);
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
            $escolaridad = Escolaridad::find($id);
             if($escolaridad->Datos != null){
                throw new Exception('El registro no se puede eliminar porque tiene datos asociados a este. ');
            }
            $escolaridad->delete();
            flash('Se ha borrado con éxito el escolaridad '. $escolaridad->Scholarship .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Escolaridad.index');
    }
}
