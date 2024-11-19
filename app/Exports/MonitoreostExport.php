<?php

namespace App\Exports;

use App\Models\Monitoreo;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonitoreostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Monitoreo::all();
    }
}
