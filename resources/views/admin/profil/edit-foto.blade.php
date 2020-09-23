@extends('layouts.master')

@section('icon')
<i class="mdi mdi-account menu-icon"></i>
@endsection

@section('title')
<a href="{{url('admin/profil')}}" style="color:black; text-decoration:none">Profil</a> / <a style="color:grey; text-decoration:none">Ubah Foto</a>
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
                    <h4 class="card-title">Ubah Foto</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/profil/update-foto/'.Auth::user()->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <div class="col-md-12">
                          <label for="foto">Foto</label>&nbsp;<span>*</span>
                          <input type="file" class="custom-file-input" name="foto" id="kolomEditFoto" lang="in" value="{{ $users->foto }}">
                          <label class="custom-file-label" for="kolomEditFoto" data-browse="Cari" value="{{$users->foto}}">{{$users->foto}}</label>                         
                        </div>
                      </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/profil')}}'">Batal</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
@endsection

@push('js')
<script>
    $('#kolomEditFoto').on('change',function(){
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