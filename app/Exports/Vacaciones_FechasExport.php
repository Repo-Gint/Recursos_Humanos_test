<?php

namespace Recursos_Humanos\Exports;

use Recursos_Humanos\Departamento;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class Vacaciones_FechasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
                'Fecha Inicial',
                'Fecha Final'
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
              
        foreach($this->empleados as $empleado){
            foreach($empleado->Vacaciones as $vacaciones){
                if( (($this->fecha_inicio <= $vacaciones->Start_date) && ($this->fecha_fin >= $vacaciones->Start_date)) || (($this->fecha_inicio >= $vacaciones->Ending_date) && ($this->fecha_fin <= $vacaciones->Ending_date)) ) {
                    $cnt++;
                    $nuevo->push([
                        $cnt,
                        $empleado->Code,
                        $empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names,
                        Formato($vacaciones->Start_date),
                        Formato($vacaciones->Ending_date)
                    ]);
                            
                }
            }
        }
            
        return $nuevo;
    }

}
