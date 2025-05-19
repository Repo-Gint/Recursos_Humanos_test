<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Voucher extends Model
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
                'source' => 'Voucher'
            ]
        ];
    }
    protected $table = "vouchers";

    protected $fillable = ['Voucher'];

    //Relación Uno : Uno Datos y Voucher
    public function Datos (){

        return $this->hasOne('Recursos_Humanos\Datos', 'Voucher_id');

    }
}
