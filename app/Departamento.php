<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Departamento extends Model
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
                'source' => 'Departament_ES'
            ]
        ];
    }
    protected $table = "departaments";

    protected $fillable = ['Departament_ES','Departament_EN','Acronym','Parent_id'];


    //Relación Uno : Muchos Puestos y Departamentos
    public function Puestos (){

        return $this->hasMany('Recursos_Humanos\Puesto', 'Departament_id');
        
    }

    public function Parent_Dep(){
        
        return $this->belongsTo('Recursos_Humanos\Departamento');
    }


}
