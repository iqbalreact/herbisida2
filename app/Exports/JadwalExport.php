<?php

namespace App\Exports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $date;

    function __construct($date) {
            $this->date = $date;
    }

    public function collection()
    {
        // return $date;

        return Jadwal::where('tanggal', $this->date)
        ->orderBy('jam', 'asc')
        ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Jam',
            'Nama Pelayan',
            'Bidang Pelayanan',
            'Ruangan',
        ];
    }
}
