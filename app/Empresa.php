<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Empresa extends Model
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
                'source' => 'Acronym'
            ]
        ];
    }
    protected $table = "companies";

    protected $fillable = ['Acronym','Name','Address','Phone','State','Municipality','Tows','Country_id'];

    //Relación Uno : Muchos Empleado y Empresa
    public function Empleados (){

    	return $this->hasMany('Recursos_Humanos\Empleado','Company_id');
    	
    }

    //Relación Uno : Muchos Empresa y Pais
    public function Pais (){

    	return $this->belongsTo('Recursos_Humanos\Pais','Country_id');
    	
    }
}
