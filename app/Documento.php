<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Documento extends Model
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
                'source' => 'Document'
            ]
        ];
    }
    protected $table = "documents";

    protected $fillable = ['Document','Type_document', 'Important'];

    //Relación Muchos : Muchos Empleado y Documentos
    public function Empleado(){

        return $this->belongsToMany('Recursos_Humanos\Empleado', 'employee_document', 'Employee_id', 'Document_id');
        
    }
}
