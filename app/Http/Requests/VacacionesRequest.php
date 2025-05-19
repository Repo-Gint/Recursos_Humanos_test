<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class VacacionesRequest extends FormRequest
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
                    'Start_date'    => 'required|date',
                    'Ending_date'   => 'required|date|after_or_equal:Start_date'
                ];
            break;
            default:
                $rules = [
                    'Start_date'    => 'required|date',
                    'Ending_date'   => 'required|date|after_or_equal:Start_date'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'Start_date' => 'Fecha de Inicio',
            'Ending_date' => 'Fecha de Fin',
        ];
    }
}
