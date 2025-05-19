<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\Dias_FestivosRequest;
use Recursos_Humanos\Dias_Festivos; 
use Laracasts\Flash\Flash; 
use Exception;
use Redirect;

class Dias_FestivosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Dias_Festivos.create')->only(['create', 'store']);
        $this->middleware('permissions:Dias_Festivos.edit')->only(['create', 'update']);
        $this->middleware('permissions:Dias_Festivos.index')->only(['index']);
        $this->middleware('permissions:Dias_Festivos.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dias = Dias_Festivos::orderBy('Month', 'ASC')->get();
        return view('Dias_Festivos.index')->with('dias', $dias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meses = array( 1 => "Enero" , 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
        return view('Dias_Festivos.create')->with('meses', $meses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Dias_FestivosRequest $request)
    {
        try{
            if(!validar_dia($request['Month'], $request['Day'])){
                throw new Exception('El dia no existe dentro del mes.');
            }
            if(!validar_dia_existente($request['Month'], $request['Day'])){
                throw new Exception('El dia '.$request['Day'].' del mes '.mes_espanol($request['Month']).' ya se encuentra registrado.');
            }
            $dia = new Dias_Festivos($request->all());
            $dia->save();
            
            flash('Se guardo con éxito el dia')->success();
            
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Dias_Festivos.create');
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
            $dia = Dias_Festivos::whereSlug($slug)->firstOrFail();
            $meses = array( 1 => "Enero" , 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
            return view('Dias_Festivos.edit')->with('dia', $dia)->with('meses', $meses);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Dias_Festivos.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{    
            $dia = Dias_Festivos::find($id);
            if(!validar_dia($request['Month'], $request['Day'])){
                throw new Exception('El dia no existe dentro del mes.');
            }
            if(!validar_dia_existente($request['Month'], $request['Day'])){
                throw new Exception('El dia '.$request['Day'].' del mes '.mes_espanol($request['Month']).' ya se encuentra registrado.');
            }
            $dia->fill($request->all());
            $dia->save();

            flash('Se editó con éxito el dia')->success();
            return redirect()->route('Dias_Festivos.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Dias_Festivos.edit', $dia->Slug);
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
            $dia = Dias_Festivos::find($id);
            $dia->delete();

            flash('Se ha borrado con éxito el dia ')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }    

        
        return redirect()->route('Dias_Festivos.index');
    }
}
