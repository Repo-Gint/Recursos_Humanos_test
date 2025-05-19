<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EscolaridadRequest extends FormRequest
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
                    'Scholarship'   => 'required|alpha_spaces|min:4|max:120|unique:scholarships,Scholarship,'.$this->route->parameter('Escolaridad')
                ];
            break;
            default:
                $rules = [
                    'Scholarship'   => 'required|alpha_spaces|min:4|max:120|unique:scholarships,Scholarship,'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'Scholarship'               => 'Escolaridad'
        ];
    }
}
