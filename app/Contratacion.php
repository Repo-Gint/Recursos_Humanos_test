<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Contratacion extends Model
{
    protected $table = "contracts";

    protected $fillable = ['High_date','Low_date','Duration','Ending','Payment_date','Typecontract_id','Employee_id'];



	//Relación Empleado y Contratacion
    public function Empleado (){

    	return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');

    }

    //Relación Uno : Muchos Contratos y Tipo Contratos
    public function Tipo_Contratos (){

    	return $this->belongsTo('Recursos_Humanos\Tipo_contrato', 'Typecontract_id');

    }
}
