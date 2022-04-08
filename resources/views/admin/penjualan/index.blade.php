@extends('layouts.master')
@section('title')
    Data Penjualan - Penjualan Herbisida
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Manajemen Penjualan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Penjualan</li>
                            {{-- <li class="breadcrumb-item active">Daftar Pengguna</li> --}}
                        </ol>
                    </div>

                </div>

                <div class="button-items mb-2">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>Penjualan Baru</button>
                </div>
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
                        <h4 class="card-title">Manajemen Penjualan</h4>
                        <table id="myTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    {{-- <th>Nama Produk</th> --}}
                                    <th>Tanggal</th>
                                    <th>Kuantitas</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->tanggal)->isoFormat('MMMM YYYY')}}</td>
                                    <td>{{$item->kuantitas}}</td>
                                    <td>Item</td>
                                    <td>
                                        <div class="button-items">
                                            <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#ModalEdit" onclick="getPenjualan('{{$item->id}}')" title="Edit"><i class="bx bx bx-pencil label-icon"></i> Edit</button>
                                            <a href="{{ route('deletePenjualan', $item->id) }}" class="btn btn-danger btn-sm waves-effect waves-light" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bx bx-trash"></i> Delete</a>
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

<!-- modal user -->
<div id="ModalPengguna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('addPenjualan') }}">
                @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="formrow-firstname-input">Kode Produk</label>
                    <select name="kode" id="" class="form-control">
                        <option value="">Pilih</option>
                        @foreach ($produk as $p)
                        <option value="{{$p->kode}}">{{$p->kode}} - {{$p->nama_produk}}</option>
                        @endforeach
                    </select>
                    {{-- <input type="month" name="tanggal" class="form-control" required> --}}
                </div>

                <div class="form-group">
                    <label for="formrow-firstname-input">Tanggal</label>
                    <input type="month" name="tanggal" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="formrow-firstname-input">Kuantitas</label>
                    <input type="number" name="kuantitas" class="form-control" placeholder="Masukan kuantitas umkm" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary waves-effect waves-light" onclick="return confirm('Yakin ingin menambahkan penjualan ?');">Tambah</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- modal edit user -->
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('updatePenjualan') }}">
            @csrf
            <div class="modal-body">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control" required>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Kode</label>
                        <input type="text" name="kode" class="form-control" id="kode" readonly>
                    </div>
                    <div class="form-group">
                        <label for="formrow-firstname-input">Tanggal</label>
                        <input type="month" name="tanggal" class="form-control" id="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Kuantitas</label>
                        <input type="number" name="kuantitas" class="form-control" placeholder="Masukan kuantitas" id="kuantitas" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary waves-effect waves-light" onclick="return confirm('Yakin ingin memperbaharui Item ?');">Perbaharui</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('js-pages')

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>


<script>
    var base = '{{url('admin/penjualan/id/')}}'
    function getPenjualan(id) {
        var url = base+'/'+id
        console.log(url);
        $.get(url, function(data){
            // console.log(data);
            $('#id').val(data.id)
            $('#kode').val(data.kode)
            $('#tanggal').val(data.tanggal)
            $('#kuantitas').val(data.kuantitas)
        })
    }
</script>




@endsection
