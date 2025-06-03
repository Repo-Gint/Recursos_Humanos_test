<?php

namespace Recursos_Humanos\Exports;

use Recursos_Humanos\Departamento;
use Recursos_Humanos\Contratacion;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RotacionExportAltas implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	use Exportable;

	 protected $departamentos, $empleados, $fecha_inicio, $fecha_fin, $departaments;


	 public function __construct($departamentos, $empleados, $fecha_inicio, $fecha_fin, $departaments)
    {
        $this->departamentos = $departamentos;
        $this->empleados = $empleados;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->departaments = $departaments;
    }

    public function headings(): array
    {
    		return [
                '#',
                'Nomina',
                'Nombre del Empleado',
                'Puesto',
                'Departamento',
                'F. de Contratación',
                'Antiguedad',
                'F. de Termino',
                'Fecha Final',
                'Motivo de separación'
			];
        
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

        $cnt = 0;
        $nuevo = collect([]);
              foreach($this->departamentos  as $departamento){
        foreach($this->empleados as $empleado){
            if($empleado->Departament_id == $departamento->id){
            foreach($empleado->Contrataciones as $contrat){
                if( (($this->fecha_inicio <= $contrat->High_date) && ($this->fecha_fin >= $contrat->High_date))) {
                    $cnt++;
                   
                    $empleado->Departament_id;
                    $fecha_alta = $contrat->High_date;
                    $antiguedad = Antiguedad($fecha_alta);
                    if($empleado->Active == '1'){
                                     $Estatus = 'Activo';
                                }else{
                                   $Estatus = 'Inactivo'; 
                                }
                    $nuevo->push([
                        $cnt,
                        $empleado->Code,
                        $empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names,
                        $empleado->Position_ES,
                        $departamento->Departament_ES,
                        $contrat->High_date,
                        $antiguedad,
                        $contrat->Low_date,
                        $Estatus,
                        $empleado->Type
                    ]);
                }         
                }
            }
        }
              }
            
        return $nuevo;
    }

}