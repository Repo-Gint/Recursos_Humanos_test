<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;
use Recursos_Humanos\Departamento;
class Puesto extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'Slug' => [
                'source' => 'Position_ES'
            ]
        ];
    }
    protected $table = "positions";

    protected $fillable = ['Code','Position_ES','Position_EN','Descripcion','Responsability','Vacancies','Parent_id','Hierarchy_id','Departament_id'];

   
    //Relación Muchos : Muchos Empleado y Puestos trae el historial de los puestos que ha tenido
    public function empleados_historial(){

    	return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_position_history', 'Position_id', 'Employee_id')->withTimestamps();
    	
    }

    //Relación Muchos : Muchos Empleado y Puestos trae el puesto actual que tiene el empleado
    public function empleado(){

        return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_position', 'Position_id', 'Employee_id')->withTimestamps();
        
    }

    //Relación Uno : Muchos Puestos y Jerarquias
    public function Jerarquia (){

    	return $this->belongsTo('Recursos_Humanos\Jerarquia', 'Hierarchy_id');
    	
    }

    //Relación Uno : Muchos Puestos y Departamentos
    public function Departamento(){

        return $this->belongsTo('Recursos_Humanos\Departamento', 'Departament_id');
        
    }


    public function Parent_Puesto(){
        
        return $this->belongsTo('Recursos_Humanos\Puesto', 'Parent_id');
    }

    /*public function Puestos(){
         return $this->HasMany('Recursos_Humanos\Puesto', 'Parent_id');
    }*/

    /**
     * Retorna lista de puestos pertenecientes a un departamento
     *
     * @return array
     */
    public static function get_puestos($id){
        $puestos = Puesto::where('positions.Active', '=', 1)->where('Departament_id','=', $id)->get();
        $puestos_array = array();
        $i = 0;
        foreach ($puestos as $puesto) {
            $vacantes_ocupadas = DB::table('employee_position')->where('Position_id', '=', $puesto->id)->get();
            $vacantes_disponibles = $puesto->Vacancies - $vacantes_ocupadas->count();

            $puestos_array[$i] = array('id' => $puesto->id, 'Code' => $puesto->Code, 'Position_ES' => $puesto->Position_ES, 'Vacancies' => $vacantes_disponibles);
            $i++;
        }
        //dd($puestos_array);
        $coleccion = collect($puestos_array);
        
        return $coleccion;//Puesto::where('positions.Active', '=', 1)->where('Departament_id','=', $id)->get();
    }

    public static function get_puestos_superiores($id){
        $dep = Departamento::where('id', '=', $id)->firstOrFail();
        $puestos = Puesto::where('positions.Active', '=', 1)->where('Departament_id','=', $id)->orWhere('Departament_id','=', $dep->Parent_id)->get();
        $puestos_array = array();
        $i = 0;
        foreach ($puestos as $puesto) {
            $vacantes_ocupadas = DB::table('employee_position')->where('Position_id', '=', $puesto->id)->get();
            $vacantes_disponibles = $puesto->Vacancies - $vacantes_ocupadas->count();

            $puestos_array[$i] = array('id' => $puesto->id, 'Code' => $puesto->Code, 'Position_ES' => $puesto->Position_ES, 'Vacancies' => $vacantes_disponibles);
            $i++;
        }
        //dd($puestos_array);
        $coleccion = collect($puestos_array);
        
        return $coleccion;//Puesto::where('positions.Active', '=', 1)->where('Departament_id','=', $id)->get();
    }

}
