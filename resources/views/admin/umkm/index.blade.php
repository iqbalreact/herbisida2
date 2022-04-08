@extends('layouts.master')
@section('title')
    Data UMKM - Permintaan Ulat Jerman
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Manajemen UMKM</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">UMKM</li>
                            {{-- <li class="breadcrumb-item active">Daftar Pengguna</li> --}}
                        </ol>
                    </div>

                </div>

                <div class="button-items mb-2">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>UMKM Baru</button>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manajemen UMK</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama UMKM</th>
                                    <th>Pemilik</th>
                                    <th>Alamat</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($umkm as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->pemilik}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->deskripsi}}</td>
                                    <td>
                                        <div class="button-items">
                                            <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#ModalEdit" onclick="getUmkm('{{$item->id}}')" title="Edit"><i class="bx bx bx-pencil label-icon"></i> Edit</button>
                                            <a href="{{ route('deleteUmkm', $item->id) }}" class="btn btn-danger btn-sm waves-effect waves-light" title="Delete"><i class="bx bx-trash"></i> Delete</a>
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
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah UMKM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('addUmkm') }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="formrow-firstname-input">Nama UMKM</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan nama umkm" required>
                </div>
                <div class="form-group">
                    <label for="formrow-firstname-input">Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" placeholder="Masukan pemilik umkm" required>
                </div>
                <div class="form-group">
                    <label for="formrow-firstname-input">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat umkm" required>
                </div>
                <div class="form-group">
                    <label for="formrow-firstname-input">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" placeholder="Masukan deskripsi" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary waves-effect waves-light">Tambah</button>
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
                <h5 class="modal-title mt-0" id="myModalLabel">Edit UMKM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('updateUmkm') }}">
            @csrf
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control" required>
                        <label for="formrow-firstname-input">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama umkm" id="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Masukan pemilik umkm" id="pemilik" required>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat umkm" id="alamat" required>
                    </div>

                    <div class="form-group">
                        <label for="formrow-firstname-input">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Masukan deskripsi umkm" id="deskripsi" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary waves-effect waves-light">Perbaharui</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('js-pages')

<script>
    var base = '{{url('admin/umkm/id/')}}'
    function getUmkm(id) {
        var url = base+'/'+id
        console.log(url);
        $.get(url, function(data){
            console.log(data);
            $('#id').val(data.id)
            $('#nama').val(data.nama)
            $('#pemilik').val(data.pemilik)
            $('#alamat').val(data.alamat)
            $('#deskripsi').val(data.deskripsi)
        })
    }
</script>




@endsection
