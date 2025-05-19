<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table = "domicile";

    protected $fillable = ['Address','Postcode','Tows','Minicipality','State','Country_id','Employee_id'];

	//Relación Uno : Uno Empleado y Domicilio
    public function Empleado (){

    	return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');

    }

    //Relación Uno : Muchos Domicilio y Pais
    public function Pais (){

    	return $this->belongsTo('Recursos_Humanos\Pais', 'Country_id');

    }
}
