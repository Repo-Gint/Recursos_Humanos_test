<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Dato_Banco extends Model
{
    protected $table = "bank_datas";

    protected $fillable = ['Count','Clabe_bank','Bank_id','Employee_id'];

    //Relación Uno : Uno Empleado y Banco
    public function Empleado(){

    	return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');	
    }

    //Relación Uno : Uno Empleado y Banco
    public function Banco(){

    	return $this->belongsTo('Recursos_Humanos\Banco', 'Bank_id');	
    }
}
