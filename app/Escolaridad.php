<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Escolaridad extends Model
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
                'source' => 'Scholarship'
            ]
        ];
    }
    protected $table = "scholarships";

    protected $fillable = ['Scholarship'];

    //Relación Uno : Uno Datos y Escolaridad
    public function Datos (){

        return $this->hasOne('Recursos_Humanos\Datos', 'Scholarchip_id');

    }
}
