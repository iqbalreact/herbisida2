<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Umkm;
use DB;
use Auth;

class UmkmController extends Controller
{
    //

    public function Umkm(){
        $umkm = Umkm::all();
        return view ('admin.umkm.index', compact('umkm'));
    }

    public function getUmkm($id){
        $umkm = Umkm::findOrFail($id);
        return response()->json($umkm);
    }

    public function addUmkm(request $request){
        $umkm = new Umkm();
        $umkm->nama = $request->nama;
        $umkm->pemilik = $request->pemilik;
        $umkm->alamat = $request->alamat;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->save();
        return back();
    }

    public function updateUmkm(request $request){
        $umkm = Umkm::findOrFail($request->id);
        $umkm->nama = $request->nama;
        $umkm->pemilik = $request->pemilik;
        $umkm->alamat = $request->alamat;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->update();
        return back();
    }

    public function deleteUmkm($id){
        $umkm = Umkm::findOrFail($id)->delete();
        return back();
    }


}
