<?php

namespace App\Exports;

use App\DistribusiKolektif;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class ExportDistribusiKolektif implements FromCollection,WithHeadings,WithColumnFormatting,WithStyles,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $kolektif = DB::table('distribusi_kolektifs')
        ->join('list_datas', 'list_datas.id_list', '=', 'distribusi_kolektifs.id_list')
        ->join('wargas', 'wargas.nomor_kk', '=', 'distribusi_kolektifs.nomor_kk')
        ->join('kelurahans', 'wargas.id_kelurahan', '=', 'kelurahans.id_kelurahan')
        ->join('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=' , 'list_datas.id_paket_bantuan')
        ->select(
            'paket_bantuans.nama_paket_bantuan',
            'wargas.nomor_kk','wargas.nik','wargas.nama','wargas.alamat','kelurahans.nama_kelurahan','wargas.rt','wargas.rw',
            'kelurahans.nama_kelurahan',
            'list_datas.tipe',
            'wargas.status_dtks',
            'list_datas.tanggal_terima',
        )
        ->where('distribusi_kolektifs.id_list', $this->id)
        ->get();
        foreach ($kolektif as $item) {
            if ($item->status_dtks == '1') {
                $item->status_dtks = 'DTKS';
            } elseif ($item->status_dtks == '2') {
                $item->status_dtks = 'NON DTKS';
            }
            else {
                $item->status_dtks = '';
            }

        }
        return $kolektif;
    }

    public function headings(): array
    {
        return [
            'Nama Paket',
            'Nomor KK',
            'NIK',
            'Nama Lengkap',
            'Alamat',
            'Nama Kelurahan',
            'RT',
            'RW',
            'Jenis Distribusi',
            'Status Warga',
            'Tanggal Terima',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }


}
