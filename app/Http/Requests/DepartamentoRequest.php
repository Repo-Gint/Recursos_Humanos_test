<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class DepartamentoRequest extends FormRequest
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
                    'Departament_ES'    => 'required|alpha_spaces|min:4|max:120|unique:departaments,Departament_ES,'.$this->route->parameter('Departamento'),
                    'Departament_EN'    => 'required|alpha_spaces|min:4|max:120|unique:departaments,Departament_EN,'.$this->route->parameter('Departamento'),
                    'Acronym'      => 'required|alpha|min:1|max:4|unique:departaments,Acronym,'.$this->route->parameter('Departamento')
                ];
            break;
            default:
                $rules = [
                    'Departament_ES'    => 'required|alpha_spaces|min:4|max:120|unique:departaments,Departament_ES,',
                    'Departament_EN'    => 'required|alpha_spaces|min:4|max:120|unique:departaments,Departament_EN,',
                    'Acronym'      => 'required|alpha|min:1|max:4|unique:departaments,Acronym,'
                ];
            break;
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'Departament_ES'        => 'Departamento',
            'Departament_EN'        => 'Departament',
            'Acronym'               => 'Nomenclatura'
        ];
    }
}
