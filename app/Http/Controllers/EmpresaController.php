<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Empresa; //llama al modelo
use Laracasts\Flash\Flash; //mensajes de advertencia
use Recursos_Humanos\Pais;
use Recursos_Humanos\Http\Requests\EmpresaRequest;
use Exception;
class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Empresa.create')->only(['create', 'store']);
        $this->middleware('permissions:Empresa.edit')->only(['create', 'update']);
        $this->middleware('permissions:Empresa.show')->only(['show']);
        $this->middleware('permissions:Empresa.index')->only(['index']);
        $this->middleware('permissions:Empresa.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresas = Empresa::orderBy('Name', 'ASC')
        ->select('Acronym','Name','Address','State','Municipality','Tows','Phone','companies.Slug As Company_slug','Country','Country_id','companies.id As Company_id')
        ->join('countries', 'companies.Country_id','=','countries.id')
        ->get();
        return view('Empresa.index')->with('empresas', $empresas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::orderBy('Country', 'ASC')->pluck('Country', 'id'); //pasa los registros que se tiene en la tabla paises
        return view('Empresa.create')->with('paises', $paises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {   
        try{
            $empresa = new Empresa($request->all());
            $empresa->save();
            
            flash('Se guardo con éxito la empresa '. $empresa->Name .'')->success();       
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }

        return redirect()->route('Empresa.create');
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
            $paises = Pais::orderBy('Country', 'ASC')->pluck('Country', 'id');
            $empresa = Empresa::whereSlug($slug)->firstOrFail();
            return view('Empresa.edit')->with('empresa', $empresa)->with('paises', $paises);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empresa.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, $id)
    {   
        try{
            $empresa = Empresa::find($id);
            $empresa->fill($request->all());
            
            $empresa->save();

            flash('Se editó con éxito el empresa '. $empresa->Name .'')->success();
            return redirect()->route('Empresa.index');
        }catch(Exception $e){
             flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empresa.edit', $empresa->slug);
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
            $empresa = Empresa::find($id);
            if($empresa->Empleados->isNotEmpty()){
                throw new Exception('La empresa no se puede eliminar porque tiene empleados asociados a este registro. ');
            }
            $empresa->delete();

            flash('Se ha borrado con éxito el empresa '. $empresa->Name .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Empresa.index');
    }
}
