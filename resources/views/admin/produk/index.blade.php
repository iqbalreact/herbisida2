@extends('layouts.master')
@section('title')
    Data Produk - Penjualan Herbisida
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Manajemen Produk</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>

                </div>

                <div class="button-items mb-2">
                    <button type="button" onclick="addProduk()" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>Produk Baru</button>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manajemen Produk</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kode}}</td>
                                    <td>{{$item->nama_produk}}</td>
                                    <td>{{$item->deskripsi}}</td>
                                    <td>
                                        <div class="button-items">
                                            <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#ModalEdit" onclick="getUmkm('{{$item->kode}}')" title="Edit"><i class="bx bx bx-pencil label-icon"></i> Edit</button>
                                            <a href="{{ route('deleteProduk', $item->kode) }}" class="btn btn-danger btn-sm waves-effect waves-light" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bx bx-trash"></i> Delete</a>
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
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('addProduk') }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="formrow-firstname-input">Kode Produk</label>
                    <input type="text" name="kode" id="kodeProduk" class="form-control" readonly placeholder="Masukan Kode Produk" required>
                </div>
                <div class="form-group">
                    <label for="formrow-firstname-input">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Masukan Nama Produk" required>
                </div>
                <div class="form-group">
                    <label for="formrow-firstname-input">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" onclick="return confirm('Yakin ingin menambahkan Item ?');" class="btn btn-primary waves-effect waves-light">Tambah</button>
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
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('updateProduk') }}">
            @csrf
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formrow-firstname-input">Kode Produk</label>
                        <input type="text" name="kode" class="form-control" id="kode" readonly>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" id="nama_produk" required>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" id="deskripsi" required>
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
    var kode = '{{url('admin/produk/kode/')}}'
    function addProduk() {
        $.get(kode, function(kodeProduk){
            console.log(kodeProduk)
            $('#kodeProduk').val(kodeProduk)
        })
    }
</script>


<script>
    var base = '{{url('admin/produk/id/')}}'
    function getUmkm(id) {
        var url = base+'/'+id
        $.get(url, function(data){
            $('#kode').val(data.kode)
            $('#nama_produk').val(data.nama_produk)
            $('#deskripsi').val(data.deskripsi)
        })
    }
</script>




@endsection
