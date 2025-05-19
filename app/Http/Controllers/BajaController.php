<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\BajaRequest;
use Recursos_Humanos\Baja;
use Laracasts\Flash\Flash;
use Exception;

class BajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Baja.create')->only(['create', 'store']);
        $this->middleware('permissions:Baja.edit')->only(['create', 'update']);
        $this->middleware('permissions:Baja.show')->only(['show']);
        $this->middleware('permissions:Baja.index')->only(['index']);
        $this->middleware('permissions:Baja.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try{
            $bajas = Baja::orderBy('Type', 'ASC')->get();
            return view('Baja.index')->with('bajas', $bajas);
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
        return view('Baja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BajaRequest $request)
    {
        try{
            $request->validate([
                'Type' => 'required'
            ]);
            
            $baja = new Baja($request->all());
            $baja->save();
            flash('Se guardo con éxito el tipo de baja '. $baja->Type .'')->success();

        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Baja.create');
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
            $baja = Baja::whereSlug($slug)->firstOrFail();
            return view('Baja.edit')->with('baja', $baja);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Baja.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BajaRequest $request, $id)
    {
        try{
            $request->validate([
            'Type' => 'required'
            ]);
            $baja = Baja::find($id);
            $baja->fill($request->all());
            
            $baja->save();

            flash('Se editó con éxito el tipo de baja '. $baja->Type .'')->success();
            return redirect()->route('Baja.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Baja.edit', $baja->Slug);
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
            $baja = Baja::find($id);
            if($baja->Empleados->isNotEmpty()){
                throw new Exception('El tipo de baja no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $baja->delete();

            flash('Se ha borrado con éxito')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Baja.index');
        
    }
}
