<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class JerarquiaRequest extends FormRequest
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
                    'Name_ES'   => 'required|alpha_spaces|min:4|max:120|unique:hierarchies,Name_ES,'.$this->route->parameter('Jerarquium'),
                    'Name_EN'   => 'required|alpha_spaces|min:4|max:120|unique:hierarchies,Name_EN,'.$this->route->parameter('Jerarquium'),
                    'Level'     => 'required|numeric|unique:hierarchies,Level,'.$this->route->parameter('Jerarquium')
                ];
            break;
            default:
                $rules = [
                    'Level'     => 'required|numeric|unique:hierarchies,Level,',
                    'Name_ES'   => 'required|alpha_spaces|min:4|max:120|unique:hierarchies,Name_ES,',
                    'Name_EN'   => 'required|alpha_spaces|min:4|max:120|unique:hierarchies,Name_EN,'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'Level'     => 'Nivel',
            'Name_ES'   => 'Nombre',
            'Name_EN'   => 'Name'
        ];
    }
}
