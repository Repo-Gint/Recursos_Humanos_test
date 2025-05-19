<?php

namespace Recursos_Humanos\Http\Controllers;


use Recursos_Humanos\Pais; //llama al modelo
use Laracasts\Flash\Flash; //mensajes de advertencia
use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\PaisRequest;
use Exception;
class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Pais.create')->only(['create', 'store']);
        $this->middleware('permissions:Pais.edit')->only(['create', 'update']);
        $this->middleware('permissions:Pais.show')->only(['show']);
        $this->middleware('permissions:Pais.index')->only(['index']);
        $this->middleware('permissions:Pais.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::orderBy('Country', 'ASC')->get();
        return view('Pais.index')->with('paises', $paises);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaisRequest $request)
    {   
        try{
            if($request->hasFile('Flag')){
                $file = $request->file('Flag');
                $name = $request['Country'].'_'.time().'.'.$file->getClientOriginalExtension();   
                $file->move(public_path().'/images/banderas/', $name);
            }
            $pais = new Pais();
            $pais->Country = $request['Country'];
            $pais->Flag = $name;
            $pais->save();
            
            flash('Se guardo con éxito el pais '. $pais->Country .'')->success();
            return redirect()->route('Pais.create');
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
            $pais = Pais::whereSlug($slug)->firstOrFail();
            return view('Pais.edit')->with('pais', $pais);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Pais.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaisRequest $request, $id)
    {   
        try{
            $pais = Pais::find($id);
        
            if($request->hasFile('Flag')){
                $file = $request->file('Flag');
                $name = $request['Country'].'_'.time().'.'.$file->getClientOriginalExtension();   
                $file->move(public_path().'/images/banderas/', $name);

                $pais->Country = $request['Country'];
                $pais->Flag = $name;
            
                $pais->save();
            }else{
                $pais->Country = $request['Country'];
                $pais->save();
            }
            flash('Se editó con éxito el pais '. $pais->Country.'')->success();
            return redirect()->route('Pais.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Pais.edit', $pais->Slug);
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
            $pais = Pais::find($id);
            if(($pais->Empresas->isNotEmpty()) && ($pais->Dato->isNotEmpty()) && ($pais->Domicilio->isNotEmpty())){
                throw new Exception('El pais no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $pais->delete();
            flash('Se ha borrado con éxito el pais '. $pais->Country .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Pais.index');
        
    }
}
