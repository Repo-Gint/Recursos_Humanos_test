<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Jerarquia extends Model
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
                'source' => 'Name_ES'
            ]
        ];
    }

	protected $table = "hierarchies";

    protected $fillable = ['Name_ES','Name_EN','Level'];

    //Relación Uno : Muchos Puestos y Jerarquias
    public function Puestos (){

    	return $this->hasMany('Recursos_Humanos\Puesto', 'Hierarchy_id');
    	
    }
}
