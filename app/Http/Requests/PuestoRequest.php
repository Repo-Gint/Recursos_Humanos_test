<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class PuestoRequest extends FormRequest
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
                    'Code'              => 'required|Alpha_Num|unique:positions,Code,'.$this->route->parameter('Puesto'),
                    'Position_ES'       => 'required|alpha_spaces|min:4|max:120',
                    'Position_EN'       => 'required|alpha_spaces|min:4|max:120',
                    'Descripcion'       => 'nullable',
                    'Responsability'    => 'nullable',
                    'Hierarchy_id'      => 'required',
                    'Departament_id'    => 'required'
                ];
            break;
            default:
                $rules = [
                    'Code'              => 'required|Alpha_Num|unique:positions',
                    'Position_ES'       => 'required|alpha_spaces|min:4|max:120',
                    'Position_EN'       => 'required|alpha_spaces|min:4|max:120',
                    'Descripcion'       => 'nullable',
                    'Responsability'    => 'nullable',
                    'Hierarchy_id'      => 'required',
                    'Departament_id'    => 'required'
                ];
            break;
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'Code'                  => 'Código de puesto',
            'Position_ES'           => 'Puesto',
            'Position_EN'           => 'Position',
            'Descripcion'           => 'Descripción',
            'Responsability'        => 'Responsabilidades',
            'Hierarchy_id'          => 'Jerarquia',
            'Departament_id'        => 'Departamento'
        ];
    }
}
