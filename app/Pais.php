<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pais extends Model
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
                'source' => 'Country'
            ]
        ];
    }

    protected $table = "countries";

    protected $fillable = ['Country','Flag'];

    //Relación Uno : Muchos Empresa y Pais
    public function Empresas (){

    	return $this->hasMany('Recursos_Humanos\Empresa', 'Country_id');
    	
    }

    //Relación Uno : Muchos Datos y Pais
    public function Dato (){

        return $this->hasMany('Recursos_Humanos\Datos', 'Country_id');
        
    }

    //Relación Uno : Muchos Domicilio y Pais
    public function Domicilio (){

        return $this->hasMany('Recursos_Humanos\Domicilio', 'Country_id');
        
    }
}
