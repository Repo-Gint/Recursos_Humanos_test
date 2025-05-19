<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\VacacionesRequest;
use Recursos_Humanos\Vacacion;
use Recursos_Humanos\Empleado; 
use Carbon\Carbon;

use Exception;

class VacacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Vacaciones.create')->only(['create', 'store']);
        $this->middleware('permissions:Vacaciones.edit')->only(['create', 'update']);
        $this->middleware('permissions:Vacaciones.show')->only(['show']);
        $this->middleware('permissions:Vacaciones.index')->only(['index']);
        $this->middleware('permissions:Vacaciones.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['Paid'] == 0){
            $request->validate([
                        'Start_date'    => 'required|date',
                    'Ending_date'   => 'required|date|after_or_equal:Start_date',
                ]);
        }else{
            $request->validate([
                    'Paid_date'    => 'required|date',
                    'Paid_days'   => 'required|numeric',
                ]);
        }
        try{
            if($request['Paid'] == 0){ //si no son vacaciones pagadas
                
                $historial = Vacacion::where('Employee_id', '=', $request['Employee_id'])->get();

                $inicio = Carbon::parse($request['Start_date'])->diffInWeekdays($request['Ending_date']);
                $dias = $inicio + 1; //Se suma una para que cuando solo se ocupe un dia aparezca
                $dias = dias_menos_dias_festivos($dias, $request['Start_date'], $request['Ending_date']);
                //dd($request['Saldo'] - $dias);

                $errores = Errores_vacaciones($request, $dias, $historial);
                /*Validar_fechas nos permite que no se ingresen fechas repetidas o entre fechas*/
                if($errores == "Ninguno"){

                    $vacacion = new Vacacion();

                    $vacacion->Period = periodo_vacaciones($request['Start_date'], $request['Contratacion']);
                    $vacacion->Start_date = $request['Start_date'];
                    $vacacion->Ending_date = $request['Ending_date'];
                    
                    $vacacion->Days = $dias;
                    $vacacion->Paid = 0;

                    $vacacion->Advanced = vacaciones_adelantadas($request['Saldo'], $request['Contratacion'], $request['Start_date'],$request['Ending_date']); 
                    $vacacion->Employee_id = $request['Employee_id'];
                    $vacacion->save();
                    flash('Se guardo con éxito las vacaciones solicitadas')->success();
                    
                }else{
                    flash($errores)->error();
                    
                }
            }else{
                $vacacion = new Vacacion();
                $historial = Vacacion::where('Employee_id', '=', $request['Employee_id'])->get();
                $errores = Errores_vacaciones($request, $request['Paid_days'], $historial);
                if($errores == "Ninguno"){
                    $vacacion->Period = periodo_vacaciones($request['Paid_date'], $request['Contratacion']);
                    $vacacion->Start_date = $request['Paid_date'];
                    $vacacion->Ending_date = $request['Paid_date'];
                    
                    $vacacion->Days = $request['Paid_days'];
                    $vacacion->Paid = 1;

                    $vacacion->Advanced = 0; 
                    $vacacion->Employee_id = $request['Employee_id'];
                    $vacacion->save();
                    flash('Se guardo con éxito las vacaciones solicitadas')->success();
                }else{
                    flash($errores)->error();
                    
                }
            }
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Empleado.show', $request['Employee_slug']);
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $slug)
    {
        try{
            $vacacion = Vacacion::find($id);
            $vacacion->delete();

            flash('Se ha borrado con éxito el registro.')->success();
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Empleado.show', $slug);
    }
}
