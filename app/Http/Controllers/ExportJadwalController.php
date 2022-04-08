<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\JadwalExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportJadwalController extends Controller
{
    //
    public function export($date) 
    {   
        // return $date;
        return Excel::download(new JadwalExport($date), 'jadwal.xlsx');
    }


}
