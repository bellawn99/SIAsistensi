@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-book menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('mahasiswa/daftar')}}" style="color:black; text-decoration:none">Daftar Asistensi</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  @if((count($awals) == 0 || count($akhirs) == 0) || (count($awals) == 0 && count($akhirs) == 0))
                  <h3><center>BUKAN PERIODE PENDAFTARAN</center></h3>
                  @else
                  <h4 class="card-title">Daftar Asistensi</h4>
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
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                         
                          @foreach ($daftars as $index => $item)
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{$item->id}}" ><i class=" mdi mdi-eye "></i></button>
                              @if((isset($users[$item->id]) && $a->status == 'daftar') || (isset($users[$item->id]) && $a->status == 'diterima'))
                              <input type="hidden" value="{{ $a->status }}">
                              <a data-id="{{ $users[$item->id] }}" data-nama="{{ $item->nama_matkul }}" data-hari="{{ $item->hari }}"  data-jam_mulai="{{ $item->jam_mulai }}"  data-jam_akhir="{{ $item->jam_akhir }}" class="btn btn-dark btn-sm deletebtn" href="javascript:void(0)">Batal</a>
                              @else
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#daftar{{$item->id}}" >Daftar</button>
                              @endif
                            
                            </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  @endif
<!-- Detail Praktikum Modal -->
@foreach ($daftars as $item)
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

@foreach ($daftars as $item)
<!-- Daftar Praktikum Modal -->
<div class="modal fade" id="batal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Batal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body">
      Yakin ingin membatalkan asistensi matakuliah {{ $item->nama_matkul }} kelas {{$item->nama}}?
      <input type="hidden" id="noDaftar" name="noDaftar">
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm">Iya</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- End Daftar Praktikum Modal -->

<!-- Daftar Praktikum Modal -->
<div class="modal fade" id="daftar{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Daftar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.daftar') }}" method="post">
        {{csrf_field()}}
        {{ method_field('POST') }}
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      Yakin ingin mendaftar asistensi matakuliah {{ $item->nama_matkul }} kelas {{ $item->nama }}?
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm">Daftar</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Daftar Praktikum Modal -->

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

    $('#tabel-user').on('click', '.deletebtn', function(){
      var id = $(this).data('id');
      var nama_matkul = $(this).data('nama_matkul');
      var hari = $(this).data('hari');
      var jam_mulai = $(this).data('jam_mulai');
      var jam_akhir = $(this).data('jam_akhir');
      $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        
        console.log(data);
        
        
        $('#delete_modal').attr('action', 'daftar/delete/'+id);
        $('#batal').modal('show');
    });
});
</script>
@endpush