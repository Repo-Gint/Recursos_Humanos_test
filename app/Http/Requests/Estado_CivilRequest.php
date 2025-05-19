<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class Estado_CivilRequest extends FormRequest
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
                    'status'   => 'required|alpha_spaces|min:4|max:120|unique:marital_status,status,'.$this->route->parameter('Estado_Civil')
                ];
            break;
            default:
                $rules = [
                    'status'   => 'required|alpha_spaces|min:4|max:120|unique:marital_status,status,'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'status'               => 'Estado'
        ];
    }
}
