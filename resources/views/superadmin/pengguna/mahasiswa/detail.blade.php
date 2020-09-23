@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('superadmin/pengguna/user-mahasiswa')}}" style="color:black; text-decoration:none">Mahasiswa</a> / <a style="color:grey; text-decoration:none">Detail Mahasiswa</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Detail Mahasiswa</h4>
                    <table style="border:0; float:left" class="col-md-6">
                    @foreach($users as $item)
                    <tr>
                    <th>ID</th>
                    <td>:</td>
                    <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                    <th>NIM</th>
                    <td>:</td>
                    <td>{{ $item->nim }}</td>
                    </tr>
                    <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>{{ $item->email }}</td>
                    </tr>
                    <tr>
                    <th>Username</th>
                    <td>:</td>
                    <td>{{ $item->username }}</td>
                    </tr>
                    <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $item->nama }}</td>
                    </tr>
                    <tr>
                    <th>No Telepon</th>
                    <td>:</td>
                    <td>{{ $item->no_hp }}</td>
                    </tr>
                    <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{ $item->nik }}</td>
                    </tr>
                    <tr>
                    <th>NPWP</th>
                    <td>:</td>
                    <td>{{ $item->npwp }}</td>
                    </tr>
                    <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>
                        @if($item->jk == 'P')
                        Perempuan
                        @else
                        Laki-laki
                        @endif
                    </td>
                    </tr>
                    @endforeach
                    </table>
                    <table style="border:0; float:right" class="col-md-6">
                    @foreach($users as $item)
                    <tr>
                    <tr>
                    <th>Tampat, Tanggal Lahir</th>
                    <td>:</td>
                    <td>{{ $item->tempat }}, {{ $item->tgl_lahir }}</td>
                    </tr>
                    <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{ $item->alamat }}</td>
                    </tr>
                    <tr>
                    <th>Prodi</th>
                    <td>:</td>
                    <td>{{ $item->prodi }}</td>
                    </tr>
                    <tr>
                    <th>Semester</th>
                    <td>:</td>
                    <td>{{ $item->semester }}</td>
                    </tr>
                    <tr>
                    <th>IPK</th>
                    <td>:</td>
                    <td>{{ $item->ipk }}</td>
                    </tr>
                    <tr>
                    <th>Kartu Hasil Studi</th>
                    <td>:</td>
                    <td><a type="button" style="color:blue; text-decoration:underline" data-toggle="modal" data-target="#pdf{{$item->id}}">{{ $item->khs }}</a></td>
                    </tr>
                    <tr>
                    <th>Nama Bank</th>
                    <td>:</td>
                    <td>{{ $item->nama_bank }}</td>
                    </tr>
                    <tr>
                    <th>No Rekening</th>
                    <td>:</td>
                    <td>{{ $item->no_rekening }}</td>
                    </tr>
                    <tr>
                    <th>Nama Rekening</th>
                    <td>:</td>
                    <td>{{ $item->nama_rekening }}</td>
                    </tr>
                    @endforeach
                    </table>
                    <br><br><br><br><br><br><br><br><br><br><br><a type="button" class="btn btn-gradient-primary mr-2 btn-sm" href="{{ url()->previous() }}">Batal</a>
                    <br><br>
                    <h4 class="card-title">Riwayat Asistensi</h4>
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>NO</th>  
                            <th>Matakuliah</th>
                            <th>Dosen</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Akhir</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>
                            <th>Periode</th>
                            <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($asistensi as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td> 
                            <td>{{ $item->nama_matkul }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_ruangan }}</td>
                            <td>{{ $item->thn_ajaran }}</td>
                            <td>
                            @if($item->status === "diterima")
                            <label class="badge badge-gradient-success">Diterima</label>
                            @elseif($item->status === "ditolak")
                            <label class="badge badge-gradient-danger">Ditolak</label>
                            @elseif($item->status === "daftar")
                            <label class="badge badge-gradient-warning">Diproses</label>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <!-- Detail PDF Modal -->
@foreach ($users as $item)
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
                  </div>
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
    $(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
    });
</script>
@endpush