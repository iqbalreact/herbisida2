<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\RincianBantuan;
use App\DetailPaket;
use App\Exports\ExportBantuan;
use App\PaketBantuan;
use App\SumberBantuan;
use App\Warga;
use Illuminate\Http\Request;

// use Composer\DependencyResolver\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        // $paketBantuans = PaketBantuan::leftJoin('sumber_bantuans', 'sumber_bantuans.id_sumber_bantuan', '=', 'paket_bantuans.id_sumber_bantuan')->get();

        // // Penyalur
        // $penyalurs = SumberBantuan::all();
        
        if($request->has('no_kk')){
            $data['rincianBantuan']= RincianBantuan::select('rincian_bantuans.*', 'sumber_bantuans.nama AS penyalur', 'paket_bantuans.nama_paket_bantuan AS nama_paket', 'kategori_bantuans.kategori AS kategori', 'sumber_paket.nama AS nama_sumber')->leftJoin('sumber_bantuans', 'sumber_bantuans.id_sumber_bantuan', '=', 'rincian_bantuans.id_penyalur')
                ->leftJoin('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=', 'rincian_bantuans.id_paket_bantuan')
                ->leftJoin('sumber_bantuans AS sumber_paket', 'sumber_paket.id_sumber_bantuan', '=', 'paket_bantuans.id_sumber_bantuan')
                ->leftJoin('kategori_bantuans', 'kategori_bantuans.id_kategori_bantuan', '=', 'sumber_paket.id_kategori_bantuan')
                ->where('rincian_bantuans.nomor_kk', $request->no_kk)->get();

            // $data['rincianBantuan']= RincianBantuan::when($request->search, function ($query) use ($request) {
            //     $query->where('rincian_bantuans.nomor_kk', 'like', "%{$request->search}%");
            // })->paginate(3);

            // $data['param'] = 'Cari';
            $data['pencarian'] = $request->no_kk;
            // dd($data);

            return view('frontend.view_pencarian',$data);
        }

        // return Voyager::view($view, compact('dataType', 'dataTypeContent', 'paketBantuans', 'penyalurs', 'isModelTranslatable'));

        return view('frontend.pencarian');

    }
}
