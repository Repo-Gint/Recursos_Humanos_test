<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;


class DocumentoRequest extends FormRequest
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
                    'Document'   => 'required|alpha_spaces|min:4|max:120|unique:documents,Document,'.$this->route->parameter('Documento'),
                    'Type_document' => 'required',
                    'Important' => 'required'
                ];
            break;
            default:
                $rules = [
                    'Document'   => 'required|alpha_spaces|min:4|max:120|unique:documents,Document,',
                    'Type_document' => 'required',
                    'Important' => 'required'
                ];
            break;
        }

        return $rules;    
    }

     public function attributes()
    {
        return [
            'Document'               => 'Comprobante',
            'Type_document' => 'Tipo de Documento',
            'Important' => 'Importante'
        ];
    }
}
