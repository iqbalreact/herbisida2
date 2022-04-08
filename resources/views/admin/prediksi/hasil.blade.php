@extends('layouts.master')
@section('title')
    Hasil Prediksi - Penjualan Herbisida
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    {{-- <h4 class="mb-0 font-size-18">Manajemen Penjualan</h4> --}}
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Hasil Prediksi Penjualan</li>
                            {{-- <li class="breadcrumb-item active">Daftar Pengguna</li> --}}
                        </ol>
                    </div>

                </div>

                {{-- <div class="button-items mb-2">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>Penjualan Baru</button>
                </div> --}}

            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Prediksi Penjualan Herbisida </h4>
                        <small style="font-style:italic">Berikut adalah hasil prediksi Penjualan Herbisida dengan Double Exponential Smoothing (Alpha : {{$alpha}})</small>
                        <hr>
                        <table>
                            <tr>
                                <td>Bulan</td>
                                <td>: </td>
                                <td style="font-weight: bold"> {{\Carbon\Carbon::parse($tanggal)->isoFormat('MMMM YYYY')}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>: </td>
                                <td style="font-weight: bold"> {{$prediksi}} Kg</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <form method="POST" action="{{ route('simpan-prediksi') }}">
                    @csrf
                    <input type="hidden" name="alpha" value="{{$alpha}}">
                    <input type="hidden" name="tanggal" value="{{$tanggal}}">
                    <input type="hidden" name="prediksi" value="{{$prediksi}}">
                    <button type="reset" class="btn btn-secondary waves-effect" data-dismiss="modal">Kembali</button>
                    <button type="sumbit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </form>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection

@section('js-pages')
{{-- 
<script>
    var base = '{{url('admin/penjualan/id/')}}'
    function getPenjualan(id) {
        var url = base+'/'+id
        console.log(url);
        $.get(url, function(data){
            console.log(data);
            $('#id').val(data.id)
            $('#tanggal').val(data.tanggal)
            $('#kuantitas').val(data.kuantitas)
        })
    }
</script> --}}

@endsection
