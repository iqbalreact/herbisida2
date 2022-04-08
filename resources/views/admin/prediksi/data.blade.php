@extends('layouts.master')
@section('title')
    Data Hasil Prediksi - Penjualan Herbisida
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Data Prediksi Penjualan Herbisida</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Hasil Prediksi Penjualan</li>
                            {{-- <li class="breadcrumb-item active">Daftar Pengguna</li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Data Prediksi Penjualan Herbisida</h4> --}}
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Alpa</th>
                                    <th>Bulan dan Tahun</th>
                                    {{-- <th>Tahun</th> --}}
                                    <th>Jumlah Prediksi</th>
                                    <!-- <th>Nilai Alpha</th> -->
                                    <!-- <th>Prediksi</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->alpha}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->tanggal)->isoFormat('Do MMMM YYYY')}}</td>
                                    <td>{{$item->prediksi}} Kg</td>
                                    <td>
                                        <div class="button-items">
                                            <a href="{{ route('deletePrediksi', $item->id) }}" class="btn btn-danger btn-sm waves-effect waves-light" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete"><i class="bx bx-trash"></i> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection

@section('js-pages')


@endsection
