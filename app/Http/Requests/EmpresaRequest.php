<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EmpresaRequest extends FormRequest
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
                    'Acronym'       => 'required|unique:companies,Acronym,'.$this->route->parameter('Empresa'),
                    'Name'          => 'required|alpha_spaces|min:4|max:240|unique:companies,Name,'.$this->route->parameter('Empresa'),
                    'Country_id'    => 'required',
                    'Address'       => 'required|min:4|max:240',
                    'State'         => 'required|alpha_spaces|min:4|max:120',
                    'Municipality'  => 'required|alpha_spaces|min:4|max:120',
                    'Tows'          => 'required|alpha_spaces|min:4|max:120',
                    'Phone'         => 'nullable|numeric|digits_between:7,13|unique:companies,Phone,'.$this->route->parameter('Empresa')
                ];
            break;
            default:
                $rules = [
                    'Acronym'       => 'required|unique:companies,Acronym,',
                    'Name'          => 'required|alpha_spaces|min:4|max:240|unique:companies,Name,',
                    'Country_id'    => 'required',
                    'Address'       => 'required|min:4|max:240',
                    'State'         => 'required|alpha_spaces|min:4|max:120',
                    'Municipality'  => 'required|alpha_spaces|min:4|max:120',
                    'Tows'          => 'required|alpha_spaces|min:4|max:120',
                    'Phone'         => 'nullable|numeric|digits_between:7,13|unique:companies,Phone,'
                ];
            break;
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'Acronym'       => 'Nomenclatura',
            'Name'          => 'Nombre',
            'Address'       => 'Dirección',
            'State'         => 'Estado',
            'Municipality'  => 'Municipio',
            'Tows'          => 'Localidad',
            'Phone'         => 'Teléfono',
            'Country_id'    => 'Pais'
        ];
    }
}
