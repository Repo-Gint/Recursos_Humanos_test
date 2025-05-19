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

class VacacionesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	use Exportable;

	 protected $departamentos;

	 public function __construct($departamentos, $empleados)
    {
        $this->departamentos = $departamentos;
        $this->empleados = $empleados;
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
                'Periodo Actual',
                'Dias a disfrutar',
                'Saldo'
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
                    $cnt++;
                    $contratacion = $empleado->Contrataciones->last();
                    $tipo = $empleado->Tipo_empleado->last();
                    $fecha_alta = $contratacion->High_date;
                    $antiguedad = Antiguedad($fecha_alta);
                    $periodo_actual = Periodo_actual($fecha_alta);
                    $dias_disfrutar =  Dias_Disfrutar($fecha_alta, $tipo->id);
                    $dias_disfrutados = Dias_disfrutados($contratacion, $empleado);
                    $saldo =  Saldo($fecha_alta, $dias_disfrutados);

                    $nuevo->push([
                        $cnt,
                        $empleado->Code,
                        $empleado->Paternal.' '.$empleado->Maternal.' '.$empleado->Names,
                        $empleado->Position_ES,
                        $departamento->Departament_ES,
                        Formato($fecha_alta),
                        $antiguedad,
                        $periodo_actual,
                        $dias_disfrutar,
                        $saldo
                    ]);
                }
            }
        }
       

        return $nuevo;
    }

}
