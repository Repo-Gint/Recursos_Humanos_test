<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\BancoRequest;
use Recursos_Humanos\Banco;
use Laracasts\Flash\Flash;
use Exception;

class BancoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Banco.create')->only(['create', 'store']);
        $this->middleware('permissions:Banco.edit')->only(['create', 'update']);
        $this->middleware('permissions:Banco.show')->only(['show']);
        $this->middleware('permissions:Banco.index')->only(['index']);
        $this->middleware('permissions:Banco.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $bancos = Banco::orderBy('Name', 'ASC')->get();
            return view('Banco.index')->with('bancos', $bancos);
        }catch(Exception $e){

        }
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Banco.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BancoRequest $request)
    {
        try{
            $request->validate([
                'Name' => 'required'
            ]);

            $banco = new Banco($request->all());
            $banco->save();
            flash('Se guardo con éxito el banco  '. $banco->Name .'')->success();
            
        }catch(Exception $e){
             return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
        }
        return redirect()->route('Banco.create');
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
            $banco = Banco::whereSlug($slug)->firstOrFail();
            return view('Banco.edit')->with('banco', $banco);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Banco.index');
        }
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BancoRequest $request, $id)
    {
        try{
            $request->validate([
                'Name' => 'required'
            ]);

            $banco = Banco::find($id);
            $banco->fill($request->all());
            
            $banco->save();

            flash('Se editó con éxito el banco '. $banco->Name .'')->success();
            return redirect()->route('Banco.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Banco.edit', $banco->Slug);
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
            $banco = Banco::find($id);
            if($banco->Dato_Bancos != null){
                throw new Exception('El banco no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $banco->delete();

            flash('Se ha borrado con éxito')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Banco.index');
    }
}
