<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class Dias_FestivosRequest extends FormRequest
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
                    'Month'   => 'required',
                    'Day'     => 'required',
                    'Description'     => 'required'

                ];
            break;
            default:
                $rules = [
                    'Month'   => 'required',
                    'Day'     => 'required',
                    'Description'     => 'required'

                ];
            break;
        }

        return $rules;
    }

     public function attributes()
    {
        return [
            'Month'               => 'Mes',
            'Day'                 => 'Día',    
            'Description'                 => 'Descripción'   
        ];
    }
}