@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-file-multiple menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('superadmin/pengajuan')}}" style="color:black; text-decoration:none">Pengajuan Asistensi</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  @if(count($pengajuans) == 0 )
                  <h3><center>TIDAK ADA PENGAJUAN</center></h3>
                  @else
                    <h4 class="card-title">Pengajuan Asistensi</h4>
                    
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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kelas</th>    
                            <th>Semester</th>
                            <th>Matakuliah</th>
                            <th>KHS</th>
                            <th>IPK</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($pengajuans as $index => $item)
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->user }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td><a type="button" style="color:blue; text-decoration:underline" data-toggle="modal" data-target="#pdf{{$item->id}}">{{ $item->khs }}</a></td>
                            <td>{{ $item->ipk }}</td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{$item->id}}" ><i class=" mdi mdi-eye "></i></button>
                            
                            @if($item->status == 'daftar')
                            <button type="button" class="btn btn-primary btn-sm openModal" data-id="{{ $item->noDaftar }}" data-praktikum="{{ $item->praktikum }}" data-nama="{{ $item->user }}" data-matkul="{{ $item->nama_matkul }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#terima" >Terima</button>
                            <button type="button" class="btn btn-dark btn-sm tolakModal" data-id="{{ $item->noDaftar }}" data-praktikum="{{ $item->praktikum }}" data-nama="{{ $item->user }}"  data-matkul="{{ $item->nama_matkul }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#tolak" >Tolak</button>
                            @elseif($item->status == 'diterima')
                            <button type="button" class="btn btn-danger btn-sm" readonly>Terima</button>
                            <button type="button" class="btn btn-dark btn-sm tolakModal" data-id="{{ $item->noDaftar }}" data-praktikum="{{ $item->praktikum }}" data-nama="{{ $item->user }}"  data-matkul="{{ $item->nama_matkul }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#tolak" >Tolak</button>
                            @else
                            <button type="button" class="btn btn-primary btn-sm openModal" data-id="{{ $item->noDaftar }}" data-praktikum="{{ $item->praktikum }}" data-nama="{{ $item->user }}" data-matkul="{{ $item->nama_matkul }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#terima" >Terima</button>
                            <button type="button" class="btn btn-danger btn-sm" readonly>Tolak</button>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif

<!-- Detail PDF Modal -->
@foreach ($pengajuans as $item)
<div class="modal fade" id="pdf{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" width="100%" height="100%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail KHS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
      <iframe id="myFrame" src="{{ URL::to('/') }}/khs/{{ $item->khs }}" width="100%" style="min-height:400px"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2 btn-sm" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail PDF Modal -->

@foreach($pengajuans as $item)
<!-- Terima Praktikum Modal -->
<div class="modal fade" id="terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Terima</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" action="{{url('admin/pengajuan/update')}}" method="POST" enctype="multipart/form-data" id="pengajuanForm">
              {{ csrf_field() }}
      <input type="hidden" value="{{ $item->noDaftar }}" class='modal_hiddenid' id="noDaftar" name="noDaftar">
      <input type="hidden" value="{{ $item->praktikum }}" class='modal_hiddenprak' id="praktikum" name="praktikum">
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      <input type="hidden" value="{{ $item->user }}" id="user" name="user">
      <p>Yakin ingin menerima asistensi <input style="border:0" id="terimaNama" readonly/> dengan matakuliah <input style="border:0;width:450px" id="terimaMatkul" readonly/></p>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm" from="pengajuanForm">Terima</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- End Terima Praktikum Modal -->

<!-- Tolak Praktikum Modal -->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tolak</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" action="{{url('admin/pengajuan/update')}}" method="POST" enctype="multipart/form-data" id="tolakForm">
              {{ csrf_field() }}
      <input type="hidden" value="{{ $item->noDaftar }}" class='modal_hiddenid' id="noDaftar" name="noDaftar">
      <input type="hidden" value="{{ $item->praktikum }}" class='modal_hiddenprak' id="praktikum" name="praktikum">
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      <input type="hidden" value="{{ $item->user }}" id="user" name="user">
      <p>Yakin ingin menolak asistensi <input style="border:0" id="tolakNama" readonly/> dengan matakuliah <input style="border:0;width:450px" id="tolakMatkul" readonly/></p>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm" from="tolakForm">Tolak</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Tolak Praktikum Modal -->


<!-- Detail Praktikum Modal -->
@foreach ($pengajuans as $item)
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
          <td>Nama</td>
          <td>:</td>
          <td>{{ $item->user }}</td>
        </tr>
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
        <tr>
        <td><a href="{{route('superadmin.pengguna.detail',$item['userId'])}}">
        Selengkapnya</a>
        </td>
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

    $(document).on('click','.openModal',function(){
        var id = $(this).data('id');
        var praktikum = $(this).data('praktikum');
        var nama = $(this).data('nama');
        var matkul = $(this).data('matkul');

        $('.modal_hiddenid').val(id);
        $('.modal_hiddenprak').val(praktikum);
        $('#terimaNama').val(nama);
        $('#terimaMatkul').val(matkul+' ?');
        
        $('#terima').modal('show');
    });

    $(document).on('click','.tolakModal',function(){
        var id = $(this).data('id');
        var praktikum = $(this).data('praktikum');
        var nama = $(this).data('nama');
        var matkul = $(this).data('matkul');
        
        $('.modal_hiddenid').val(id);
        $('.modal_hiddenprak').val(praktikum);
        $('#tolakNama').val(nama);
        $('#tolakMatkul').val(matkul+' ?');
        
        $('#tolak').modal('show');
    });
});
</script>
@endpush