<?php

namespace Recursos_Humanos;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Dias_Festivos extends Model
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
                'source' => 'Description'
            ]
        ];
    }

    protected $table = "national_holidays";

    protected $fillable = ['Month','Day', 'Description'];
}
