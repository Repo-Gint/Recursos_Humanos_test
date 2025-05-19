<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table = "attacheds";

    protected $fillable = ['Name','Employee_id'];

    //Relación Uno : Muchos Empleado y Anexos
    public function Empleado(){

    	return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');
    	
    }
}
