<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Produk;
use DB;
use Auth;

class PenjualanController extends Controller
{

    public function Penjualan(){
        $penjualan = Penjualan::all();
        $produk = Produk::all();
        return view ('admin.penjualan.index', compact('penjualan', 'produk'));
    }

    public function getPenjualan($id){
        $penjualan = Penjualan::where('id', $id)->first();
        return response()->json($penjualan);
    }

    public function addPenjualan(request $request){

        $kode = $request->kode;
        $tanggal = $request->tanggal;

        $find = Penjualan::where('kode', $kode)->where('tanggal', $tanggal)->first();
        // return $find;
        if ($find == null) {
            $penjualan = new Penjualan();
            $penjualan->kode = $request->kode;
            $penjualan->tanggal = $request->tanggal;
            $penjualan->kuantitas = $request->kuantitas;
            $penjualan->save();
            return back();
            # code...
        }else {
            // return 'Data Telah Tersedia !';
            return back()->withErrors(['msg' => "Data yang dimasukan telah tersedia !"]);
        }

    }

    public function updatePenjualan(request $request){
        $penjualan = Penjualan::where('id',$request->id)->update([
            'kode' => $request->kode,
            'tanggal' => $request->tanggal,
            'kuantitas' => $request->kuantitas
        ]);
        return back();
    }

    public function deletePenjualan($id){
        $penjualan = Penjualan::where('id',$id)->delete();
        return back();
    }

}
