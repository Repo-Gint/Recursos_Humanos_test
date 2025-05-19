<?php

namespace Recursos_Humanos\Exports;

use Recursos_Humanos\Empleado;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EmpleadoExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	use Exportable;

	 protected $employees;

	 protected $head;

	 public function __construct($employees = null, $head)
    {
        $this->employees = $employees;
        $this->head = $head;
    }

    public function headings(): array
    {
    	if($this->head == "Datos"){
    		return [
    			'#',
    			'Codigo',
    			'Nombre',
                'Ingreso',
    			'Departamento',
    			'Puesto',
    			'Sexo',
    			'F. Nacimiento',
    			'Seguro social',
    			'RFC',
    			'CURP',
    			'Credencial',
    			'Tipo de sangre',
    			'Alergias',
    			'Estado civil',
    			'Hijos',
    			'Escolaridad',
    			'Comprobante',
    			'Infonavit',
    			'Fonacot',
    			'Domicilio'
			];
		}

		if($this->head == "Bancos"){
    		return [
    			'#',
    			'Codigo',
    			'Nombre',
    			'Departamento',
    			'Puesto',
    			'Banco',
    			'Cuenta',
    			'Clabe interbancaria'
			];
		}

		if($this->head == "Contac_Personal"){
    		return [
    			'#',
    			'Codigo',
    			'Nombre',
    			'Departamento',
    			'Puesto',
    			'Celular',
    			'Teléfono fijo',
    			'Email',
    			'Familiar',
    			'Parentesco',
    			'Teléfono'
			];
		}

		if($this->head == "Contac_Empresa"){
    		return [
    			'#',
    			'Codigo',
    			'Nombre',
    			'Departamento',
    			'Puesto',
    			'Celular',
    			'Email',
    			'Extension'
			];
		}
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */


public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->setBold(true);
            },
        ];
    }



    
    public function collection()
    {
        //return $this->employees ?: Empleado::get();

        $cnt = 0;
        $nuevo = collect([]);

        if($this->head == 'Datos'){
            foreach ($this->employees as $empleado) {
                $cnt++;
                $nuevo->push([
                    (string) $cnt,
                    (string) $empleado->Code,
                    $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names,
                    $empleado->Contrataciones->last()->High_date,
                    $empleado->Puesto->last()->Departamento->Departament_ES,
                    $empleado->Puesto->last()->Position_ES,
                    $empleado->Datos->Gender,
                    $empleado->Datos->Birthdate,
                    $empleado->Datos->Nss,
                    $empleado->Datos->Rfc,
                    $empleado->Datos->Curp,
                    $empleado->Datos->Credential,
                    $empleado->Datos->Blood,
                    $empleado->Datos->Allergy,
                    ($empleado->Datos->Status_id == 0) ? '' : $empleado->Datos->Estado_Civil->status,                    
                    (string) $empleado->Datos->Children,
                    ($empleado->Datos->Scholarship_id == 0) ? '' : $empleado->Datos->Escolaridad->Scholarship,
                    ($empleado->Datos->Voucher_id == 0) ? '' : $empleado->Datos->Voucher->Voucher,
                    $empleado->Datos->Infonavit,
                    $empleado->Datos->Fonacot,
                    $empleado->Domicilio->Address.' '.$empleado->Domicilio->Tows.' '.$empleado->Domicilio->Municipality.' '.$empleado->Domicilio->State.' C.P.:'.$empleado->Domicilio->Postcode
                ]);
            }
        }

        if($this->head == 'Bancos'){
            foreach ($this->employees as $empleado) {
                $cnt++;
                $nuevo->push([
                    (string) $cnt,
                    (string) $empleado->Code,
                    $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names,
                    $empleado->Puesto->last()->Departamento->Departament_ES,
                    $empleado->Puesto->last()->Position_ES,
                    $empleado->Dato_Bancos->Banco->Name,
                    $empleado->Dato_Bancos->Count,
                    $empleado->Dato_Bancos->Clabe_Bank
                ]);
            }
        }

        if($this->head == 'Contac_Personal'){
            foreach ($this->employees as $empleado) {
                $cnt++;
                $nuevo->push([
                    (string) $cnt,
                    (string) $empleado->Code,
                    $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names,
                    $empleado->Puesto->last()->Departamento->Departament_ES,
                    $empleado->Puesto->last()->Position_ES,
                    $empleado->Contactos->Personal_phone,
                    $empleado->Contactos->Landline,
                    $empleado->Contactos->Personal_mail,
                    $empleado->Contactos->Family,
                    ($empleado->Contactos->Relationship_id == 0) ? '' : $empleado->Contactos->Familiar->relationship,
                    $empleado->Contactos->Emergency_phone
                ]);
            }
        }

        if($this->head == "Contac_Empresa"){
            foreach ($this->employees as $empleado) {
                $cnt++;
                $nuevo->push([
                    (string) $cnt,
                    (string) $empleado->Code,
                    $empleado->Paternal.' '. $empleado->Maternal.' '.$empleado->Names,
                    $empleado->Puesto->last()->Departamento->Departament_ES,
                    $empleado->Puesto->last()->Position_ES,
                    (string) $empleado->Contactos->Business_phone,
                    $empleado->Contactos->Business_mail,
                    (string) $empleado->Contactos->Extension
                ]);
            }
        }

        return $nuevo;
    }

}
