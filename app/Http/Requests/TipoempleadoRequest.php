<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class TipoempleadoRequest extends FormRequest
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
        return True;
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
                    'Type' => 'required|alpha_spaces|min:4|max:120|unique:type_employees,Type,'.$this->route->parameter('Tipoempleado')
                ];
            break;
            default:
                $rules = [
                    'Type' => 'required|alpha_spaces|min:4|max:120|unique:type_employees,Type,',
                ];
            break;
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'Type'  => 'Tipo'
        ];
    }
}
