@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('admin/berita')}}" style="color:black; text-decoration:none">Berita</a> / <a style="color:grey; text-decoration:none">Ubah Berita</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Ubah Data Berita</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/berita/update/'.$beritas->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$beritas->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="judul">Judul</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{$beritas->judul}}">
                      </div>
                      <div class="form-group">
                        <label for="isi">Isi</label>&nbsp;<span>*</span>
                        <textarea class="form-control message" id="isi" name="isi" value="{{$beritas->isi}}">{{ $beritas->isi }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>&nbsp;<span>*</span>
                        <div class="col-md-12">
                          <input type="file" class="custom-file-input" name="foto" id="kolomEditFoto" lang="in">
                          <label class="custom-file-label" for="kolomEditFoto" data-browse="Cari"value="{{$beritas->foto}}">{{$beritas->foto}}</label>                         
                        </div>
                        </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/berita')}}'">Batal</button>
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

    $(function () {
    $("#message").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        alert(code);
        if (code == 13) {
            $("#submit").trigger('click');
            return true;
        }
    });
    });

    $('#kolomEditFoto').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush