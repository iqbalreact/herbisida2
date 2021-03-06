<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prediksi;
use App\Produk;
use App\Penjualan;
use DB;
use Auth;
use Carbon\Carbon;

class PrediksiController extends Controller
{
    //

    public function index() {
        $produk = Produk::all();
        return view ('admin.prediksi.index', compact('produk'));
    }

    public function data() {
        $data = Prediksi::all();
        return view ('admin.prediksi.data', compact('data'));
    }

    public function simpan(request $request) {
        $prediksi = new Prediksi();
        $prediksi->alpha = $request->alpha;
        $prediksi->tanggal = $request->tanggal;
        $prediksi->prediksi = $request->prediksi;
        $prediksi->save();
        return view ('admin.prediksi.index');
    }

    public function deletePrediksi($id){
        $prediksi = Prediksi::findOrFail($id)->delete();
        return back();
    }

    //Route Proses Prediksi

    public function Prediksi(request $request){

        
        $alpha = 0.4;
        
        $kode = $request->kode;
        $tanggal = $request->tanggal;
        $data = Penjualan::where('kode', $kode)->orderBy('tanggal', 'desc')->limit(2)->get();
        
        if (count($data) != null) {
            $bulanMax = $data[0]['tanggal'];
            $tanggalPilihan = Carbon::parse($tanggal);
            $batasBulan = Carbon::parse($bulanMax)->addMonths(1);
            if ($tanggal <= $data[0]['tanggal']) {
                return back()->withErrors(['msg' => "Data Pada ".Carbon::parse($tanggal)->isoFormat('MMMM YYYY'). " Telah Tersedia, Silahkan Prediksi Pada ". Carbon::parse($batasBulan)->isoFormat('MMMM YYYY')]);
            }
    
            if ($tanggalPilihan > $batasBulan ) {
                return back()->withErrors(['msg' =>"Data Bulan ". Carbon::parse($batasBulan)->isoFormat('MMMM YYYY'). " Belum di Prediksi!"]);
            }
    
            if (count($data) < 12) {
                return back()->withErrors(['msg' => "Data untuk memprediksi kurang, minimal 12 bulan data!"]);
            }
    
            $data = Penjualan::where('kode', $kode)->limit(12)->orderBy('tanggal','desc')->get();
            $penjualan = $data->sortBy(function($col) {
                return $col;
            })->values()->all();
        
            //smoothing1
            $smoothingOne = [];
            
            $data = collect();
            
     
            
            $xt = $penjualan[0]['kuantitas'];
            $xt2 = $penjualan[0]['kuantitas'];
            for ($i=1; $i < count($penjualan) ; $i++) { 
                $xtnew = $penjualan[$i]['kuantitas'];
                $smoothOne = ($alpha*$xtnew)+(1-$alpha)*$xt;
    
                $data->push([
                    'xt' => $xt,
                    'st' => $smoothOne,
                ]);
    
            
                $xt = $smoothOne;
                $smoothingOne [] = $smoothOne;
            }
    
            //smoothing1
            for ($d=0; $d < count($smoothingOne) ; $d++) { 
                $xt2new = $smoothingOne[$d];
                $smoothTwo = ($alpha*$xt2new)+(1-$alpha)*$xt2;
                $data->push([
                    'xt' => $xt2,
                    'st' => $smoothTwo,
                ]); 
    
                $xt2 = $smoothTwo;
                $smoothingTwo [] = $smoothTwo;
            }
    
            //konstanta(AT) dan Slope (BT)
            $at = [];
            $bt = [];
    
            foreach ($smoothingOne as $key => $value) {
                $sm1 = $value;
                $sm2 = $smoothingTwo[$key];
                // rumus AT
                $nilaiAT = (2*$sm1)-$sm2;
                $at[] = $nilaiAT;
    
                // Rumus BT
                $nilaiBT = ($alpha/(1-$alpha))*($sm1-$sm2);
                $bt [] = $nilaiBT;
            }
    
            // return $bt;
    
            //forecast
            $forecast = [null,];
            foreach ($at as $keyAt => $vAt) {
                $vBt = $bt[$keyAt];
                $nilai = $vAt+($vBt*1);
                array_push($forecast, $nilai);
                // $forecast[] = $nilai;
            }
            //Nilai Prediksi Akhir
            $prediksi = $vAt+($vBt*1);
    
            // return $prediksi;
            return view ('admin.prediksi.hasil', compact ('alpha','tanggal', 'prediksi','smoothingOne', 'smoothingTwo', 'at', 'bt', 'forecast'));

        }
        else {
            return back()->withErrors(['msg' => "Data tidak tersedia!"]);
        }

    }

}
