<?php

namespace Recursos_Humanos\Http\Controllers;

use Illuminate\Http\Request;
use Recursos_Humanos\Http\Requests\RolRequest;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Laracasts\Flash\Flash; 
use Exception;
class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permissions:Rol.create')->only(['create', 'store']);
        $this->middleware('permissions:Rol.edit')->only(['create', 'update']);
        $this->middleware('permissions:Rol.show')->only(['show']);
        $this->middleware('permissions:Rol.index')->only(['index']);
        $this->middleware('permissions:Rol.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('Rol.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = Permission::select('group')->groupBY('group')->orderBy('group')->get();
        $permissions = Permission::get();
        return view('Rol.create')->with('permissions', $permissions)->with('grupos', $grupos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        try{ 
            if($request['special'] == 'personalizado'){
                $rol = new Role($request->all());
                $rol->special = NULL;
                $rol->save();
            }else{
                $rol = Role::create($request->all());
            }
            $rol->permissions()->sync($request->get('permission'));
        
            flash('Se guardo con éxito el rol '. $rol->name .'')->success();
            return redirect()->route('Rol.index');
        }catch(Exception $e){
            return redirect()->back()->withInput()->withErrors('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage());
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
            $grupos = Permission::select('group')->groupBY('group')->orderBy('group')->get();
            $role = Role::whereSlug($slug)->firstOrFail();
            $permissions = Permission::get();
            return view('Rol.edit', compact('role', 'permissions', 'grupos'));
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Rol.index');
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required'
            ]);
            $rol = Role::find($id);
            $rol->fill($request->all());
            if($request['special'] == 'personalizado'){
                $rol->special = NULL;
                $rol->save();
                 $rol->permissions()->sync($request->get('permission'));
            }else{
                $rol->save();
                $rol->permissions()->detach();
            }
            
            flash('Se guardo con éxito el rol '. $rol->name .'')->success();
            return redirect()->route('Rol.index');
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
            return redirect()->route('Rol.edit', $rol->slug);
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
            $rol = Role::find($id);
            $rol->delete();

            flash('Se ha borrado con éxito el rol '. $rol->name .'')->success();
        }catch(Exception $e){
            flash('Lo siento, en el proceso ocurrieron errores: '.$e->getMessage(), 'danger');
        }
        
        return redirect()->route('Rol.index');
    }
}
