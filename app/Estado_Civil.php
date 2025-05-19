<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Estado_Civil extends Model
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
                'source' => 'status'
            ]
        ];
    }
    protected $table = "marital_status";

    protected $fillable = ['id','status'];


    //Relación Uno : Uno Empleado y Banco
    public function Datos(){
        return $this->hasOne('Recursos_Humanos\Datos', 'Marital_status_id');
    }
}