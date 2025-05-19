<?php

namespace Recursos_Humanos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class EmpleadoRequest extends FormRequest
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
                    'Names'            => 'required|alpha_spaces|min:3|max:50',
                    'Paternal'         => 'required|alpha_spaces|min:3|max:50',
                    'Maternal'         => 'required|alpha_spaces|min:3|max:50',
                    'Gender'           => 'required',
                    'Nss'              => 'required|digits:11|Numeric|unique:datas,Nss,'.$this->route->parameter('Empleado').',Employee_id',
                    'Rfc'              => 'required|Alpha_Num|min:12|max:13|unique:datas,Rfc,'.$this->route->parameter('Empleado').',Employee_id',
                    'Curp'             => 'required|Alpha_Num|min:18|max:18|unique:datas,Curp,'.$this->route->parameter('Empleado').',Employee_id',
                    'Credential'       => 'required|Alpha_Num|min:15|max:15|unique:datas,Credential,'.$this->route->parameter('Empleado').',Employee_id',
                    'Scholarchip_id'   => 'nullable',
                    'Voucher_id'       => 'nullable',
                    'Marital_status_id'=> 'required',
                    'Children'         => 'nullable',
                    'Infonavit'        => 'nullable|Alpha_Num|unique:datas,Infonavit,'.$this->route->parameter('Empleado').',Employee_id',
                    'Fonacot'          => 'nullable|Alpha_Num|unique:datas,Fonacot,'.$this->route->parameter('Empleado').',Employee_id',
                    'Allergy'          => 'nullable',
                    'Photo'            => 'nullable|image|mimes:jpeg,png,jpg',
                    'Birthdate'        => 'required',
                    'Country_id'       => 'required',
                    'State'            => 'required|alpha_spaces',
                    'Municipality'     => 'required|alpha_spaces',
                    'Tows'             => 'required',
                    'Country_id_D'     => 'required',
                    'State_D'          => 'required|alpha_spaces',
                    'Municipality_D'   => 'required|alpha_spaces',
                    'Tows_D'           => 'required',
                    'Address'          => 'required',
                    'Postcode'         => 'required|digits:5|Numeric',
                    'Personal_mail'    => 'required|email|unique:contacts,Personal_mail,'.$this->route->parameter('Empleado').',Employee_id',
                    'Personal_phone'   => 'required|Alpha_Num|digits:10|unique:contacts,Personal_phone,'.$this->route->parameter('Empleado').',Employee_id',
                    'Landline'         => 'nullable|Alpha_Num|digits_between:8,13|unique:contacts,Landline,'.$this->route->parameter('Empleado').',Employee_id',
                    'Family'           => 'required|alpha_spaces',
                    'Relationship_id'     => 'required',
                    'Emergency_phone'  => 'required|Alpha_Num|digits:10|unique:contacts,Emergency_phone,'.$this->route->parameter('Empleado').',Employee_id',
                    'Company_id'       => 'required',
                    'Typeemployee_id'  => 'required',
                    'Code'             => 'required|Numeric|digits_between:4,5|unique:employees,Code,'.$this->route->parameter('Empleado'),
                    'High_date'        => 'required',
                    'Typecontract_id'  => 'required',
                    'During'           => 'nullable|Numeric',
                    'Departament_id'   => 'required',
                    'Position_id'      => 'required',
                    'Parent_id'        => 'nullable',
                    'Bank'             => 'nullable',
                    'Count'            => 'nullable|Numeric',
                    'Clabe_bank'       => 'nullable|Numeric'
                ];
            break;
            default:
                $rules = [
                    'Names'            => 'required|alpha_spaces|min:3|max:50',
                    'Paternal'         => 'required|alpha_spaces|min:3|max:50',
                    'Maternal'         => 'required|alpha_spaces|min:3|max:50',
                    'Gender'           => 'required',
                    'Nss'              => 'required|digits:11|Numeric|unique:datas,Nss,',
                    'Rfc'              => 'required|Alpha_Num|min:12|max:13|unique:datas,Rfc,',
                    'Curp'             => 'required|Alpha_Num|min:18|max:18|unique:datas,Curp,',
                    'Credential'       => 'required|Alpha_Num|min:15|max:15|unique:datas,Credential,',
                    'Scholarchip_id'   => 'nullable',
                    'Voucher_id'       => 'nullable',
                    'Marital_status_id'   => 'required',
                    'Children'         => 'nullable',
                    'Infonavit'        => 'nullable|Alpha_Num|unique:datas,Infonavit,',
                    'Fonacot'          => 'nullable|Alpha_Num|unique:datas,Fonacot,',
                    'Allergy'          => 'nullable',
                    'Photo'            => 'nullable|image|mimes:jpeg,png,jpg',
                    'Birthdate'        => 'required',
                    'Country_id'       => 'required',
                    'State'            => 'required|alpha_spaces',
                    'Municipality'     => 'required|alpha_spaces',
                    'Tows'             => 'required',
                    'Country_id_D'     => 'required',
                    'State_D'          => 'required|alpha_spaces',
                    'Municipality_D'   => 'required|alpha_spaces',
                    'Tows_D'           => 'required',
                    'Address'          => 'required',
                    'Postcode'         => 'required|digits:5|Numeric',
                    'Personal_mail'    => 'required|email|unique:contacts',
                    'Personal_phone'   => 'required|Numeric|digits:10|unique:contacts,Personal_phone,',
                    'Landline'         => 'nullable|Numeric|digits_between:8,13|unique:contacts,Landline,',
                    'Family'           => 'required|alpha_spaces',
                    'Relationship_id'     => 'required',
                    'Emergency_phone'  => 'required|Numeric|digits:10|unique:contacts,Emergency_phone,',
                    'Company_id'       => 'required',
                    'Typeemployee_id'  => 'required',
                    'Code'             => 'required|Numeric|digits_between:4,5|unique:employees,Code,',
                    'High_date'        => 'required',
                    'Typecontract_id'  => 'required',
                    'During'           => 'nullable|Numeric',
                    'Departament_id'   => 'required',
                    'Position_id'      => 'required',
                    'Parent_id'         => 'nullable',
                    'Bank_id'             => 'nullable',
                    'Count'            => 'nullable|Numeric',
                    'Clabe_bank'      => 'nullable|Numeric'
                ];
            break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'Names'            => 'Nombre',
            'Paternal'         => 'Apellido paterno',
            'Maternal'         => 'Apellido materno',
            'Gender'           => 'Género',
            'Nss'              => 'Seguro social',
            'Rfc'              => 'RFC',
            'Curp'             => 'CURP',
            'Credential'       => 'Credencial',
            'Scholarchip_id'   => 'Estudios',
            'Voucher_id'       => 'Comprobante de estudios',
            'Marital_status_id'   => 'Estado civil',
            'Children'         => 'Hijos',
            'Allergy'          => 'Alergias',
            'Photo'            => 'Fotografia',
            'Birthdate'        => 'Fecha de nacimiento',
            'Country_id'       => 'Pais de nacimiento',
            'State'            => 'Estado de nacimiento',
            'Municipality'     => 'Municipio de nacimiento',
            'Tows'             => 'Localidad de nacimiento',
            'Country_id_D'     => 'Pais de domicilio',
            'State_D'          => 'Estado de de domicilio',
            'Municipality_D'   => 'Municipio de domicilio ',
            'Tows_D'           => 'Localidad de domicilio',
            'Address'          => 'Dirección',
            'Postcode'         => 'Codigo Postal',
            'Personal_mail'    => 'Email',
            'Personal_phone'   => 'Celular',
            'Landline'         => 'Teléfono de casa',
            'Family'           => 'Conocido',
            'Relationship_id'     => 'Parentesco',
            'Emergency_phone'  => 'Teléfono de ermegencia',
            'Company_id'       => 'Empresa',
            'Typeemployee_id'  => 'Tipo de empleado',
            'Code'             => 'Código',
            'High_date'        => 'Fecha de contratación',
            'Typecontract_id'  => 'Tipo de contrato',
            'During'           => 'Duración de contrato',
            'Departament_id'   => 'Departamento',
            'Position_id'      => 'Puesto',
            'Parent_id'        => 'Superior',
            'Bank_id'             => 'Banco',
            'Count'            => 'Cuenta bancaria',
            'Clabe_bank'       => 'Clabe interbancaria'
        ];
    }
}
