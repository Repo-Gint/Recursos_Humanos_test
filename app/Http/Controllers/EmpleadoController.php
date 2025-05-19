<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Mail;
use Exception;
use Redirect;
use Carbon\Carbon;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Intervention\Image\ImageManager;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;

use Recursos_Humanos\Empleado; //llama al modelo
use Recursos_Humanos\Pais;
use Recursos_Humanos\Departamento;
use Recursos_Humanos\Tipo_empleado;
use Recursos_Humanos\Empresa;
use Recursos_Humanos\Puesto;
use Recursos_Humanos\Contacto;
use Recursos_Humanos\Contratacion;
use Recursos_Humanos\Vacacion;
use Recursos_Humanos\Acceso;
use Recursos_Humanos\User;
use Recursos_Humanos\Escolaridad;
use Recursos_Humanos\Datos;
use Recursos_Humanos\Banco;
use Recursos_Humanos\Dato_Banco;
use Recursos_Humanos\Voucher;
use Recursos_Humanos\Domicilio;
use Recursos_Humanos\Tipo_contrato;
use Recursos_Humanos\Documento;
use Recursos_Humanos\Anexo;
use Recursos_Humanos\Baja;
use Recursos_Humanos\Estado_Civil;
use Recursos_Humanos\Familiar;


use Recursos_Humanos\Http\Requests\EmpleadoRequest;
use Recursos_Humanos\Http\Requests\RolesEmpleadoRequest;
use Recursos_Humanos\Exports\EmpleadoExport;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Empleado.create')->only(['create', 'store']);
        $this->middleware('permissions:Empleado.edit')->only(['edit', 'update']);
        $this->middleware('permissions:Empleado.show')->only(['show']);
        $this->middleware('permissions:Empleado.index')->only(['index']);
        $this->middleware('permissions:Empleado.destroy')->only(['destroy']);

        $this->middleware('permissions:Empleado.baja_empleado')->only(['baja_empleado']);
        $this->middleware('permissions:Empleado.bajas_empleados')->only(['bajas_empleados']);
        $this->middleware('permissions:Empleado.información_del_empleado_baja')->only(['información_del_empleado_baja']);
        $this->middleware('permissions:Empleado.contratar')->only(['contratar']);
        $this->middleware('permissions:Empleado.asignar')->only(['asignar']);
        $this->middleware('permissions:Empleado.roles')->only(['roles']);
        $this->middleware('permissions:Empleado.documentacion')->only(['documentacion']);
        $this->middleware('permissions:Empleado.edicion_documentacion')->only(['edicion_documentacion']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::where("employees.Active","=", 1)
        ->select('employees.Code AS Employee_Code', 'Names', 'Paternal', 'Maternal', 'Position_ES', 'Departament_ES','employees.Slug AS Employee_Slug', 'Photo','employees.id')
        ->join('employee_position','employees.id', '=', 'employee_position.Employee_id')
        ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
        ->join('departaments', 'positions.Departament_id', '=', 'departaments.id')
        ->orderBy('Employee_Code', 'ASC')->get();
        
        return view('Empleado.index')->with('empleados', $empleados);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function bajas_empleados()
    {
        $empleados = Empleado::where("employees.Active","=", 0)
        ->select('employees.Code AS Employee_Code', 'employees.id','Names', 'Paternal', 'Maternal', 'Position_ES', 'Departament_ES','employees.Slug AS Employee_Slug', 'Photo')
        ->join('employee_position_history','employees.id', '=', 'employee_position_history.Employee_id')
        ->join('positions', 'employee_position_history.Position_id', '=', 'positions.id')
        ->join('departaments', 'positions.Departament_id', '=', 'departaments.id')
        ->orderBy('Employee_Code', 'ASC')->get();

        return view('Empleado.bajas_empleados')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        $departamentos = Departamento::where('Active', '=', 1)
        ->orderBy('Departament_ES', 'ASC')
        ->pluck('Departament_ES', 'id'); 

        $paises = Pais::orderBy('Country', 'ASC')->pluck('Country', 'id'); 
        $empresas = Empresa::orderBy('Name', 'ASC')->pluck('Name', 'id'); 
        $tipos = Tipo_empleado::orderBy('Type', 'ASC')->pluck('Type', 'id'); 
        $estudios = Escolaridad::orderBy('Scholarship', 'ASC')->pluck('Scholarship', 'id');
        $vouchers = Voucher::orderBy('Voucher', 'ASC')->pluck('Voucher', 'id');
        $contratos = Tipo_contrato::orderBy('Type', 'ASC')->pluck('Type', 'id');
        $estados = Estado_Civil::orderBy('status', 'ASC')->pluck('status', 'id');
        $bancos = Banco::orderBy('Name', 'ASC')->pluck('Name', 'id');
        $parentescos = Familiar::orderBy('relationship', 'ASC')->pluck('relationship', 'id');
        $generos = array('Hombre' => 'Hombre', 'Mujer'=> 'Mujer');

        return view('Empleado.create')
        ->with('departamentos', $departamentos)
        ->with('paises', $paises)
        ->with('empresas', $empresas) 
        ->with('tipos', $tipos)
        ->with('estudios', $estudios)
        ->with('vouchers', $vouchers)
        ->with('contratos', $contratos)
        ->with('estados', $estados)
        ->with('parentescos', $parentescos)
        ->with('bancos', $bancos)
        ->with('generos', $generos);
        
    }

    /**
     * obtenercodigo llama al modelo empleado para obtener los registros solicitados
     *
     */
    public static function obtener_codigo_empleado(Request $request, $id)
    {
        $codigo = Empleado::get_codigo_empleado($id);
        return response()->json($codigo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {    
        try{
            $empleado = new Empleado();

            if($request->hasFile('Photo')){
                $intervention = new ImageManager(array('driver' => 'imagick'));
                $file = $request->file('Photo');
                $name = $request['Names'].'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                $img = \Image::make($request->file('Photo'))->resize(440, 575)->save('images/Fotografias/'.$name);
                $empleado->Photo = $name;     
            }else{
                if($request['Gender'] == 'Hombre'){
                    $name = "man.jpg";
                    $empleado->Photo = $name;
                }else{
                    $name = "woman.jpg";
                    $empleado->Photo = $name;
                }    
            }
            $empleado->Code = $request['Code']; 
            $empleado->Names = $request['Names'];
            $empleado->Paternal = $request['Paternal'];
            $empleado->Maternal = $request['Maternal'];
            $empleado->Active = 1;
            $empleado->Parent_id = $request['Parent_id'];
            $empleado->Output_id = null;
            $empleado->Company_id = $request['Company_id'];
            $empleado->save();
            

            $empleado->Tipo_empleado_historial()->attach($request['Typeemployee_id'], [
                'Start_date' => $request['High_date'],
                'Ending_date' => Null
            ]);

            $empleado->Tipo_empleado()->attach($request['Typeemployee_id']);

            $empleado->Puestos_historial()->attach($request['Position_id'], [
                'Start_date' => $request['High_date'],
                'Ending_date' => Null
            ]);   
            $empleado->Puesto()->attach($request['Position_id']);  

            $datos = new Datos();
            $datos->Gender = $request['Gender'];
            $datos->Birthdate = $request['Birthdate'];
            $datos->Nss = $request['Nss'];
            $datos->Rfc = $request['Rfc'];
            $datos->Curp = $request['Curp'];
            $datos->Credential = $request['Credential'];
            $datos->Blood = $request['Blood'];
            $datos->Allergy = $request['Allergy'];
            $datos->Marital_status_id = $request['Marital_status_id'];
            $datos->Children = $request['Children'];
            $datos->Infonavit = $request['Infonavit'];
            $datos->Fonacot = $request['Fonacot'];
            $datos->Scholarchip_id = $request['Scholarchip_id'];
            $datos->Voucher_id = $request['Voucher_id'];
            $datos->Tows = $request['Tows'];
            $datos->Municipality = $request['Municipality'];
            $datos->State = $request['State'];
            $datos->Country_id = $request['Country_id'];
            $datos->Empleado()->associate($empleado);
            $datos->save();

            $domicilio = new Domicilio();
            $domicilio->Address = $request['Address'];
            $domicilio->Postcode = $request['Postcode'];
            $domicilio->Tows = $request['Tows_D'];
            $domicilio->Municipality = $request['Municipality_D'];
            $domicilio->State = $request['State_D'];
            $domicilio->Country_id = $request['Country_id_D'];
            $domicilio->Empleado()->associate($empleado);
            $domicilio->save();


            $contacto = new Contacto();
            $contacto->Personal_mail = $request['Personal_mail'];
            $contacto->Personal_phone = $request['Personal_phone'];
            $contacto->Landline = $request['Landline'];
            $contacto->Family = $request['Family'];
            $contacto->Relationship_id = $request['Relationship_id'];
            $contacto->Emergency_phone = $request['Emergency_phone'];
            $contacto->Empleado()->associate($empleado);
            $contacto->save();

            $contrato = new Contratacion();
            $contrato->High_date = $request['High_date'];
            $contrato->Low_date = null;
           
            if($request['Typecontract_id'] == 1){  //Si tipo de contrato es indefinido
                $contrato->Duration = null;
                $contrato->Ending = null;
            }else{ //si no es, se coloca dias de duración de su periodo de prueba apartir del dia de contratación
                $fin = strtotime("+ ".$request['Duration']." days", strtotime($request['High_date']));
                $fin = date("Y-m-d", $fin);
                $contrato->Duration = $request['Duration'];
                $contrato->Ending = $fin;
            }

            $contrato->Typecontract_id = $request['Typecontract_id'];
            $contrato->Empleado()->associate($empleado);
            $contrato->save();

            $banco = new Dato_Banco();
            $banco->Bank_id = $request['Bank_id'];
            $banco->Count = $request['Count'];
            $banco->Clabe_bank = $request['Clabe_bank'];
            $banco->Empleado()->associate($empleado);
            $banco->save();

            $user = new User();
            $user->name = crear_usuario($request['Names'], $request['Paternal'], $request['Maternal']);
            if(empty($request['Business_mail'])){
                $user->email = $request['Personal_mail'];
            }else{
                $user->email = $request['Business_mail'];
            }
            
            $user->password= crear_password($request['Names'], $request['Paternal'], $request['Maternal'], $request['Birthdate'], true);
            $user->Empleado()->associate($empleado);
            $user->save();

            $user->roles()->sync(2);
            empleados_a_cargo($empleado, 'Asignar');

            //Envio de Notificación de un nuevo registro
            Mail::send('Emails.nuevo_empleado', [
                'Names' => $request['Names'],
                'Paternal' => $request['Paternal'],
                'Maternal' => $request['Maternal'],
                'Birthdate' => $request['Birthdate'],
                'User' => crear_usuario($request['Names'], $request['Paternal'], $request['Maternal']),
                'Password' => crear_password($request['Names'], $request['Paternal'], $request['Maternal'], $request['Birthdate'], false),
            ], function($msj){
                $msj->subject('Nuevo empleado - Sistema de Recursos Humanos');
                $msj->to('Samuel.Lechuga@grupointerconsult.com');
            });

            /*Funciones para el registro de usuario en intranet*/
            agregar_usuario($user, $empleado->id);
            /*Funciones para el registro de usuario en intranet (Fin)*/

            /*Funciones para el registro de usuario en mantenimiento*/
            agregar_usuario_mantenimiento($user, $empleado->id);
            /*Funciones para el registro de usuario en mantenimiento (Fin)*/

            flash('Se guardo con éxito el empleado '. $empleado->Names.' '. $empleado->Paternal .' ' . $empleado->Maternal)->success();      
        }catch(Exception $e){
            $empleado->delete();
            return Redirect::back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
            

        }
        return redirect()->route('Empleado.create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Code)
    {
        try{
            $empleado = Empleado::whereCode($Code)->firstOrFail();

            $departamentos = Departamento::orderBy('Departament_ES', 'ASC')->pluck('Departament_ES', 'id'); 
            $puestos = Puesto::orderBy('Position_ES', 'ASC')->pluck('Position_ES', 'id'); 
            $tipos = Tipo_empleado::orderBy('Type', 'ASC')->pluck('Type', 'id');
            $contratos = Tipo_contrato::orderBy('Type', 'ASC')->pluck('Type', 'id');
            $documentos = Documento::get();
            $contratacion = $empleado->Contrataciones->last();
            $coleccion = $empleado->Vacaciones()->orderBy('Start_date', 'Des')->get();
            $contacto = $empleado->Contactos;
            $tipo = $empleado->Tipo_empleado->last();
            $temp = $empleado->Puesto->last();
			$Code = $empleado->Code;
			$max = Empleado ::where ('Active','=',1)->whereNotIn ('Code',[0])->max('Code');
			$min = Empleado ::where ('Active','=',1)->whereNotIn ('Code',[0])->min('Code');
			
			$after = Empleado::where('Code','>',$Code)
			->where ('Active','=',1)
			->whereNotIn ('Code',[0])
			->orderBy('Code','ASC')
			->limit(1)
			->first();
			
			$back = Empleado::where('Code','<',$Code)
			->where ('Active','=',1)
			->whereNotIn ('Code',[0])
			->orderBy('Code','DESC')
			->limit(1)
			->first();
			
			
			  $empleados = Empleado::where("employees.Active","=", 0)
        ->select('employees.Code AS Employee_Code', 'employees.id','Names', 'Paternal', 'Maternal', 'Position_ES', 'Departament_ES','employees.Slug AS Employee_Slug', 'Photo')
        ->join('employee_position_history','employees.id', '=', 'employee_position_history.Employee_id')
        ->join('positions', 'employee_position_history.Position_id', '=', 'positions.id')
        ->join('departaments', 'positions.Departament_id', '=', 'departaments.id')
        ->orderBy('Employee_Code', 'ASC')->get();
			
			
			
			
            if($temp == NULL){
                $puesto_actual = $empleado->Puestos_historial->last();
                $puesto_historial = $empleado->Puestos_historial;
                $departamento = $puesto_actual->Departamento;
            }else{
                $puesto_actual = $empleado->Puesto->last();
                $puesto_historial = $empleado->Puestos_historial;
                $departamento = $puesto_actual->Departamento;
            }
            $datos = $empleado->Datos;
            $domicilio = $empleado->Domicilio;
            $banco = $empleado->Dato_Bancos;

            $roles = Role::get();

            return view('Empleado.show')
            ->with('empleado', $empleado)
            ->with('coleccion', $coleccion)
            ->with('contacto', $contacto)
            ->with('contratacion', $contratacion)
            ->with('tipo', $tipo)
            ->with('departamento', $departamento)
            ->with('puesto_actual', $puesto_actual)
            ->with('puesto_historial', $puesto_historial)
            ->with('roles', $roles)
            ->with('datos', $datos)
            ->with('domicilio', $domicilio)
            ->with('banco', $banco)
            ->with('documentos', $documentos)
            ->with('departamentos', $departamentos)
            ->with('puestos', $puestos)
            ->with('tipos', $tipos)
            ->with('contratos', $contratos)
			->with('after', $after)
			->with('back', $back)
			->with('max', $max)
			->with('min', $min);
        }catch(Exception $e){
            return redirect()->route('Empleado.index');
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function información_del_empleado_baja($slug)
    {
        try{
            $empleado = Empleado::whereSlug($slug)->firstOrFail();
        
            $coleccion = $empleado->Vacaciones()->orderBy('Start_date', 'Des')->paginate(15);
            $contacto = $empleado->Contactos;
            $contratacion = $empleado->Contrataciones->last();
            $tipo = $empleado->Tipo_empleado_historial->last();
            $puesto = $empleado->Puestos_historial->last();
            $departamento = $puesto->Departamento;
            $datos = $empleado->Datos;
            $domicilio = $empleado->Domicilio;
            $banco = $empleado->Dato_Bancos;

            return view('Empleado.información_del_empleado_baja')
            ->with('empleado', $empleado)
            ->with('coleccion', $coleccion)
            ->with('contacto', $contacto)
            ->with('contratacion', $contratacion)
            ->with('tipo', $tipo)
            ->with('puesto', $puesto)
            ->with('departamento', $departamento)
            ->with('datos', $datos)
            ->with('domicilio', $domicilio)
            ->with('banco', $banco);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.index');
            
        }
        
    
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
            $empleado = Empleado::whereSlug($slug)->firstOrFail(); 
            $bajas = Baja::orderBy('Type', 'ASC')->pluck('Type', 'id');
            

            $departamentos = Departamento::where('Active', '=', 1)
            ->orderBy('Departament_ES', 'ASC')
            ->pluck('Departament_ES', 'id'); 

            $puesto = $empleado->Puesto->last();
            
            $puestos = Puesto::select(DB::raw('CONCAT(Code," - ",Position_ES) AS Position_ES'), 'id')
            ->where('Active', '=', 1)
            ->where('Departament_id', '=', $puesto->Departament_id)
            ->orderBy('Position_ES', 'ASC')
            ->pluck('Position_ES', 'id');

            $departamento = $puesto->Departamento;
            //dd($departamento);
            $departamento_superior = $departamento->Parent_id;

            $empleados = Empleado::select(DB::raw('CONCAT(Names," ",Paternal," ",Maternal) AS Names'), 'employees.id')
            ->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
            ->join('positions', 'employee_position.Position_id', '=', 'positions.id')
            ->where('employees.id','<>', $empleado->id)
            ->where('positions.Departament_id', $departamento->id)
            ->orWhere('positions.Departament_id', $departamento_superior)
            ->where('employees.Active', '=', 1)
            ->orderBy('employees.Names', 'ASC')
            ->pluck('employees.Names', 'employees.id');

            $paises = Pais::orderBy('Country', 'ASC')->pluck('Country', 'id'); 
            $empresas = Empresa::orderBy('Name', 'ASC')->pluck('Name', 'id'); 
            $tipos = Tipo_empleado::orderBy('Type', 'ASC')->pluck('Type', 'id'); 
            $estudios = Escolaridad::orderBy('Scholarship', 'ASC')->pluck('Scholarship', 'id');
            $vouchers = Voucher::orderBy('Voucher', 'ASC')->pluck('Voucher', 'id');
            $contratos = Tipo_contrato::orderBy('Type', 'ASC')->pluck('Type', 'id');
            $estados = Estado_Civil::orderBy('status', 'ASC')->pluck('status', 'id');
            $bancos = Banco::orderBy('Name', 'ASC')->pluck('Name', 'id');
            $dato_bancos = Dato_Banco::where('Employee_id', $empleado->id)->first();
            $parentescos = Familiar::orderBy('relationship', 'ASC')->pluck('relationship', 'id');
            $generos = array('Hombre' => 'Hombre', 'Mujer'=> 'Mujer');

            return view('Empleado.edit')
            ->with('empleado', $empleado)
            ->with('empleados', $empleados)
            ->with('puestos', $puestos)
            ->with('departamentos', $departamentos)
            ->with('paises', $paises)
            ->with('empresas', $empresas) 
            ->with('tipos', $tipos)
            ->with('estudios', $estudios)
            ->with('vouchers', $vouchers)
            ->with('contratos', $contratos)
            ->with('estados', $estados)
            ->with('parentescos', $parentescos)
            ->with('bancos', $bancos)
            ->with('dato_bancos', $dato_bancos)
            ->with('generos', $generos)
            ->with('bajas', $bajas);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.index');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {   
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();

            $puesto = $empleado->Puesto->last();
            $tipo = $empleado->tipo_empleado->last();
            
            if($request->hasFile('Photo')){
                $intervention = new ImageManager(array('driver' => 'imagick'));
                $file = $request->file('Photo');
                $name = $request['Names'].'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                $img = \Image::make($request->file('Photo'))->resize(440, 575)->save('images/Fotografias/'.$name);

                if($empleado->Photo != 'man.jpg' && $empleado->Photo != 'woman.jpg'){
                    \File::delete(public_path('/images/Fotografias/'.$empleado->Photo));
                    $empleado->Photo = $name;
                }else{
                    $empleado->Photo = $name;
                }
                
            }

            $empleado->Code = $request['Code'];
            $empleado->Names = $request['Names'];
            $empleado->Paternal = $request['Paternal'];
            $empleado->Maternal = $request['Maternal'];
            $empleado->Parent_id = $request['Parent_id'];
            $empleado->Company_id = $request['Company_id'];
            $empleado->updated_at = date('Y-m-d H:i:s');
            $empleado->save();    

            DB::table('employee_typeemployee')->where('Employee_id', $empleado->id)->update(['Typeemployee_id' => $request['Typeemployee_id']]);

            DB::table('employee_typeemployee_history')->where('Employee_id', $empleado->id)->update(['Typeemployee_id' => $request['Typeemployee_id']]);

            DB::table('employee_position_history')->where('Employee_id', $empleado->id)->update(['Position_id' => $request['Position_id']]);

            DB::table('employee_position')->where('Employee_id', $empleado->id)->update(['Position_id' => $request['Position_id']]);

            $datos = Datos::where('Employee_id', '=', $id)->firstOrFail();
            $datos->Gender = $request['Gender'];
            $datos->Birthdate = $request['Birthdate'];
            $datos->Nss = $request['Nss'];
            $datos->Rfc = $request['Rfc'];
            $datos->Curp = $request['Curp'];
            $datos->Credential = $request['Credential'];
            $datos->Blood = $request['Blood'];
            $datos->Allergy = $request['Allergy'];
            $datos->Marital_status_id = $request['Marital_status_id'];
            $datos->Children = $request['Children'];
            $datos->Infonavit = $request['Infonavit'];
            $datos->Fonacot = $request['Fonacot'];
            $datos->Scholarchip_id = $request['Scholarchip_id'];
            $datos->Voucher_id = $request['Voucher_id'];
            $datos->Tows = $request['Tows'];
            $datos->Municipality = $request['Municipality'];
            $datos->State = $request['State'];
            $datos->Country_id = $request['Country_id'];
            $datos->save();

            $domicilio = Domicilio::where('Employee_id', '=', $id)->firstOrFail();
            $domicilio->Address = $request['Address'];
            $domicilio->Postcode = $request['Postcode'];
            $domicilio->Tows = $request['Tows_D'];
            $domicilio->Municipality = $request['Municipality_D'];
            $domicilio->State = $request['State_D'];
            $domicilio->Country_id = $request['Country_id_D'];
            $domicilio->save();


            $contacto = Contacto::where('Employee_id', '=', $id)->firstOrFail();
            $contacto->Personal_mail = $request['Personal_mail'];
            $contacto->Personal_phone = $request['Personal_phone'];
            $contacto->Landline = $request['Landline'];
            $contacto->Family = $request['Family'];
            $contacto->Relationship_id = $request['Relationship_id'];
            $contacto->Emergency_phone = $request['Emergency_phone'];
            $contacto->save();

            $contrato = Contratacion::where('Employee_id', '=', $id)->latest('id')->first();
            $contrato->High_date = $request['High_date'];
            $contrato->Low_date = null;
            $contrato->Duration = $request['Duration'];

            if($request['Typecontract_id'] == 1){
                $contrato->Ending = null;
            }else{
                $fin = strtotime("+ ".$request['Duration']." days", strtotime($request['High_date']));
                $fin = date("Y-m-d", $fin);
                $contrato->Ending = $fin;
            }
            
            $contrato->Typecontract_id = $request['Typecontract_id'];
            $contrato->save();

            $banco = Dato_Banco::where('Employee_id', '=', $id)->firstOrFail();
            $banco->Bank_id = $request['Bank_id'];
            $banco->Count = $request['Count'];
            $banco->Clabe_bank = $request['Clabe_bank'];
            $banco->save();

            flash('Se editó con éxito el empleado '. $empleado->Names .'')->success();
            return redirect()->route('Empleado.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.edit', $empleado->Slug);
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
            $empleado = Empleado::find($id);
            $empleado->delete();

            flash('Se dio de baja con éxito el empleado '. $empleado->Names .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Empleado.index');
    }

    public function roles (RolesEmpleadoRequest $request, $id){
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
        
            $contacto = Contacto::where('Employee_id', '=', $id)->firstOrFail();
            $contacto->Business_mail =$request['Business_mail'];
            $contacto->Business_phone = $request['Business_phone'];
            $contacto->Extension = $request['Extension'];
            $contacto->save();

            $user = User::where('Employee_id', '=', $id)->firstOrFail();;
            $user->name = $request['name'];
            if(!empty($request['password'])){
                $user->password= bcrypt($request['password']);
            }
            $user->save();

            $user->roles()->sync($request->get('roles'));

            /*Funciones para sistema intranet*/
            editar_usuario($user, $id);
            /*Funciones para sistema intranet */

            /*Funciones para sistema mantenimiento*/
            editar_usuario_mantenimiento($user, $id);
            /*Funciones para sistema mantenimiento */
            flash('Se editó con éxito los datos del empleado '. $empleado->Names .'')->success();
        }catch(Exception $e){
             flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Empleado.show', $empleado->Slug);
    }

    public function documentacion (Request $request, $id){
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
            if(empty($request['documentos'])){
                throw new Exception('No se ha seleccionado ningun documento');
            }
            /*for($i=0; $i < count($request['documentos']); $i++){
                $key = (int)$request['documentos'][$i];
                $empleado->Documentos()->updateExistingPivot($key, [
                    'Success'   => $request['Success'][$i]
                ]);
            }*/
            for($i=0; $i < count($request['documentos']); $i++){
                $key = (int)$request['documentos'][$i];
                $empleado->Documentos()->attach($key, [
                    'Success'   => $request['Success'][$i]
                ]);
            }
                 
            flash('Se editó con éxito los datos del empleado '. $empleado->Names .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Empleado.show', $empleado->Slug);
    }

    public function edicion_documentacion ($slug){
        try{
            $empleado = Empleado::whereSlug($slug)->firstOrFail();
            $documentos = Documento::get();
            return view('Empleado.edicion_documentacion')->with('empleado', $empleado)->with('documentos', $documentos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.show', $empleado->Slug);
        }
        
    }

    public function edicion_documentacion_edit (Request $request, $id){
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
            if(empty($request['documentos'])){
                throw new Exception('No se ha seleccionado ningun documento');
            }
            for($i=0; $i < count($request['documentos']); $i++){
                $key = (int)$request['documentos'][$i];
                $empleado->Documentos()->updateExistingPivot($key, [
                    'Success'   => $request['Success'][$i]
                ]);
            } 
                 
            flash('Se editó con éxito los datos del empleado '. $empleado->Names .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            
        }
        return redirect()->route('Empleado.show', $empleado->Slug);
        
    }

    public function anexos(Request $request, $slug){
        try{
            $empleado = Empleado::whereSlug($slug)->firstOrFail();
            if($request->hasFile('Archive')){
                $file = $request->file('Archive');
                $name = $request['Name'].'_'.time().'.'.$file->getClientOriginalExtension();   
                \Storage::disk('local')->put($name,  \File::get($file));
                $anexo = new Anexo();
                $anexo->Name = $name;
                $anexo->Empleado()->associate($empleado);
                $anexo->save();

                flash('Se subio correctamente el archivo '. $anexo->Name .'')->success();
            }else{
                flash('Error ! Ocurrio algo al momento de subir el archivo, intente de nuevo')->error();
            }
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Empleado.show', $empleado->Slug);

    }

    public function eliminar_anexos($id, $slug)
    {
        try{
             $empleado = Empleado::whereSlug($slug)->firstOrFail();
            $anexo = Anexo::find($id);
            Storage::delete($anexo->Name);
            $anexo->delete();

            flash('Se elimino con exito el archivo '. $anexo->Name .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Empleado.show', $empleado->Slug);
        
    }

    public function contratar (Request $request, $id){

        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();

            //obtenemos los puestos actuales
            $puesto = $empleado->Puesto->last();
            $tipo = $empleado->tipo_empleado->last();
            
            if($tipo->Type == "Dual" || $tipo->Type == "Practicante"){
                $request->validate([
                    'Typeemployee_id'
                ]);
                if($request['Typeemployee_id'] == 3 || $request['Typeemployee_id'] == 4){
                    flash('Error, no se puede colocar el mismo tipo de empleado (Dual/Practicante).', 'danger');
                    return redirect()->route('Empleado.show', $empleado->Slug);
                }
                $empleado->Code = $request['Code'];
                $empleado->save();

                //Colocamos feche de fin a al puesto y tipo de empleado actuales
                $empleado->Tipo_empleado_historial()->updateExistingPivot($tipo->id,[
                    'Ending_date' => $request['High_date'] //se tomara la fecha de la nueva contratación 
                ] );
                $empleado->Puestos_historial()->updateExistingPivot($puesto->id, [
                    'Ending_date'   => $request['High_date']
                ]);

                DB::table('employee_position')->where('Employee_id', $empleado->id)->update(['Position_id' => $request['Position_id']]);
                DB::table('employee_typeemployee')->where('Employee_id', $empleado->id)->update(['Typeemployee_id' => $request['Typeemployee_id']]);
                
                //se realiza un nuevo registro de tipo de empleado y puesto
                $empleado->Tipo_empleado_historial()->attach($request['Typeemployee_id'], [
                    'Start_date' => $request['High_date'],
                    'Ending_date' => null
                ]);
                $empleado->Puestos_historial()->attach($request['Position_id'], [
                    'Start_date' => $request['High_date'],
                    'Ending_date' => null
                ]);

                //modificamos el registro actual de la contratación
                $contrato = Contratacion::where('Employee_id', '=', $id)->firstOrFail();
                $contrato->Low_date = $request['High_date'];
                $contrato->save();

                //Creamos un nuevo registro de contrato
                $contrato = new Contratacion();
                $contrato->High_date = $request['High_date'];
                $contrato->Low_date = null;    
                if($request['Typecontract_id'] == 1){
                    $contrato->Duration = null;
                    $contrato->Ending = null;
                }else{
                    $fin = strtotime("+ ".$request['Duration']." days", strtotime($request['High_date']));
                    $fin = date("Y-m-d", $fin);
                    $contrato->Duration = $request['Duration'];
                    $contrato->Ending = $fin;
                }
                $contrato->Tipo_Contratos()->associate($request['Typecontract_id']);
                $contrato->Empleado()->associate($empleado);
                $contrato->save();

                flash('Se contrato al empleado  '. $empleado->Names .' con éxito.')->success();
            }else{
                //en caso de que el empleado sea de confianza o sindicalizado solo se modificara su registro de contratación
                 $contrato = Contratacion::where('Employee_id', '=', $id)->firstOrFail();
                 $contrato->Duration = null;
                 $contrato->Ending = null;
                 $contrato->Typecontract_id = 1;
                 $contrato->save();
                 flash('Se contrato al empleado  '. $empleado->Names .' con éxito.')->success();
            }        
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        return redirect()->route('Empleado.show', $empleado->Slug);
        
    }

    public function asignar_nuevo_puesto (Request $request, $id){
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
            $puesto = $empleado->Puesto->last(); //obtenemos su puesto actual
            $empleado->Parent_id = $request['Parent_id'];
            $empleado->save();

                if($puesto->id == $request['Position_id']){
                    flash('Error !! No se le puede asignar el mismo puesto al empleado  '. $empleado->Names, 'danger');
                    return redirect()->route('Empleado.show', $empleado->Slug);
                }

                //obtenemos los puestos actuales
                $puesto_historial = $empleado->Puestos_historial->last();

                $empleado->Puestos_historial()->updateExistingPivot($puesto_historial->id, [
                    'Ending_date'   => $request['Start_date']
                ]);

                $empleado->Puestos_historial()->attach($request['Position_id'], [
                    'Start_date' => $request['Start_date'],
                    'Ending_date' => null
                ]);

                DB::table('employee_position')->where('Employee_id', $empleado->id)->update(['Position_id' => $request['Position_id']]);

                flash('Se contrato al empleado  '. $empleado->Names .' con éxito.')->success();
                return redirect()->route('Empleado.show', $empleado->Slug);
            
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.show', $empleado->Slug);
        }
        
    }


    public function baja_de_empleado(Request $request, $id){
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
            $request->validate([
                'Output_id' => 'required',
                'Ending_date' => 'required',
            ]);

            $puesto_historial = $empleado->Puestos_historial->last();
            $puesto_actual = $empleado->Puesto->last();
            $tipo_historial = $empleado->Tipo_empleado_historial->last();
            $tipo_actual = $empleado->Tipo_empleado->last();

            $empleado->Output_id = $request['Output_id'];
            //$empleado->Output_Description = $request['Output_Description'];
            $empleado->Active = 0;
            $empleado->save();

            $empleado->Tipo_empleado_historial()->updateExistingPivot($tipo_historial->id,[
                'Ending_date' => $request['Ending_date'] //se tomara la fecha de la nueva contratación 
            ] );

            $empleado->Tipo_empleado()->detach($tipo_actual->id);

            $empleado->Puestos_historial()->updateExistingPivot($puesto_historial->id, [
                'Ending_date'   => $request['Ending_date']
            ]);
            $empleado->Puesto()->detach($puesto_actual->id);


            $empleado->Baja_historial()->attach($request['Output_id'], [
                'output_date' => $request['Ending_date'],
                'reason_for_dismissal' => $request['Output_Description']
            ]);


            $contract = $empleado->Contrataciones->last();
            $contrato = Contratacion::where('id', '=', $contract->id)->firstOrFail();
            $contrato->Low_date = $request['Ending_date'];
            $contrato->save();
            

            $usuario = User::where('Employee_id', '=', $empleado->id)->firstOrFail();
            $usuario->delete();

            empleados_a_cargo($empleado, 'Null');

            /*Funciones para sistema intranet*/
            eliminar_usuario($empleado->id);
            /*Funciones para sistema intranet */
            
            /*Funciones para sistema intranet*/
            eliminar_usuario_mantenimiento($empleado->id);
            /*Funciones para sistema intranet */

            flash('Se dio de baja con éxito el empleado '. $empleado->Names .'')->success();
            return redirect()->route('Empleado.bajas_empleados');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.edit', $empleado->Slug);
        }        
    }
    

    public function recontratar($slug)
    {
        try{
            $empleado = Empleado::whereSlug($slug)->firstOrFail(); 

            $dato_bancos = Dato_Banco::where('Employee_id', $empleado->id)->first();

            $departamentos = Departamento::where('Active', '=', 1)
            ->orderBy('Departament_ES', 'ASC')
            ->pluck('Departament_ES', 'id'); 

            $paises = Pais::orderBy('Country', 'ASC')->pluck('Country', 'id'); 
            $empresas = Empresa::orderBy('Name', 'ASC')->pluck('Name', 'id'); 
            $tipos = Tipo_empleado::orderBy('Type', 'ASC')->pluck('Type', 'id'); 
            $estudios = Escolaridad::orderBy('Scholarship', 'ASC')->pluck('Scholarship', 'id');
            $vouchers = Voucher::orderBy('Voucher', 'ASC')->pluck('Voucher', 'id');
            $contratos = Tipo_contrato::orderBy('Type', 'ASC')->pluck('Type', 'id');
            $estados = Estado_Civil::orderBy('status', 'ASC')->pluck('status', 'id');
            $bancos = Banco::orderBy('Name', 'ASC')->pluck('Name', 'id');
            $parentescos = Familiar::orderBy('relationship', 'ASC')->pluck('relationship', 'id');
            $generos = array('Hombre' => 'Hombre', 'Mujer'=> 'Mujer');

            return view('Empleado.recontratar')
            ->with('empleado', $empleado)
            ->with('departamentos', $departamentos)
            ->with('paises', $paises)
            ->with('empresas', $empresas) 
            ->with('tipos', $tipos)
            ->with('estudios', $estudios)
            ->with('vouchers', $vouchers)
            ->with('contratos', $contratos)
            ->with('estados', $estados)
            ->with('parentescos', $parentescos)
            ->with('bancos', $bancos)
            ->with('dato_bancos', $dato_bancos)
            ->with('generos', $generos);
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.index');
        }

    }

    public function recontratar_guardar(EmpleadoRequest $request, $id)
    {   
        try{
            $empleado = Empleado::where('id', '=', $id)->firstOrFail();
            
            if($request->hasFile('Photo')){
                $intervention = new ImageManager(array('driver' => 'imagick'));
                $file = $request->file('Photo');
                $name = $request['Names'].'_'.date('Y.m.d').time().'.'.$file->getClientOriginalExtension();
                $img = \Image::make($request->file('Photo'))->resize(440, 575)->save('images/Fotografias/'.$name);

                if($empleado->Photo != 'man.jpg' && $empleado->Photo != 'woman.jpg'){
                    \File::delete(public_path('/images/Fotografias/'.$empleado->Photo));
                    $empleado->Photo = $name;
                }else{
                    $empleado->Photo = $name;
                }   
            }

            $empleado->Code = $request['Code'];
            $empleado->Names = $request['Names'];
            $empleado->Paternal = $request['Paternal'];
            $empleado->Maternal = $request['Maternal'];
            $empleado->Parent_id = $request['Parent_id'];
            $empleado->Active = 1;
            $empleado->Output_id = null;
            $empleado->Company_id = $request['Company_id'];
            $empleado->updated_at = date('Y-m-d H:i:s');
            $empleado->save();    

            $empleado->Tipo_empleado_historial()->attach($request['Typeemployee_id'], [
                'Start_date' => $request['High_date'],
                'Ending_date' => Null
            ]);

            $empleado->Tipo_empleado()->attach($request['Typeemployee_id']);

            $empleado->Puestos_historial()->attach($request['Position_id'], [
                'Start_date' => $request['High_date'],
                'Ending_date' => Null
            ]);   
            $empleado->Puesto()->attach($request['Position_id']);

            $datos = Datos::where('Employee_id', '=', $id)->firstOrFail();
            $datos->Gender = $request['Gender'];
            $datos->Birthdate = $request['Birthdate'];
            $datos->Nss = $request['Nss'];
            $datos->Rfc = $request['Rfc'];
            $datos->Curp = $request['Curp'];
            $datos->Credential = $request['Credential'];
            $datos->Blood = $request['Blood'];
            $datos->Allergy = $request['Allergy'];
            $datos->Marital_status_id = $request['Marital_status_id'];
            $datos->Children = $request['Children'];
            $datos->Infonavit = $request['Infonavit'];
            $datos->Fonacot = $request['Fonacot'];
            $datos->Scholarchip_id = $request['Scholarchip_id'];
            $datos->Voucher_id = $request['Voucher_id'];
            $datos->Tows = $request['Tows'];
            $datos->Municipality = $request['Municipality'];
            $datos->State = $request['State'];
            $datos->Country_id = $request['Country_id'];
            $datos->save();

            $domicilio = Domicilio::where('Employee_id', '=', $id)->firstOrFail();
            $domicilio->Address = $request['Address'];
            $domicilio->Postcode = $request['Postcode'];
            $domicilio->Tows = $request['Tows_D'];
            $domicilio->Municipality = $request['Municipality_D'];
            $domicilio->State = $request['State_D'];
            $domicilio->Country_id = $request['Country_id_D'];
            $domicilio->save();


            $contacto = Contacto::where('Employee_id', '=', $id)->firstOrFail();
            $contacto->Personal_mail = $request['Personal_mail'];
            $contacto->Personal_phone = $request['Personal_phone'];
            $contacto->Landline = $request['Landline'];
            $contacto->Family = $request['Family'];
            $contacto->Relationship_id = $request['Relationship_id'];
            $contacto->Emergency_phone = $request['Emergency_phone'];
            $contacto->save();

            $contrato = new Contratacion();
            $contrato->High_date = $request['High_date'];
            $contrato->Low_date = null;
           
            if($request['Typecontract_id'] == 1){  //Si tipo de contrato es indefinido
                $contrato->Duration = null;
                $contrato->Ending = null;
            }else{ //si no es, se coloca dias de duración de su periodo de prueba apartir del dia de contratación
                $fin = strtotime("+ ".$request['Duration']." days", strtotime($request['High_date']));
                $fin = date("Y-m-d", $fin);
                $contrato->Duration = $request['Duration'];
                $contrato->Ending = $fin;
            }

            $contrato->Typecontract_id = $request['Typecontract_id'];
            $contrato->Empleado()->associate($empleado);
            $contrato->save();

            $banco = Dato_Banco::where('Employee_id', '=', $id)->firstOrFail();
            $banco->Bank_id = $request['Bank_id'];
            $banco->Count = $request['Count'];
            $banco->Clabe_bank = $request['Clabe_bank'];
            $banco->save();

            $user = new User();
            $user->name = crear_usuario($request['Names'], $request['Paternal'], $request['Maternal']);
            if(empty($request['Business_mail'])){
                $user->email = $request['Personal_mail'];
            }else{
                $user->email = $request['Business_mail'];
            }
            
            $user->password= crear_password($request['Names'], $request['Paternal'], $request['Maternal'], $request['Birthdate'], true);
            $user->Empleado()->associate($empleado);
            $user->save();

            $user->roles()->sync(2);
            empleados_a_cargo($empleado, 'Asignar');

            //Envio de Notificación de un nuevo registro
            Mail::send('Emails.nuevo_empleado', [
                'Names' => $request['Names'],
                'Paternal' => $request['Paternal'],
                'Maternal' => $request['Maternal'],
                'Birthdate' => $request['Birthdate'],
                'User' => crear_usuario($request['Names'], $request['Paternal'], $request['Maternal']),
                'Password' => crear_password($request['Names'], $request['Paternal'], $request['Maternal'], $request['Birthdate'], false),
            ], function($msj){
                $msj->subject('Nuevo empleado - Sistema de Recursos Humanos');
                $msj->to('Samuel.Lechuga@grupointerconsult.com', 'Ana.Estrada@grupointerconsult.com', 'Enrique.Diaz@grupointerconsult.com');
            });

            flash('Se editó con éxito el empleado '. $empleado->Names .'')->success();
            return redirect()->route('Empleado.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Empleado.edit', $empleado->Slug);
        }

        
    }
	
	
	
	public function after($Code)
    {
        try{
            $busca = Empleado::where("Code", ">", $Code)->limit(1)->get();

   

            return view('Empleado.show')
            ->with('busca', $busca);
        }catch(Exception $e){
            return redirect()->route('Empleado.index');
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
    }
	 


    /*public function getpuestos($id)
    {
        $puestos = Puesto::getPuestos($id); 
        return response()->json($puestos); 
    }*/

    public static function obtener_empleado_superior(Request $request, $id_departamento)
    {
        $personal = Empleado::get_empleado_superior($id_departamento); 

        return response()->json($personal); 
        
    }
	
	
	
	
	
	
	
	
	
	

}
