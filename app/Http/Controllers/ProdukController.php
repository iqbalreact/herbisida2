<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use DB;
use Auth;


class ProdukController extends Controller
{

    public function getKode(){
        if (count(Produk::all()) != null) {
            $produk = Produk::max('kode');
            $split = explode('-', $produk);
            $kodeLanjutan = $split[1]+1;
            return 'HRB-'.$kodeLanjutan;
        } else {
            return 'HRB-1';
        }
    }

    public function Produk(){
        $produk = Produk::all();
        return view ('admin.produk.index', compact('produk'));
    }

    public function getProduk($id){
        $produk = Produk::where('kode', $id)->first();
        return response()->json($produk);
    }

    public function addProduk(request $request){
        $produk = new Produk();
        $produk->kode = $request->kode;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();
        return back();
    }

    public function updateProduk(request $request){
        $produk = Produk::where('kode', $request->kode)->first();
        // return $produk;
        $produk->kode = $request->kode;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->update();
        return back();
    }

    public function deleteProduk($id){
        $produk = Produk::where('kode', $id)->delete();
        return back();
    }

}