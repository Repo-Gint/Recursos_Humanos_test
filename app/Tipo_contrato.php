<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tipo_contrato extends Model
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
    protected $table = "type_contracts";

    protected $fillable = ['Type'];

    //Relación Uno : Muchos Contratos y Tipo Contratos
    public function Contrato (){

        return $this->hasMany('Recursos_Humanos\Contratacion');
    }
}
