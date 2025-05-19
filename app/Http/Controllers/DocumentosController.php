<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\DocumentoRequest;
use Recursos_Humanos\Documento;
use Recursos_Humanos\Empleado;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Exception;
class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Documento.create')->only(['create', 'store']);
        $this->middleware('permissions:Documento.edit')->only(['create', 'update']);
        $this->middleware('permissions:Documento.show')->only(['show']);
        $this->middleware('permissions:Documento.index')->only(['index']);
        $this->middleware('permissions:Documento.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::get();
        return view('Documento.index')->with('documentos', $documentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = array('Personal' => 'Personal', 'Contratacion'=>'Contratacion');
        $importante = array(1 => 'Si', 0 =>'No');
        return view('Documento.create')->with('tipos', $tipos)->with('importante', $importante);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentoRequest $request)
    {
        try{
            $documento = new Documento($request->all());
            $documento->save();
            //$empleados = Empleado::select('id')->where('Active', '=', 1)->get();
           /* foreach ($empleados as $empleado) {
                $empleado->Documentos()->attach($documento->id, [
                    'Success' => null
                ]);
            }*/
            
            flash('Se guardo con éxito el documento '. $documento->Document .'')->success();
        }catch(Exception $e){
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        
        return redirect()->route('Documento.create');
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
            $documento = Documento::whereSlug($slug)->firstOrFail();
             $tipos = array('Personal' => 'Personal', 'Contratacion'=>'Contratacion');
            $importante = array(1 => 'Si', 0 =>'No');
            return view('Documento.edit')->with('documento', $documento)->with('tipos', $tipos)->with('importante', $importante);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Documentos.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentoRequest $request, $id)
    {
        try{
            $documento = Documento::find($id);
            $documento->fill($request->all());
            
            $documento->save();

            flash('Se editó con éxito el documento '. $documento->Document .'')->success();
            return redirect()->route('Documento.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Documentos.edit', $documento->Slug);
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
             $documento = Documento::find($id);

            //Eliminamos registros con los que tenga relación
            $empleados = Empleado::select('id')->where('Active', '=', 1)->get();
            foreach ($empleados as $empleado) {
                $empleado->Documentos()->detach($documento->id);
            }

            $documento->delete();
            flash('Se ha borrado con éxito el documento '. $documento->Document .'')->success();       
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Documento.index');
    }
}
