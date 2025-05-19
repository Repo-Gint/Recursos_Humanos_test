<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Baja extends Model
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
                'source' => 'Type'
            ]
        ];
    }
    protected $table = "outputs";

    protected $fillable = ['Type'];


    //Relación Uno : Muchos Empleado y Baja
    public function Empleados (){

    	return $this->hasMany('Recursos_Humanos\Empleado', 'Output_id');
    	
    }
}
