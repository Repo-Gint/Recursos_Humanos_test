<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\FamiliarRequest;
use Recursos_Humanos\Familiar;
use Laracasts\Flash\Flash;
use Exception;

class FamiliarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Familiar.create')->only(['create', 'store']);
        $this->middleware('permissions:Familiar.edit')->only(['create', 'update']);
        $this->middleware('permissions:Familiar.show')->only(['show']);
        $this->middleware('permissions:Familiar.index')->only(['index']);
        $this->middleware('permissions:Familiar.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familiares = Familiar::orderBy('relationship', 'ASC')->get();
        return view('Familiar.index')->with('familiares', $familiares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Familiar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamiliarRequest $request)
    {
        try{

            $familiar = new Familiar($request->all());
            $familiar->save();
            

            flash('Se guardo con éxito el parentesco  '. $familiar->relationship .'')->success();
        }catch(Excetion $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        
        return redirect()->route('Familiar.create');
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
            $familiar = Familiar::whereSlug($slug)->firstOrFail();
            return view('Familiar.edit')->with('familiar', $familiar);
        }catch(Excetion $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Familiar.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FamiliarRequest $request, $id)
    {
        try{

            $familiar = Familiar::find($id);
            $familiar->fill($request->all());
            
            $familiar->save();

            flash('Se editó con éxito el parentesco '. $familiar->relationship .'')->success();
            return redirect()->route('Familiar.index');
        }catch(Excetion $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Familiar.edit', $familiar->slug);
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
            $familiar = Familiar::find($id);
            if($familiar->Contacto != null){
                throw new Exception('El parentesco no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $familiar->delete();

            flash('Se ha borrado con éxito el estado '. $familiar->status .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Familiar.index');
    }
}
