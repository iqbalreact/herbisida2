<?php

namespace App\Imports;

use App\Warga;
use Maatwebsite\Excel\Concerns\ToModel;

class WargasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kelurahan = Kelurahan::where('nama_kelurahan', $row[3])->first();
        $ketwarga = KategoriWarga::where('kategori', $row[9])->first();
        $kelurahan['id_kelurahan'] = !$kelurahan ? null : $kelurahan['id_kelurahan'];
        $ketwarga['id_kategori_warga'] = !$ketwarga ? null : $ketwarga['id_kategori_warga'];
        $status_dtks = (trim($row[11]) == "DTKS") ? 1 : 2;
        return new Warga([
            'nomor_kk' => trim($row[0]),
            'nik' => trim($row[1]),
            'idbdt' => trim($row[2]),
            'id_kelurahan' => $kelurahan['id_kelurahan'],
            'nama' => strtoupper(trim($row[4])),
            'alamat' => strtoupper(trim($row[5])),
            'rt' => trim($row[6]),
            'rw' => trim($row[7]),
            // 'pekerjaan' => ucfirst(trim($row[6])),
            'pekerjaan' => strtoupper(trim($row[8])),
            'id_kategori_warga' => $ketwarga['id_kategori_warga'],
            // 'rt' => trim($row[8]),
            // 'rw' => trim($row[9])
            'status_rt' => trim($row[10]),
            'status_dtks' => $status_dtks
        ]);
    }
}
