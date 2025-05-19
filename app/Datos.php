<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
	protected $table = "datas";

    protected $fillable = ['Gender','Birthdate','Nss','Rfc','Curp','Credential','Blood','Allergy','Marital_status_id','Children','Infonavit','Fonacot','Scholarchip_id','Voucher_id','Tows','Municipality','State','Country_id','Employee_id'];



	//Relación Uno : Uno Empleado y Datos
    public function Empleado (){

    	return $this->belongsTo('Recursos_Humanos\Empleado','Employee_id');

    }

    //Relación Uno : Uno Empleado y Banco
    public function Estado_Civil(){

        return $this->belongsTo('Recursos_Humanos\Estado_Civil', 'Marital_status_id');   
    }

    //Relación Uno : Muchos Datos y Pais
    public function Pais (){

    	return $this->belongsTo('Recursos_Humanos\Pais', 'Country_id');

    }

    //Relación Uno : Uno Datos y Escolaridad
    public function Escolaridad (){

        return $this->belongsTo('Recursos_Humanos\Escolaridad', 'Scholarchip_id');

    }

    //Relación Uno : Uno Datos y Voucher
    public function Voucher (){

        return $this->belongsTo('Recursos_Humanos\Voucher','Voucher_id');

    }
}
