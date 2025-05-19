<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class PaisRequest extends FormRequest
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
                    'Country'   => 'required|alpha_spaces|min:4|max:120|unique:countries,Country,'.$this->route->parameter('Pai'),
                    'Flag'      => 'image|mimes:jpeg,png,jpg'
                ];
            break;
            default:
                $rules = [
                    'Country'   => 'required|alpha_spaces|min:4|max:120|unique:countries,Country,',
                    'Flag'      => 'image|mimes:jpeg,png,jpg'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'Country'               => 'Pais',
            'Flag'                  => 'Bandera'
        ];
    }
}
