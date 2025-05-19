<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = "contacts";

    protected $fillable = ['Personal_mail','Business_mail','Personal_phone','Business_phone','Landline','Extension','Relationship_id','Emergengy_phone','Employee_id'];

    //Relación Uno : Uno Empleado y Contactos
    public function Empleado(){

    	return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');	
    }

    //Relación Uno : Uno Empleado y Contactos
    public function Familiar(){

    	return $this->belongsTo('Recursos_Humanos\Familiar', 'Relationship_id');	
    }
}
