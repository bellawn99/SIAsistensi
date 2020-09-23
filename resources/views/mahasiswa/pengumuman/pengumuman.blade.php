@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-book menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('mahasiswa/pengumuman')}}" style="color:black; text-decoration:none">Daftar Pengumuman</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  @if(count($awals) == 0)
                    <h3><center>BUKAN PERIODE PENGUMUMAN ASISTENSI</center></h3>
                  
                  @else
                    <h4 class="card-title">Daftar Pengumuman</h4>
                    
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

                  
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kelas</th>    
                            <th>Semester</th>
                            <th>Matakuliah</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Akhir</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($pengumumans as $index => $item)
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>
                            @if($item->status === "diterima")
                            <label class="badge badge-gradient-success">Diterima</label>
                            @elseif($item->status === "ditolak")
                            <label class="badge badge-gradient-danger">Ditolak</label>
                            @elseif($item->status === "daftar")
                            <label class="badge badge-gradient-warning">Diproses</label>
                            @endif
                            </td>
                            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{$item->id}}" ><i class=" mdi mdi-eye "></i></button></tr>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  
                  @endif

<!-- Detail Praktikum Modal -->
@foreach ($pengumumans as $item)
<div class="modal fade" id="detail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table style="border:0">
        <tr>
          <td>Nama Kelas</td>
          <td>:</td>
          <td>{{ $item->nama }}</td>
        </tr>
        <tr>
          <td>Semester</td>
          <td>:</td>
          <td>{{ $item->semester }}</td>
        </tr>
        <tr>
          <td>Nama Matakuliah</td>
          <td>:</td>
          <td>{{ $item->nama_matkul }}</td>
        </tr>
        <tr>
          <td>Nama Dosen</td>
          <td>:</td>
          <td>{{ $item->nama_dosen }}</td>
        </tr>
        <tr>
          <td>Hari</td>
          <td>:</td>
          <td>{{ $item->hari }}</td>
        </tr>
        <tr>
          <td>Jam Mulai</td>
          <td>:</td>
          <td>{{ $item->jam_mulai }}</td>
        </tr>
        <tr>
          <td>Jam Akhir</td>
          <td>:</td>
          <td>{{ $item->jam_akhir }}</td>
        </tr>
        <tr>
          <td>Nama Ruangan</td>
          <td>:</td>
          <td>{{ $item->nama_ruangan }}</td>
        </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2 btn-sm" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail Praktikum Modal -->


                  </div>
                </div>
              </div>
@endsection

@push('js')
<script>
$(document).ready(function(){
    // var table =  
    $('#tabel-user').DataTable({
      'responsive' : true,
      'autoWidth' : false,
      "scrollX": true,
      'language' : {
                        'search' : "_INPUT_",
                        'searchPlaceholder' : "Search",
                        'autoWidth' : false

                      },
    });

});
</script>
@endpush