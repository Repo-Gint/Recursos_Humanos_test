<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class RolesEmpleadoRequest extends FormRequest
{
    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) 
        {
            
            case 'PUT':
                $rules = [
                    'Business_mail'    => 'nullable|email',
                    //'Business_phone'   => 'nullable|Numeric|digits_between:10,13|unique:contacts,Business_phone,'.$this->route->parameter('Empleado').',Employee_id',
                    'Extension'        => 'nullable|Numeric|digits:4|',
                    'name'             => 'required|alpha_spaces|unique:users,name,'.$this->id.',Employee_id'
                ];
            break;
        }

        return $rules;
        
    }

     public function attributes()
    {
        return [
            'Business_mail'    => 'Email coorporativo',
            'Business_phone'   => 'Celular coorporativo',
            'Extension'        => 'Extensión',
            'name'             => 'Usuario'
        ];
    }
}
