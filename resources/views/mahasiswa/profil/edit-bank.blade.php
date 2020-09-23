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
                    <h4 class="card-title">Ubah Data Bank</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('mahasiswa/profil/update-bank/'.$mahasiswas['id'])}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="{{$mahasiswas->nama_bank}}">
                      </div>
                      <div class="form-group">
                        <label for="no_rekening">No Rekening</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{$mahasiswas->no_rekening}}">
                      </div>
                      <div class="form-group">
                        <label for="nama_rekening">Nama Rekening</label>&nbsp;<span>*</span>
                        <input type="nama_rekening" class="form-control" id="nama_rekening" name="nama_rekening" value="{{$mahasiswas->nama_rekening}}">
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