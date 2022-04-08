@extends('layouts.master')
@section('title')
    Prediksi - Penjualan Herbisida
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
                            <li class="breadcrumb-item active">Prediksi Penjualan</li>
                            {{-- <li class="breadcrumb-item active">Daftar Pengguna</li> --}}
                        </ol>
                    </div>

                </div>

                {{-- <div class="button-items mb-2">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>Penjualan Baru</button>
                </div> --}}
                @if($errors->any())
                <h5>{{$errors->first()}}</h5>
                @endif
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Prediksi Penjualan Herbisida</h4>
                        <form method="POST" action="{{ route('proses-prediksi') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Pilih Produk</label>
                                        <select name="kode" id="" class="form-control" required>
                                            <option value="">Pilih</option>
                                            @foreach ($produk as $p)
                                            <option value="{{$p->kode}}">{{$p->nama_produk}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="alpha" value="0.4" class="form-control" placeholder="Masukan Alpha" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Tanggal</label>
                                        <input type="month" name="tanggal" class="form-control" id="tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary waves-effect" data-dismiss="modal">Reset</button>
                                <button type="sumbit" class="btn btn-primary waves-effect waves-light" onclick="return confirm('Yakin untuk memprediksi?');">Prediksi</button>
                            </div>
                        </form>
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
