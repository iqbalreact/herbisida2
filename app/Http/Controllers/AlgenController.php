<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker;

use App\Pelayan;
use App\Ruangan;
use App\Talenta;
use App\Waktu;
use App\Jadwal;
use DB;

use Carbon\Carbon;

class AlgenController extends Controller
{
    //

    public function DaftarJadwal() {

        $jadwal = DB::table('jadwal')->select('tanggal')->get()->groupBy('tanggal');
        // return $jadwal;

        $bulan = [];
        $tahun = [];
        foreach ($jadwal as $key => $value) {
            $bulan[] = Carbon::parse($key)->isoFormat('Y-MM-D');
            $tahun[] = Carbon::parse($key)->isoFormat('YYYY');
        }

        // return $bulan;
        $namabulan = array_unique($bulan);
        // return $namabulan;    
        return view ('admin.penjadwalan.daftar', compact('namabulan'));
    }

    public function LihatJadwal ($date) {
        $jadwal = DB::table('jadwal')->where('tanggal', $date)->get()->groupBy('jam');

        // return $jadpelayanwal;
        return view ('admin.penjadwalan.detail', compact('jadwal', 'date'));
    }

    public function HapusJadwal ($date) {
        $jadwal = Jadwal::where('tanggal', $date)->delete();
        return back();
    }


    public function Proses(request $request){
        // return $request;
        $time_start = microtime(true); 
        $generasi = $request->generasi;
        $start = $request->populasi;
        $probcrossover = $request->probcrossover;
        $probmutasi = $request->probmutasi;

        // return $request;
        
        $pelayan = Pelayan::inRandomOrder()->limit(15)
                    ->select('id') //P = Pelayan
                    ->get();
        // return $pelayan;
        // $ruangan = Ruangan::all(); //R = Ruangan

        // $t = Talenta::all(); //T = Talenta
        $waktu = Waktu::whereBetween('tanggal', [$request->dari, $request->sampai])
                ->select('id')
                ->get();
        // return $waktu;
        
        //menentukan panjang kromosong awal
        //jumlah talenta dikalikan dengan jumlah waktu pelayanan dalam satu bulan        
        // $panjangKromosom = $countTalenta * $countWaktu;
        // end panjang kromosom

        $individu = [];
        $populasi = [];
        
        for ($i=1; $i <= $start ; $i++) { 
            foreach ($waktu as $w) {
                $krom = [];
                foreach ($pelayan as $p) {
                    $krom [] = [
    
                        'P' => $p->id,
                        'T' => Talenta::inRandomOrder()->first()->id,
                        'W' => $w->id,
                    ];
                }
                $individu[$w->id] = $krom;
            }   

            $populasi[] = $individu;
        }

        $populasiAwal = $populasi;

        // return $populasi;

        // $fitness = $this->Fitness($populasi);

        // return $fitness;

        //end random generasi

        //new random
        // $population = collect();
        // $krom = [];
        // for ($i=0; $i < 25; $i++) { 
        //     for ($j=0; $j < $countWaktu ; $j++) { 
        //         $randP = rand(0, $countPelayan-1); 
        //         $randR = 0;
        //         $randT = rand(0, $countTalenta-1); 
        //         $randW = rand(0, $countWaktu-1);

        //         $krom[] = [
        //             'P' => $randP, 
        //             'T' => $randT, 
        //             'W' => $randW, 
        //             'R' => $randR
        //         ];

        //     }
        //     return $krom;
        // }
        // $population->push($krom);
        $batas = 0;
        $dataIndividu = collect();
        // return $dataIndividu;
        $oldfitness = 0;
        while ($batas <= $generasi) {

            // return $populasiAwal;
            $dataFitness = $this->Fitness($populasiAwal, $pelayan);
            return $dataFitness;
            return $dataFitness;
            $nilaiFitnessAll = $dataFitness->sum('fitness');
            
            $oldfitness = $nilaiFitnessAll;
            // return $nilaiFitnessAll;
            //kondisi berhenti jika data sudah konvergen
            
            // return $oldfitness;
            $dataIndividu->push(['populasi' => $populasiAwal, 'fitness' => $nilaiFitnessAll]);
            
            //Seleksi dengan rouelette wheel
            $kandidatInduk = $this->RouletteWheel($dataFitness, $nilaiFitnessAll);
            // return $kandidatInduk;

            // hitung probabilitas fitness dan nilai kumulatif probabilitas dan Proses Roulete Wheel
            //cross over menggunakan hasil seleksi rouelette wheel
            $hasilCrossover = $this->CrossOver($kandidatInduk, $probcrossover);
            // return $hasilCrossover;

            // Mutasi
            $hasilmutasi = $this->Mutasi($hasilCrossover, $probmutasi, $populasi, $countPelayan, $countTalenta, $countWaktu);

            // return $hasilmutasi;

            $genBaru = $hasilmutasi;

            $populasiAwal = [];
            foreach ($genBaru as $new => $newPopulation) {
                $populasiAwal [] = $newPopulation['kromosom'];
            }
            $batas++;
        }

        $jadwal = $dataIndividu[count($dataIndividu)-1];
        

        $data = $jadwal['populasi'][0];


        return $data;

        $dataJadwal = collect();
        foreach ($data as $d => $detail) {
            
            $individu = [
                'P' => $pelayan[$detail['P']]->nama,
                'T' => $talenta[$detail['T']]->nama_talenta,
                'W' => $waktu[$detail['W']]->tanggal,
                'J' => $waktu[$detail['W']]->jam,
                'R' => $ruang[$detail['R']]->nama_ruangan,

            ];
            $dataJadwal->push($individu);

            // return $individu;
        }

        $hasil = $dataJadwal->sortBy('W');

        // return $hasil;
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        return $execution_time;
        // foreach ($hasil as $key => $value) {

        //     $tanggal = $value['W'];
        //     $jam = $value['J'];
        //     $namapelayan = $value['P'];
        //     $talenta = $value['T'];
        //     $ruangan = $value['R'];
        //     $jadwal = new Jadwal();
        //     $jadwal->tanggal = $tanggal;
        //     $jadwal->jam = $jam;
        //     $jadwal->pelayan = $namapelayan;
        //     $jadwal->talenta = $talenta;
        //     $jadwal->ruangan = $ruangan;
        //     $jadwal->save();
        // }



        return redirect()->route('daftar-jadwal');

    }

    public function Fitness($populasi){

        $fitnessIndividu = [];
        $fitnessPopulasi = [];

        foreach ($populasi as $k => $t) {
            foreach ($t as $gkey => $g) {
                $fitness = 0;
                foreach ($g as $p1 => $p) {
                    $pelayan = $p['P'];
                    $talenta = $p['T'];
                    $talentaPelayan = Pelayan::where('id', $pelayan)->select('talenta1', 'talenta2', 'talenta3')->first();
                    $waktu = $p['W'];
                    $talenta1 = $talentaPelayan->talenta1;
                    $talenta2 = $talentaPelayan->talenta2;
                    $talenta3 = $talentaPelayan->talenta3;
                    
                    if ($talenta != $talenta1 && $talenta != $talenta2 && $talenta != $talenta3 ) { 
                        $fitness++;
                    }
                    
                    foreach ($g as $p2 => $pe) {
                        $pelayan2 = $pe['P'];
                        if ($p1 != $p2) {
                            if ($pelayan == $pelayan2) {
                                $fitness++;
                            }
                        }
                    }
                }
                $evaluasiFitness = 1/(1+$fitness);
                $fitnessIndividu[$gkey] = [
                    'fitness' => $evaluasiFitness
                ];
            }

            $fitnessPopulasi[$k] = $fitnessIndividu;

        }
        return $fitnessPopulasi;

    }

    public function FitnessA($populasiAwal, $pelayan){
        //Aturan Fitness

        $dataFitness = collect();
        foreach ($populasiAwal as $key => $kromosom) {
            // return $kromosom;
            $number = $key+1;
            $fitness = 0;
            $tidaksesuaibidang = 0;
            $bentrokwaktu = 0;

            foreach ($kromosom as $k => $gen) {
                // return $gen;
                $talenta1 = $pelayan[$gen['P']]->talenta1;
                $talenta2 = $pelayan[$gen['P']]->talenta2;
                $talenta3 = $pelayan[$gen['P']]->talenta3;           
    
                $talenta = $gen['T'];

                if ($talenta != $talenta1 && $talenta != $talenta2 && $talenta != $talenta3) {
                    $fitness++;
                }




                foreach ($kromosom as $keyevaluasi => $evaluasi) {


                    if ($k != $keyevaluasi) {                      

                        if ($gen['P'] == $evaluasi['P'] && $gen['W'] == $evaluasi['W']){
                            //seorang pelayan tidak boleh memiliki waktu pelayan sama dalam satu hari
                            $bentrokwaktu++; 
                            if ($gen['T'] == $evaluasi['T']) {
                                $fitness++;
                                $tidaksesuaibidang++;
                                //seorang pelayan harus menempati bidang sesuai dengan talenta yang dimiliki
                            }

                        }
                    }
                }
            }

            $evaluasiFitness = 1/(1+$fitness);
            // return $fitness;
            $dataFitness->push([
                'fitness' => $evaluasiFitness,
                'tidaksesuaibidang' => $tidaksesuaibidang,
                'bentrokwaktu' => $bentrokwaktu,
                'kromosom'=> $kromosom
            ]);


        }
        
        return $dataFitness;

    }

    public function RouletteWheel($dataFitness, $nilaiFitnessAll){


        // return $dataFitness;
        $dataProb = collect ();
        // $kandidatInduk = collect();
        $faker = Faker\Factory::create();
        $nilaiKumulatifProb = 0;

        foreach ($dataFitness as $key => $kromosom) {
            // return $kromosom['kromosom'];
            $probFitness =  ($kromosom['fitness'] / $nilaiFitnessAll);
            $kumulatif = $nilaiKumulatifProb + $probFitness;
            $nilaiKumulatifProb = $kumulatif;

            // $randomRW = $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1);

            $randomRW = rand(0,10)/10;
            // return $randomRW;

            if ($nilaiKumulatifProb >= $randomRW) {
                // $kandidatInduk->push($prob);
                $dataProb->push([
                    'fitness' => $kromosom['fitness'],
                    'probfitness' => $probFitness,
                    'kumulatifProb' => $nilaiKumulatifProb,
                    'random' => $randomRW,
                    'kromosom' => $kromosom['kromosom']
                ]);
            }
        }


        $kandidatInduk = $dataProb;

        return $kandidatInduk;

    }

    public function CrossOver($kandidatInduk, $probcrossover) {

        //cross over hasil seleksi rouelette wheel
        //pertama hitung banyaknya proses/looping yang akan dilakukan
        $crossover_loop = ceil((count($kandidatInduk)*$probcrossover) / 2);
        $panjangKandidat = count($kandidatInduk)-1;

        $hasilCrossover = collect();
        for ($i=0; $i < $crossover_loop ; $i++) { 
            $randIndex1 = rand(0, $panjangKandidat);
            $randIndex2 = rand(0, $panjangKandidat);

            if ($randIndex1 == $randIndex2) {
                $randIndex1 = rand(0, $panjangKandidat);
                $randIndex2 = rand(0, $panjangKandidat);
            }

            $crosKromosom1 = $kandidatInduk[$randIndex1];
            $crosKromosom2 = $kandidatInduk[$randIndex2];
            
            foreach ($crosKromosom1['kromosom'] as $key => $gen) {
                
                $gen1 = $gen['P'];                

                $gen2 = $crosKromosom2['kromosom'][$key]['P'];

                $cros1 = $gen1 = $gen2;
            }
            

            $cros1 = $crosKromosom1;

            $hasilCrossover->push(
                $cros1
                // $cros2
            );
            
        }

        $hasilCrossover->flatten();

        return $hasilCrossover;
    }

    public function Mutasi($hasilCrossover, $probmutasi, $populasi, $countPelayan, $countTalenta, $countWaktu) {
        
        $panjangCross = count($hasilCrossover)-1;

        //Mutasi Cross over
        $mutasi_loop = ceil($populasi * $probmutasi);
        // return $mutasi_loop;
        // return $panjangCross;
        for ($i=0; $i <= $panjangCross ; $i++) { 

            $randMutasi = rand(0, $panjangCross);
            $randPmutasi = rand(0, $countPelayan-1); 
            $randTmutasi = rand(0, $countTalenta-1); 
            $randWmutasi = rand(0, $countWaktu-1);

            $randIndex = count($hasilCrossover[$randMutasi]['kromosom'])-1;

            $index = rand(0, $randIndex);

            $indexMutasi = $hasilCrossover[$randMutasi]['kromosom'][$index];

            $indexMutasi['P'] = $randPmutasi;
            $indexMutasi['W'] = $randWmutasi;
            // array_push($indexMutasi, ['status' => "mutasi"]);
        }

        $mutasi = $hasilCrossover;
        return $hasilCrossover;

    }

    public function DataIndividu($dataGen, $populasi) {

        $dataGen->flatten();

        for ($i=0; $i < $populasi-1 ; $i++) { 
            // # code...
            return $dataGen[$i];
        }

    }

    

}
