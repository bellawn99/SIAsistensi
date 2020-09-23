@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('admin/praktikum')}}" style="color:black; text-decoration:none">Praktikum</a> / <a style="color:grey; text-decoration:none">Ubah Praktikum</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Ubah Data Praktikum</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/praktikum/update/'.$praktikums->id)}}">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$praktikums->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="matkul_id">Matakuliah</label>&nbsp;<span>*</span>
                        <select name='matkul_id' class='form-control'>
                        @foreach ($matkuls as $value)
                                <option value="{{ $value->id }}" {{ $praktikums->matkul_id == $value->id ? 'selected' : '' }}>{{ $value->nama_matkul }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="dosen_id">Dosen</label>&nbsp;<span>*</span>
                        <select name='dosen_id' class='form-control'>
                        @foreach ($dosens as $value)
                                <option value="{{ $value->id }}" {{ $praktikums->dosen_id == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jadwal_id">Jadwal</label>&nbsp;<span>*</span>
                        <select name='jadwal_id' class='form-control'>
                        @foreach ($jadwals as $value)
                                <option value="{{ $value->id }}" {{ $praktikums->jadwal_id == $value->id ? 'selected' : '' }}>{{ $value->hari }} , {{ $value->jam_mulai }}-{{ $value->jam_akhir }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ruangan_id">Ruangan</label>&nbsp;<span>*</span>
                        <select name='ruangan_id' class='form-control'>
                        @foreach ($ruangans as $value)
                                <option value="{{ $value->id }}" {{ $praktikums->ruangan_id == $value->id ? 'selected' : '' }}>{{ $value->nama_ruangan }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelas_id">Kelas</label>&nbsp;<span>*</span>
                        <select name='kelas_id' class='form-control'>
                        @foreach ($kelass as $value)
                                <option value="{{ $value->id }}" {{ $praktikums->kelas_id == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>&nbsp;<span>*</span>
                        <select name="semester" class="form-control">
                                <option value="1" @if($semesters->semester == "1") selected @endif>1</option>
                                <option value="2" @if($semesters->semester == "2") selected @endif>2</option>
                                <option value="3" @if($semesters->semester == "3") selected @endif>3</option>
                                <option value="4" @if($semesters->semester == "4") selected @endif>4</option>
                                <option value="5" @if($semesters->semester == "5") selected @endif>5</option>
                                <option value="6" @if($semesters->semester == "6") selected @endif>6</option>
                            </select>
                      </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/praktikum')}}'">Batal</button>
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