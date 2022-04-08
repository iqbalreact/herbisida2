@extends('layouts.master')

@section('title')
    Data Pengguna - 
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Manajemen Pengguna</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item">Manajemen Pengguna</li>
                            <li class="breadcrumb-item active">Daftar Pengguna</li>
                        </ol>
                    </div>

                </div>

                <div class="button-items mb-2">
                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" data-toggle="modal" data-target="#ModalPengguna"><i class="bx bx-user-plus label-icon"></i>Pengguna</button>
                </div>
                @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                @endif

            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Pengguna </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            {{$user->getRoleNames()->first()}}
                                        </td>
                                        <td>
                                            <div class="button-items">
                                                <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#ModalEdit" onclick="getPengguna({{$user->id}})"><i class="bx bx bx-pencil label-icon"></i> Edit</button>
                                                {{-- <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteRole({{$role->id}})" ><i class="bx bx bx-trash label-icon"></i> Delete</button> --}}
                                                <a href="{{ route('delete-pengguna', $user->id) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm waves-effect waves-light" title="Edit" id="sa-warning""><i class="bx bx-trash"></i> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
            <!-- end col -->
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
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('pengguna.store') }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="formrow-firstname-input">Nama Pengguna</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="formrow-email-input">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="formrow-password-input">Password</label>
                    <input type="password" name="password" minlength="6" class="form-control" id="Password" required>
                </div>

                <div class="form-group">
                    <label for="formrow-password-input">Konfirmasi Password</label>
                    <input type="password" name="konfirm_password" minlength="6" class="form-control" id="ConfirmPassword" required>
                    <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                </div>

                <div class="form-group">
                    <label for="formrow-inputState">Peran Pengguna</label>
                    <select name="role" class="form-control" required>
                        <option value="" selected>Choose...</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="AddUser" onclick="return confirm('Yakin ingin menambahkan pengguna ?');">Tambah</button>
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
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('update-pengguna') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="formrow-firstname-input">Nama Pengguna</label>
                    <input type="hidden" name="id" class="form-control" id="id">
                    <input type="text" name="name" class="form-control" id="nama">
                </div>
                <div class="form-group">
                    <label for="formrow-email-input">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="formrow-password-input">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="formrow-inputState">Peran Pengguna</label>
                    <select name="role" class="form-control">
                        <option value="" selected>Choose...</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="sumbit" class="btn btn-primary waves-effect waves-light" onclick="return confirm('Yakin ingin memperbaharui ?');">Perbaharui</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- modal edit user -->
<div id="ModalEditPeran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Peran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('update-peran') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="formrow-firstname-input">Nama Pengguna</label>
                    <input type="hidden" name="id" class="form-control" id="id-peran">
                    <input type="text" name="name" class="form-control" id="nama-peran">
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
    $(document).ready(function () {
       $("#ConfirmPassword").on('keyup', function(){
        var password = $("#Password").val();
        var confirmPassword = $("#ConfirmPassword").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Password does not match !").css("color","red");
            // $("#AddUser").attr('disabled', true);
        else
            $("#CheckPasswordMatch").html("Password match !").css("color","green");
            // $("#AddUser").prop('disabled', true);
       });
    });
</script>

<script>
    var pengguna = '{{url('admin/pengguna/get')}}';
    var role = '{{url('admin/peran/get')}}';

    function getPengguna(id) {
        var url = pengguna+'/'+id
        $.get(url, function(data){
            var pass = toString(data.password);
            $('#id').val(data.id)
            $('#nama').val(data.name)
            $('#email').val(data.email)
            $('#password').val(data.password)
        })

    }

    function getRole(id) {
        var url = role+'/'+id
        $.get(url, function(data){
            // console.log(data);
            $('#id-peran').val(data.id)
            $('#nama-peran').val(data.name)
        })
    }
</script>




@endsection
