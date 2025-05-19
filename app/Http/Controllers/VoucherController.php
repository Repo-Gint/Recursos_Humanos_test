<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\VoucherRequest;
use Recursos_Humanos\Voucher;
use Laracasts\Flash\Flash;
use Exception;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:Voucher.create')->only(['create', 'store']);
        $this->middleware('permissions:Voucher.edit')->only(['create', 'update']);
        $this->middleware('permissions:Voucher.show')->only(['show']);
        $this->middleware('permissions:Voucher.index')->only(['index']);
        $this->middleware('permissions:Voucher.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('Voucher', 'ASC')->get();
        return view('Voucher.index')->with('vouchers', $vouchers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        try{
            $voucher = new Voucher($request->all());
            $voucher->save();
            
            flash('Se guardo con éxito el voucher '. $voucher->Voucher .'')->success();
            return redirect()->route('Voucher.create');
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
            $voucher = Voucher::whereSlug($slug)->firstOrFail();
            return view('Voucher.edit')->with('voucher', $voucher);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Voucher.index');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherRequest $request, $id)
    {
        try{
            $voucher = Voucher::find($id);
            $voucher->fill($request->all());
            
            $voucher->save();

            flash('Se editó con éxito el voucher '. $voucher->Voucher .'')->success();
            return redirect()->route('Voucher.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Voucher.edit', $voucher->Slug);
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
            $voucher = Voucher::find($id);
            if($voucher->Datos != null){
                throw new Exception('El voucher no se puede eliminar porque tiene datos asociados a este registro. ');
            }
            $voucher->delete();

            flash('Se ha borrado con éxito el voucher '. $voucher->Voucher .'')->success();
           
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
          return redirect()->route('Voucher.index');
    }
}
