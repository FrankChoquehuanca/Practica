<?php

namespace App\Imports;

use App\Models\Monitoreo;
use App\Models\Persona;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MonitoreosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $persona = Persona::find($row['persona']);

        if ($persona) {
            $asignacion = $persona->asignacion;

            if ($asignacion) {
                return new Monitoreo([
                    'horaingreso' => $row['horaingreso'],
                    'horasalida' => $row['horasalida'],
                    'horacsalida' => $row['horacsalida'],
                    'horacingreso' => $row['horacingreso'],
                    'fecha' => Carbon::createFromFormat('d/m/Y', $row['fecha'])->format('Y-m-d'), // Convertir fecha al formato 'Y-m-d'
                    'asignacion_id' => $asignacion->id,
                    'turno_id' => $row['turno'],
                ]);
            } else {
                return new Monitoreo([
                    'horaingreso' => $row['horaingreso'],
                    'horasalida' => $row['horasalida'],
                    'horacsalida' => $row['horacsalida'],
                    'horacingreso' => $row['horacingreso'],
                    'fecha' => Carbon::createFromFormat('d/m/Y', $row['fecha'])->format('Y-m-d'), // Convertir fecha al formato 'Y-m-d'
                    'asignacion_id' => 'N/A',
                    'turno_id' => $row['turno'],
                ]);
            }
        } else {
            return new Monitoreo([
                'horaingreso' => $row['horaingreso'],
                'horasalida' => $row['horasalida'],
                'horacsalida' => $row['horacsalida'],
                'horacingreso' => $row['horacingreso'],
                'fecha' => Carbon::createFromFormat('d/m/Y', $row['fecha'])->format('Y-m-d'), // Convertir fecha al formato 'Y-m-d'
                'asignacion_id' => 'N/A',
                'turno_id' => $row['turno'],
            ]);
        }
    }
}
