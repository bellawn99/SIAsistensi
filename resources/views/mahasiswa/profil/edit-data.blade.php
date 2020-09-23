@extends('layouts.master')

@section('icon')
<i class="mdi mdi-account menu-icon"></i>
@endsection

@section('title')
<a href="{{url('mahasiswa/profil')}}" style="color:black; text-decoration:none">Profil Mahasiswa</a> / <a style="color:grey; text-decoration:none">Ubah Data Diri</a>
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
                    <h4 class="card-title">Ubah Data Diri</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('mahasiswa/profil/update-data/'.Auth::user()->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{$users->username}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="email" name="email" value="{{$users->email}}">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$users->nama}}">
                      </div>
                      <div class="form-group">
                        <label for="nim">NIM</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{$mahasiswas->nim}}">
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No Telepon</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$users->no_hp}}">
                      </div>
                      <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>&nbsp;<span>*</span>
                        <select name="jk" class="form-control">
                                <option value="P" @if($mahasiswas->jk == "P") selected @endif>Perempuan</option>
                                <option value="L" @if($mahasiswas->jk == "L") selected @endif>Laki-laki</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="nik">NIK</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{$mahasiswas->nik}}">
                      </div>
                      <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" value="{{$mahasiswas->npwp}}">
                      </div>
                      <div class="form-group">
                        <label for="tempat">Tempat Lahir</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{$mahasiswas->tempat}}">
                      </div>
                      <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>&nbsp;<span>*</span>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{$mahasiswas->tgl_lahir}}">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$mahasiswas->alamat}}">
                      </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('mahasiswa/profil')}}'">Batal</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
@endsection

@push('js')
<script>

    $(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
    });
</script>
@endpush