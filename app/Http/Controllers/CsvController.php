<?php

namespace App\Http\Controllers;

use App\Exports\MonitoreostExport;
use App\Imports\MonitoreosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    //  public $isOpens = false;

    // public function import(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'document_csv' => 'required|mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048'
    //         ]);
    //         $file = $request->file('document_csv');
    //         Excel::import(new MonitoreosImport, $file);

    //         return redirect()->route('monitoreos')->with('success', 'CSV imported successfully');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Error importing CSV: ' . $e->getMessage());
    //     }
    //     $this->reset(['isOpen']);
    // }

    public function export()
    {
        // Implement export logic here
        return Excel::download(new MonitoreostExport, 'monitoreo.csv');
    }
    // public function CreateCsv()
    // {
    //     return view('livewire.crud-monitoreo' );

    // }
}
