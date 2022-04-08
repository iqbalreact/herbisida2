<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Imports\ImportDataWarga;
use App\RincianBantuan;
use App\DetailPaket;
use App\Exports\ExportBantuan;
use App\PaketBantuan;
use App\SumberBantuan;
use App\Warga;

class BerandaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        $dtks = $warga->where('status_dtks', 1)->count();
        $nondtks = $warga->where('status_dtks', 2)->count();
        $pkh = RincianBantuan::leftJoin('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=', 'rincian_bantuans.id_paket_bantuan')->where('paket_bantuans.nama_paket_bantuan', 'PKH')->count();
        $bpnt = RincianBantuan::leftJoin('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=', 'rincian_bantuans.id_paket_bantuan')->where('paket_bantuans.nama_paket_bantuan', 'BNPT')->count();
        $bst = RincianBantuan::leftJoin('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=', 'rincian_bantuans.id_paket_bantuan')->where('paket_bantuans.nama_paket_bantuan', 'BST')->count();

        return view('frontend.beranda', compact('warga', 'dtks', 'nondtks','pkh','bpnt','bst'));

    }
}
