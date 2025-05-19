<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\Estado_CivilRequest;
use Recursos_Humanos\Estado_Civil;
use Laracasts\Flash\Flash;
use Exception;

class Estado_CivilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Estado_Civil.create')->only(['create', 'store']);
        $this->middleware('permissions:Estado_Civil.edit')->only(['create', 'update']);
        $this->middleware('permissions:Estado_Civil.show')->only(['show']);
        $this->middleware('permissions:Estado_Civil.index')->only(['index']);
        $this->middleware('permissions:Estado_Civil.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado_Civil::orderBy('status', 'ASC')->get();
        return view('Estado_Civil.index')->with('estados', $estados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Estado_Civil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Estado_CivilRequest $request)
    {
        try{
            $request->validate([
                'status' => 'required'
            ]);

            $estado = new Estado_Civil($request->all());
            $estado->save();    
            flash('Se guardo con éxito el estado civil '.$estado->status.'')->success();

        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Estado_Civil.create');
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
            $estado = Estado_Civil::whereSlug($slug)->firstOrFail();
            return view('Estado_Civil.edit')->with('estado', $estado);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Estado_Civil.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Estado_CivilRequest $request, $id)
    {
        try{
            $request->validate([
                'status' => 'required'
            ]);

            $estado = Estado_Civil::find($id);
            $estado->fill($request->all());
            
            $estado->save();

            flash('Se editó con éxito el estado civil '. $estado->status .'')->success();
            return redirect()->route('Estado_Civil.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Estado_Civil.edit', $estado->slug);
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
            $estado = Estado_Civil::find($id);
            if($estado->Datos != null){
                throw new Exception('La estado no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $estado->delete();

            flash('Se ha borrado con éxito el estado '. $estado->status .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Estado_Civil.index');
        
    }
}
