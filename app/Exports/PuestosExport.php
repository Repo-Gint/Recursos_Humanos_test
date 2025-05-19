<?php

namespace Recursos_Humanos\Exports;

use Recursos_Humanos\Puesto;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PuestosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
	use Exportable;

	 protected $request;

	 protected $head;

	 public function __construct( $request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
    		return [
                'id',
    			'Código',
    			'Puesto',
    			'Position',
    			'Departamento',
    			'Autorizados',
    			'Plantilla'
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
        $query = DB::table('departaments')
        ->join('positions', 'departaments.id', '=', 'positions.Departament_id')
        ->select('positions.id AS Position_id', 'positions.Code','Position_ES','Position_EN', 'Departament_ES', 'Vacancies');

        $empleados = DB::table('employees')
        ->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
        ->get();

        $ban = 0;
        for ($i=0; $i < count($this->request['Departaments']) ; $i++) { 
            if($this->request['Departaments'][$i] == "Todo"){
                $ban = 1;
            }
        }
        if($ban == 1){
            $puestos = $query->where('positions.Active', '=', 1)->orderBy('Departament_ES', 'ASC')->get();
        }else{
            for ($i=0; $i < count($this->request['Departaments']) ; $i++) { 
                $query->orWhere('departaments.id', '=', $this->request['Departaments'][$i]);
            }
             $puestos = $query->where('positions.Active', '=', 1)->orderBy('Departament_ES', 'ASC')->get();
        }
        $a = 0;
        $nuevo = collect([]);
        foreach($puestos as $puesto){
            foreach($empleados as $empleado){
                if($empleado->Position_id == $puesto->Position_id){
                    $a++;
                }
            }
             $puesto->plantilla = $a;
            
            $a = 0;
                    
        }

        return $puestos ?: Puesto::get();
    }

}
