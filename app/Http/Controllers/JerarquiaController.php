<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Jerarquia; 
use Laracasts\Flash\Flash; 
use Recursos_Humanos\Http\Requests\JerarquiaRequest;
use Exception;
class JerarquiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Jerarquia.create')->only(['create', 'store']);
        $this->middleware('permissions:Jerarquia.edit')->only(['create', 'update']);
        $this->middleware('permissions:Jerarquia.show')->only(['show']);
        $this->middleware('permissions:Jerarquia.index')->only(['index']);
        $this->middleware('permissions:Jerarquia.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jerarquias = Jerarquia::orderBy('Level', 'ASC')->get();
        return view('Jerarquia.index')->with('jerarquias', $jerarquias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Jerarquia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JerarquiaRequest $request)
    {   
        try{
            $jerarquia = new Jerarquia($request->all());
            $jerarquia->active = 1;
            $jerarquia->save();
        
            flash('Se guardo con éxito la jerarquia '. $jerarquia->Name_ES .'')->success();
            return redirect()->route('Jerarquia.create');
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
            $jerarquia = Jerarquia::whereSlug($slug)->firstOrFail();
            return view('Jerarquia.edit')->with('jerarquia', $jerarquia);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Jerarquia.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JerarquiaRequest $request, $id)
    {   
        try{
            $jerarquia = Jerarquia::find($id);
            $jerarquia->fill($request->all());
            
            $jerarquia->save();

            flash('Se editó con éxito el jerarquia '. $jerarquia->Name .'')->success();
            return redirect()->route('Jerarquia.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
             return redirect()->route('Jerarquia.edit', $jerarquia->Slug);
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
            $jerarquia = Jerarquia::find($id);
            if($jerarquia->Puestos->isNotEmpty()){
                throw new Exception('La jerarquia no se puede eliminar porque tiene puestos asociados a este registro. ');
            }
            $jerarquia->delete();

            flash('Se ha borrado con éxito el jerarquia '. $jerarquia->Name .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Jerarquia.index');
    }
}
