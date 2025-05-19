<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tipo_empleado extends Model
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

    protected $table = "type_employees";

    protected $fillable = ['Type'];

    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Empleados (){

    	return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_typeemployee', 'Typeemployee_id', 'Employee_id' )->withTimestamps();
    	
    }

    //Relación Muchos : Muchos Empleado y Tipo_empleado
    public function Empleados_historial (){

        return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_typeemployee_history', 'Typeemployee_id', 'Employee_id')->withTimestamps();
        
    }
}
