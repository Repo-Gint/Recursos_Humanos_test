<?php

namespace Recursos_Humanos;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','Employee_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relación Uno : Uno Empleado y Usuarios
    public function Empleado (){

        return $this->belongsTo('Recursos_Humanos\Empleado', 'Employee_id');

    }
}
