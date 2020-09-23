@extends('layouts.master')

@section('icon')
<i class="mdi mdi-av-timer menu-icon"></i>
@endsection

@section('title')
<a href="{{url('admin/periode')}}" style="color:black; text-decoration:none">Periode</a> / <a style="color:grey; text-decoration:none">Ubah Periode</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Ubah Data Periode</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/periode/update/'.$periodes->berita_id)}}">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$periodes->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai</label>&nbsp;<span>*</span>
                        <input class="form-control" type="date" id="tgl_mulai" name="tgl_mulai" value="{{$periodes->tgl_mulai}}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input class="form-control" type="date" id="tgl_selesai" name="tgl_selesai" value="{{$periodes->tgl_selesai}}">
                    </div>
                      <div class="form-group">
                        <label for="thn_ajaran">Tahun Ajaran</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" id="thn_ajaran" name="thn_ajaran" value="{{$periodes->thn_ajaran}}">
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>&nbsp;<span>*</span>
                        <select name="semester" class="form-control">
                                <option value="Genap" @if($periodes->semester == "genap") selected @endif>Genap</option>
                                <option value="Ganjil" @if($periodes->semester == "ganjil") selected @endif>Ganjil</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>&nbsp;<span>*</span>
                        <select name="status" class="form-control">
                                <option value="Daftar" @if($periodes->status == "daftar") selected @endif>Daftar</option>
                                <option value="Pengumuman" @if($periodes->status == "pengumuman") selected @endif>Pengumuman</option>
                            </select>
                      </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/periode')}}'">Batal</button>
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