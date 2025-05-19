<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $table = "holidays";

    protected $fillable = ['Period','Start_date','Ending_date','Days','Paid','Advanced','Employee_id'];

    protected $date = [
    	'Start_date',
    	'Ending_date',
    ];

    //Relación Uno : Muchos Empleado y Vacaciones
    public function Empleado (){

    	return $this->belongsTo('Recursos_Humanos\Empleado');
    	
    }
}
