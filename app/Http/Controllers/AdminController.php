<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
// use App\Warga;
// use App\Provinsi;
// use App\Kota;
// use App\Kecamatan;
// use App\Kelurahan;
// use App\KategoriBantuan;
// use App\KategoriWarga;
// use App\SumberBantuan;
// use App\JenisBantuan;
// use App\PenanggungJawab;
// use App\PaketBantuan;
// use App\DetailPaketBantuan;
// use App\PenerimaBantuan;
// use App\kategoriWarga;
use App\Pelayan;
use App\Ruangan;
use App\Talenta;
use App\Waktu;
use DB;
use Auth;

class AdminController extends Controller
{

    public function Pelayan(){
        $pelayan = Pelayan::all();
        $talenta = Talenta::all();

      

        return view ('admin.pelayan.index', compact('talenta', 'pelayan'));
    }
    
    public function getPelayan($id){
        $pelayan = DB::table('pelayan')
                    ->where('pelayan.id', $id)
                    ->first();
        return response()->json($pelayan);
    }

    public function addPelayan(request $request){
        // return $request->talenta;

        // $talenta = implode(", ", $request->talenta);
        $pelayan = new Pelayan();
        $pelayan->nama = $request->nama;
        $pelayan->no_hp = $request->no_hp;
        $pelayan->talenta1 = $request->talenta1;
        $pelayan->talenta2 = $request->talenta2;
        $pelayan->talenta3 = $request->talenta3;
        $pelayan->tempat_lahir = $request->tempat_lahir;
        $pelayan->tanggal_lahir = $request->tanggal_lahir;
        $pelayan->alamat = $request->alamat;
        $pelayan->email = $request->email;
        $pelayan->save();
        return back();
    }

    public function updatePelayan(request $request){
        // return $request;
        // $talenta = implode(", ", $request->talenta);
        $pelayan = Pelayan::findOrFail($request->id);
        $pelayan->nama = $request->nama;
        $pelayan->no_hp = $request->no_hp;
        $pelayan->talenta1 = $request->talenta1;
        $pelayan->talenta2 = $request->talenta2;
        $pelayan->talenta3 = $request->talenta3;
        $pelayan->tempat_lahir = $request->tempat_lahir;
        $pelayan->tanggal_lahir = $request->tanggal_lahir;
        $pelayan->alamat = $request->alamat;
        $pelayan->email = $request->email;
        $pelayan->update();
        return back();
    }

    public function deletePelayan($id){
        $pelayan = Pelayan::findOrFail($id)->delete();
        return back();
    }

    public function Talenta(){
        $talenta = Talenta::all();
        return view ('admin.talenta.index', compact('talenta'));
    }

    public function getTalenta($id){
        $talenta = Talenta::findOrFail($id);
        return response()->json($talenta);
    }

    public function addTalenta(request $request){
        $talenta = new Talenta();
        $talenta->nama_talenta = $request->nama_talenta;
        $talenta->save();
        return back();
    }

    public function updateTalenta(request $request){
        $talenta = Talenta::findOrFail($request->id);
        $talenta->nama_talenta = $request->nama_talenta;
        $talenta->update();
        return back();
    }

    public function deleteTalenta($id){
        $talenta = Talenta::findOrFail($id)->delete();
        return back();
    }


    public function Ruangan(){
        $ruangan = Ruangan::all();
        return view ('admin.ruangan.index', compact('ruangan'));
    }

    public function getRuangan($id){
        $ruangan = Ruangan::findOrFail($id);;
        return response()->json($ruangan);
    }

    public function addRuangan(request $request){
        $ruangan = new Ruangan();
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas = $request->kapasitas;
        $ruangan->save();
        return back();
    }

    public function updateRuangan(request $request){
        $ruangan = Ruangan::findOrFail($request->id);
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas = $request->kapasitas;
        $ruangan->update();
        return back();
    }

    public function deleteRuangan($id){
        $ruangan = Ruangan::findOrFail($id)->delete();
        return back();
    }


    // Waktu
    public function Waktu(){
        $waktu = Waktu::all();
        return view ('admin.waktu.index', compact('waktu'));
    }

    public function getWaktu($id){
        $waktu = Waktu::findOrFail($id);;
        return response()->json($waktu);
    }

    public function addWaktu(request $request){
        $waktu = new Waktu();
        $waktu->tanggal = $request->tanggal;
        $waktu->jam = $request->jam;
        $waktu->save();
        return back();
    }

    public function updateWaktu(request $request){
        $waktu = Waktu::findOrFail($request->id);
        $waktu->tanggal = $request->tanggal;
        $waktu->jam = $request->jam;
        $waktu->update();
        return back();
    }

    public function deleteWaktu($id){
        $waktu = Waktu::findOrFail($id)->delete();
        return back();
    }


    // Proses Penjadwalan
    public function Penjadwalan(){
        // $waktu = Waktu::all();
        // return "Hello World";
        return view ('admin.penjadwalan.index');
    }

    // public function getWaktu($id){
    //     $waktu = Waktu::findOrFail($id);;
    //     return response()->json($waktu);
    // }

    // public function addWaktu(request $request){
    //     $waktu = new Waktu();
    //     $waktu->tanggal = $request->tanggal;
    //     $waktu->jam = $request->jam;
    //     $waktu->save();
    //     return back();
    // }

    // public function updateWaktu(request $request){
    //     $waktu = Waktu::findOrFail($request->id);
    //     $waktu->tanggal = $request->tanggal;
    //     $waktu->jam = $request->jam;
    //     $waktu->update();
    //     return back();
    // }

    // public function deleteWaktu($id){
    //     $waktu = Waktu::findOrFail($id)->delete();
    //     return back();
    // }


    // penangung jawab
    // public function penanggungJawab(){
    //     $pj = PenanggungJawab::all();
    //     $kelurahans = Kelurahan::all();
    //     return view ('admin.pj.index', compact('pj','kelurahans'));
    // }

    // public function getPenanggungJawab($id){
    //     $pj = PenanggungJawab::findOrFail($id);;
    //     return response()->json($pj);
    // }

    // public function addPenanggungJawab(request $request){
    //     // return $request;
    //     $pj = new PenanggungJawab();
    //     $pj->nik = $request->nik;
    //     $pj->nama_pj = $request->nama;
    //     $pj->alamat = $request->alamat;
    //     $pj->jabatan = $request->jabatan;
    //     $pj->id_kelurahan = $request->id_kelurahan;
    //     $pj->save();
    //     return back();
    // }

    // public function updatePenanggungJawab(request $request){
    //     $pj = PenanggungJawab::findOrFail($request->id);
    //     $pj->nik = $request->nik;
    //     $pj->nama_pj = $request->nama;
    //     $pj->alamat = $request->alamat;
    //     $pj->jabatan = $request->jabatan;
    //     $pj->id_kelurahan = $request->id_kelurahan;
    //     $pj->update();
    //     return back();
    // }

    // public function deletePenanggungJawab($id){
    //     $pj = PenanggungJawab::findOrFail($id)->delete();
    //     return back();
    // }

    // // provinsi
    // public function Provinsi(){
    //     $provinsis = Provinsi::all();
    //     return view ('admin.daerah.provinsi', compact('provinsis'));
    // }

    // public function getProvinsi($id){
    //     $provinsi = Provinsi::where('kode_provinsi', $id)->first();
    //     return response()->json($provinsi);
    // }

    // public function addProvinsi(request $request){
    //     $provinsis = new Provinsi();
    //     $provinsis->kode_provinsi = $request->kode_provinsi;
    //     $provinsis->nama_provinsi = $request->nama_provinsi;
    //     $provinsis->save();
    //     return back();
    // }

    // public function updateProvinsi(request $request){
    //     $provinsis = Provinsi::findOrFail($request->kode_provinsi);
    //     $provinsis->kode_provinsi = $request->kode_provinsi_baru;
    //     $provinsis->nama_provinsi = $request->nama_provinsi;
    //     $provinsis->update();
    //     return back();
    // }

    // public function deleteProvinsi($id){
    //     $provinsis = Provinsi::findOrFail($id)->delete();
    //     return back();
    // }

    // // kota
    // public function Kota(){
    //     $kotas = Kota::all();
    //     $provinsis = Provinsi::all();
    //     return view ('admin.daerah.Kota', compact('kotas', 'provinsis'));
    // }

    // public function getKota($id){
    //     $kota = Kota::where('kode_kota', $id)->first();
    //     return response()->json($kota);
    // }

    // public function addKota(request $request){
    //     $kotas = new Kota();
    //     $kotas->kode_kota = $request->kode_kota;
    //     $kotas->nama_kota = $request->nama_kota;
    //     $kotas->kode_provinsi = $request->kode_provinsi;
    //     $kotas->save();
    //     return back();
    // }

    // public function updateKota(request $request){
    //     $kotas = Kota::findOrFail($request->kode_kota);
    //     $kotas->kode_kota = $request->kode_kota_baru;
    //     $kotas->nama_kota = $request->nama_kota;
    //     $kotas->kode_provinsi = $request->kode_provinsi;
    //     $kotas->update();
    //     return back();
    // }

    // public function deleteKota($id){
    //     $kotas = Kota::findOrFail($id)->delete();
    //     return back();
    // }
    // // end kota

    // // Kecamatan
    // public function Kecamatan(){
    //     $kecamatans = Kecamatan::all();
    //     $kotas = Kota::all();
    //     return view ('admin.daerah.kecamatan', compact('kecamatans','kotas'));
    // }

    // public function getKecamatan($id){
    //     $kecamatans = Kecamatan::where('kode_kecamatan', $id)->first();
    //     return response()->json($kecamatans);
    // }

    // public function addKecamatan(request $request){
    //     $kecamatans = new Kecamatan();
    //     $kecamatans->kode_kecamatan = $request->kode_kecamatan;
    //     $kecamatans->nama_kecamatan = $request->nama_kecamatan;
    //     $kecamatans->kode_kota = $request->kode_kota;
    //     $kecamatans->save();
    //     return back();
    // }

    // public function updateKecamatan(request $request){
    //     $kecamatans = Kecamatan::findOrFail($request->kode_kecamatan);
    //     $kecamatans->kode_kecamatan = $request->kode_kecamatan_baru;
    //     $kecamatans->nama_kecamatan = $request->nama_kecamatan;
    //     $kecamatans->kode_kota = $request->kode_kota;
    //     $kecamatans->update();
    //     return back();
    // }

    // public function deleteKecamatan($id){
    //     $kecamatans = Kecamatan::findOrFail($id)->delete();
    //     return back();
    // }
    // // end kecamatan

    // // Kelurahan
    // public function Kelurahan(){
    //     $kelurahans = Kelurahan::all();
    //     $kecamatans = Kecamatan::all();
    //     return view ('admin.daerah.kelurahan', compact('kelurahans','kecamatans'));
    // }

    // public function getKelurahan($id){
    //     $kelurahans = Kelurahan::findOrFail($id);
    //     return response()->json($kelurahans);
    // }

    // public function addKelurahan(request $request){
    //     $kelurahans = new Kelurahan();
    //     $kelurahans->kode_kelurahan = $request->kode_kelurahan;
    //     $kelurahans->nama_kelurahan = $request->nama_kelurahan;
    //     $kelurahans->kode_kecamatan = $request->kode_kecamatan;
    //     $kelurahans->save();
    //     return back();
    // }

    // public function updateKelurahan(request $request){
    //     $kelurahans = Kelurahan::findOrFail($request->id);
    //     $kelurahans->kode_kelurahan = $request->kode_kelurahan_baru;
    //     $kelurahans->nama_kelurahan = $request->nama_kelurahan;
    //     $kelurahans->kode_kecamatan = $request->kode_kecamatan;
    //     $kelurahans->update();
    //     return back();
    // }

    // public function deleteKelurahan($id){
    //     $kelurahans = Kelurahan::findOrFail($id)->delete();
    //     return back();
    // }

    // public function penerimaBantuan(){
    //     $penerimas = PenerimaBantuan::all();
    //     $pakets = PaketBantuan::all();
    //     $kelurahans = Kelurahan::all();
    //     return view ('admin.bantuan.penerima', compact('penerimas','pakets','kelurahans'));
    // }

    // public function getPenerimaBantuan($id){
    //     $penerima = PenerimaBantuan::findOrFail($id);
    //     return response()->json($penerima);
    // }

    // public function showPenerimaBantuan($id){
    //     $penerimas = PenerimaBantuan::findOrFail($id);
    //     // return response()->json($penerimas);
    //     return view ('admin.bantuan.show', compact('penerimas'));
    // }

    // public function addPenerimaBantuan(request $request){

    //     // return $request;
    //     $penerimas = new PenerimaBantuan();
    //     $penerimas->penerima = $request->penerima;
    //     $penerimas->nama_pj = $request->nama_pj;
    //     $penerimas->nik = $request->nik;
    //     $penerimas->alamat = $request->alamat;
    //     $penerimas->id_kelurahan = $request->id_kelurahan;
    //     $penerimas->id_paket_bantuan = $request->id_paket_bantuan;
    //     $penerimas->jumlah_bantuan = $request->jumlah_bantuan;
    //     $penerimas->jumlah_asuh = $request->jumlah_asuh;
    //     $penerimas->status_diterima = $request->status_diterima;
    //     $penerimas->tanggal_diterima = $request->tanggal_diterima;

    //     if($request->has('foto_ba')) {
    //         $image = $request->file('foto_ba');
    //         $filename = $image->getClientOriginalName();
    //         $image->move(public_path('foto/ba'), $filename);
    //         $penerimas->foto_ba = $filename;
    //     }

    //     if($request->has('foto_bantuan')) {
    //         foreach ($request->file('foto_bantuan') as $image) {
    //             $filename = $image->getClientOriginalName();
    //             $image->move(public_path('foto/bantuan'), $filename);
    //             $data[] = $filename;
    //         }
    //         $penerimas->foto_bantuan = json_encode($data);
    //     }
    //     $penerimas->save();
    //     return back();
    // }

    // public function updatePenerimaBantuan(request $request){
    //     $penerimas = PenerimaBantuan::findOrFail($request->id);
    //     // return $penerimas;
    //     $penerimas->penerima = $request->penerima;
    //     $penerimas->nama_pj = $request->nama_pj;
    //     $penerimas->nik = $request->nik;
    //     $penerimas->alamat = $request->alamat;
    //     $penerimas->id_kelurahan = $request->id_kelurahan;
    //     $penerimas->id_paket_bantuan = $request->id_paket_bantuan;
    //     $penerimas->jumlah_bantuan = $request->jumlah_bantuan;
    //     $penerimas->jumlah_asuh = $request->jumlah_asuh;
    //     $penerimas->status_diterima = $request->status_diterima;
    //     $penerimas->tanggal_diterima = $request->tanggal_diterima;


    //     if($request->has('foto_ba')) {
    //         $image = $request->file('foto_ba');
    //         $filename = $image->getClientOriginalName();
    //         $image->move(public_path('foto/ba'), $filename);
    //         $penerimas->foto_ba = $filename;
    //     }

    //     if($request->has('foto_bantuan')) {
    //         foreach ($request->file('foto_bantuan') as $image) {
    //             $filename = $image->getClientOriginalName();
    //             $image->move(public_path('foto/bantuan'), $filename);
    //             $data[] = $filename;
    //         }
    //         $penerimas->foto_bantuan = json_encode($data);
    //     }
    //     $penerimas->update();
    //     return back();
    // }

    // public function deletePenerimaBantuan($id){
    //     $penerimas = PenerimaBantuan::findOrFail($id);
    //     // return $penerimas->foto_ba;
    //     // File::delete(public_path().'/foto/ba/'.$penerimas->foto_ba);
    //     $foto = explode(",", $penerimas->foto_bantuan);
    //     foreach ($foto as $item) {
    //         $foto = public_path().'/foto/bantuan/'.$item;
    //         File::delete($foto);
    //     }
    //     $penerimas->delete();
    //     return back();
    // }

    // public function reportKolektif(){
    //     $lists = ListData::all();
    //     $kolektif = DB::table('distribusi_kolektifs')
    //                     ->join('list_datas', 'list_datas.id_list', '=', 'distribusi_kolektifs.id_list')
    //                     ->join('wargas', 'wargas.nomor_kk', '=', 'distribusi_kolektifs.nomor_kk')
    //                     ->join('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=' , 'list_datas.id_paket_bantuan')
    //                     ->where('list_datas.status_list', '1')
    //                     // ->where('', 1)
    //                     ->get();
    //     // return $kolektif;
    //     return view ('admin.distribusi.kolektif.report', compact('kolektif','lists'));
    // }

    // public function reportIndividu(){
    //     $individu = DB::table('distribusi_individus')
    //                     ->join('list_datas', 'list_datas.id_list', '=', 'distribusi_individus.id_list')
    //                     ->join('wargas', 'wargas.nomor_kk', '=', 'distribusi_individus.nomor_kk')
    //                     ->join('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=' , 'list_datas.id_paket_bantuan')
    //                     // ->where('distribusi_individus.id_list', $id)
    //                     ->where('list_datas.status_list', '1')
    //                     ->get();
    //     // return $individu;
    //     return view ('admin.distribusi.individu.report', compact('individu'));
    // }

    // public function reportDiantar(){
    //     $diantar = DB::table('distribusi_diantars')
    //                     ->join('list_datas', 'list_datas.id_list', '=', 'distribusi_diantars.id_list')
    //                     ->join('wargas', 'wargas.nomor_kk', '=', 'distribusi_diantars.nomor_kk')
    //                     ->join('paket_bantuans', 'paket_bantuans.id_paket_bantuan', '=' , 'list_datas.id_paket_bantuan')
    //                     // ->where('distribusi_diantars.id_list', $id)
    //                     ->where('list_datas.status_list', '1')
    //                     ->get();
    //     // return $diantar;
    //     return view ('admin.distribusi.diantar.report', compact('diantar'));
    // }


}
