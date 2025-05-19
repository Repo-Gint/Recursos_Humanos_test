<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Familiar extends Model
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
            'slug' => [
                'source' => 'relationship'
            ]
        ];
    }
    protected $table = "relationships";

    protected $fillable = ['id','relationship'];

    //Relación Uno : Uno Empleado y Banco
    public function Contacto(){
        return $this->hasOne('Recursos_Humanos\Contacto', 'Relationship_id');
    }
}
