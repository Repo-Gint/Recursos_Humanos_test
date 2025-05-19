<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Banco extends Model
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
                'source' => 'Name'
            ]
        ];
    }
    protected $table = "banks";

    protected $fillable = ['id','Name'];


    //Relación Uno : Uno Empleado y Banco
    public function Dato_Bancos(){
        return $this->hasOne('Recursos_Humanos\Dato_Banco', 'Bank_id');
    }
}
