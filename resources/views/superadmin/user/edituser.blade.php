@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('superadmin/master/user')}}" style="color:black; text-decoration:none">Master User</a> / <a style="color:grey; text-decoration:none">Edit User</a>
@endsection

@push('css')
<style type="text/css">
    $custom-file-text: (
in: "Cari",
);
</style>
@endpush
@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data User</h4>
                    
                  @if (count($errors)>0)
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert">
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/master/user/update/'.$users->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$users->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="role_id">Nama Role</label>
                        <select name='role_id' class='form-control'>
                                <option value="1" @if($users->role_id == "1") selected @endif>Admin</option>
                                <option value="2" @if($users->role_id == "2") selected @endif>Mahasiswa</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$users->nama}}">
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{$users->username}}">
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$users->no_hp}}">
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="col-md-12">
                          <input type="file" class="custom-file-input" name="foto" id="kolomEditUser" lang="in" value="{{ $users->foto }}">
                          <label class="custom-file-label" for="kolomEditUser" data-browse="Cari" value="{{$users->foto}}">{{$users->foto}}</label>                         
                        </div>
                      </div>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Edit">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/master/user')}}'">Batal</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
@endsection

@push('js')
<script>
    $('#kolomEditUser').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
    });
</script>
@endpush