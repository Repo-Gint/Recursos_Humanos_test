<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class Empleado extends Model
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
                'source' => 'Code'
            ]
        ];
    }
    protected $table = "employees";

    protected $fillable = ['id','Code','Names','Paternal','Maternal','Photo','Active', 'Parent_id','Output_id', 'Company_id'];

    //Relación Uno : Muchos Empleado y Anexos
    public function Anexos(){
        return $this->hasMany('Recursos_Humanos\Anexo', 'Employee_id');
    }

    //Relación Uno : Uno Empleado y Banco
    public function Dato_Bancos(){
        return $this->hasOne('Recursos_Humanos\Dato_Banco', 'Employee_id');
    }

    //Relación Uno : Uno Empleado y Contactos
    public function Contactos (){

        return $this->hasOne('Recursos_Humanos\Contacto', 'Employee_id');
        
    }

    //Relación Uno : Muchos Empleado y Contratos
    public function Contrataciones (){

    	return $this->hasMany('Recursos_Humanos\Contratacion', 'Employee_id');

    }

    //Relación Uno : Uno Empleado y Datos
    public function Datos (){

        return $this->hasOne('Recursos_Humanos\Datos', 'Employee_id');

    }


    //Relación Uno : Uno Empleado y Domicilio
    public function Domicilio (){

        return $this->hasOne('Recursos_Humanos\Domicilio', 'Employee_id');

    }

    //Relación Uno : Muchos Empleado y Vacaciones
    public function Vacaciones (){

    	return $this->hasMany('Recursos_Humanos\Vacacion', 'Employee_id');
    	
    }


    //Relación Uno : Muchos Empleado y Empresa
    public function Empresa (){

    	return $this->belongsTo('Recursos_Humanos\Empresa', 'Company_id');
    	
    }

    //Relación Uno : Muchos Empleado y Baja
    public function Baja (){

        return $this->belongsTo('Recursos_Humanos\Baja', 'Output_id');
        
    }

    //Relación Uno : Uno Empleado y Usuarios
    public function User (){

        return $this->hasOne('Recursos_Humanos\user', 'Employee_id');
        
    }

    //Relación Muchos : Muchos Empleado y Puestos trae el historial de los puestos que ha tenido
    public function Puestos_historial (){

    	return $this->belongsToMany('Recursos_Humanos\Puesto', 'employee_position_history', 'Employee_id', 'Position_id')->withPivot('Start_date', 'Ending_date');
    	
    }

    //Relación Muchos : Muchos Empleado y Puestos trae el puesto actual que tiene el empleado
    public function Puesto (){ 

        return $this->belongsToMany('Recursos_Humanos\Puesto', 'employee_position', 'Employee_id', 'Position_id');
        
    }

    //Relación Muchos : Muchos Empleado y Documentos
    public function Documentos(){

        return $this->belongsToMany('Recursos_Humanos\Documento', 'employee_document', 'Employee_id', 'Document_id')->withPivot('Success');
        
    }


    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Tipo_empleado(){

        return $this->belongsToMany('Recursos_Humanos\Tipo_empleado', 'employee_typeemployee', 'Employee_id', 'Typeemployee_id');
        
    }

    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Tipo_empleado_historial(){

        return $this->belongsToMany('Recursos_Humanos\Tipo_empleado', 'employee_typeemployee_history', 'Employee_id', 'Typeemployee_id')->withPivot('Start_date', 'Ending_date');
        
    }

    public function Parent_Emp(){
        
        return $this->belongsTo('Recursos_Humanos\Empleado', 'Parent_id');
    }

    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Baja_Historial (){

        return $this->belongsToMany('Recursos_Humanos\Baja_Empleado', 'employee_output', 'Employee_id', 'Output_id' )->withPivot('output_date','reason_for_dismissal')->withTimestamps();
        
    }

    /**
     * Retorna lista de puestos pertenecientes a un departamento
     *
     * @return array
     */
    public static function get_codigo_empleado($id){
        if($id == 1 || $id == 2){
            return Empleado::whereRaw('code = (select max(`Code`) from employees WHERE Code BETWEEN 2000 AND 9999 )')->get();
        }else{
            return Empleado::whereRaw('code = (select max(`Code`) from employees WHERE Code BETWEEN 10000 AND 20000 )')->get();
        }
    }

    /**
     * Retorna lista de personal pertenecientes a un departamento
     *
     * @return array
     */
    public static function get_empleado_superior($id){

        $puesto_superior = DB::table('positions')->select('Parent_id')->where('id','=', $id)->first();

        $empleado =  DB::table('employees')->select('employees.id AS Empleado_id', 'Names', 'Paternal', 'Maternal')
        ->Join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
        ->Join('positions','positions.id', '=', 'employee_position.Position_id')
        ->where('positions.id','=', $puesto_superior->Parent_id)->get();
        
        return $empleado;
    }

}
