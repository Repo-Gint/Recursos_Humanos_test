<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Baja_Empleado extends Model
{
    protected $table = "employee_output";

    protected $fillable = ['id','Employee_id', 'Output_id', 'output_date','reason_for_dismissal'];


    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Empleados (){

    	return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_output', 'Output_id', 'Employee_id' )->withTimestamps();
    	
    }
}
