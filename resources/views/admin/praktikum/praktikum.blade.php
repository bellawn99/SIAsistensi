@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-book menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('admin/praktikum')}}" style="color:black; text-decoration:none">Praktikum</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Praktikum</h4>
                    
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

                    <button type="button" class="btn btn-primary btn-sm btn-sm" data-toggle="modal" data-target="#tambahPraktikum">
                    Tambah Data Praktikum
                    </button><br><br>

                    
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th width="5%">Kelas</th>    
                            <th width="10%">Semester</th>
                            <th width="10%">Matakuliah</th>
                            <th width="5%">Hari</th>
                            <th width="5%">Jam Mulai</th>
                            <th width="5%">Jam Akhir</th>
                            <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($praktikums as $index => $item)
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#yourModal{{$item->id}}" ><i class=" mdi mdi-eye "></i></button>
                            <a href="{{route('edit.praktikum',$item['id'])}}">
                            <button type="button" class="btn btn-warning btn-sm" ><i class=" mdi mdi-border-color "></i></button></a>
                            <a data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-matkul="{{ $item->nama_matkul }}" class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


<!-- Detail Praktikum Modal -->
@foreach ($praktikums as $item)
<div class="modal fade" id="yourModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table style="border:0">
        <tr>
          <td>ID</td>
          <td>:</td>
          <td>{{ $item->id }}</td>
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

<!-- Add Modal -->
<div class="modal fade" id="tambahPraktikum" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Praktikum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.praktikum') }}" method="post">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                      <div class="form-group">
                        <label for="matkul_id">Matakuliah</label>&nbsp;<span>*</span>
                        <select name='matkul_id' class='form-control'>
                        @foreach ($matkuls as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_matkul }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="dosen_id">Dosen</label>&nbsp;<span>*</span>
                        <select name='dosen_id' class='form-control'>
                        @foreach ($dosens as $value)
                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jadwal_id">Jadwal</label>&nbsp;<span>*</span>
                        <select name='jadwal_id' class='form-control'>
                        @foreach ($jadwals as $value)
                                <option value="{{ $value->id }}">{{ $value->hari }} , {{ $value->jam_mulai }}-{{ $value->jam_akhir }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ruangan_id">Ruangan</label>&nbsp;<span>*</span>
                        <select name='ruangan_id' class='form-control'>
                        @foreach ($ruangans as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_ruangan }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelas_id">Kelas</label>&nbsp;<span>*</span>
                        <select name='kelas_id' class='form-control'>
                        @foreach ($kelass as $value)
                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>&nbsp;<span>*</span>
                        <select name='semester' class='form-control'>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                        </select>
                      </div>
                      <span>(*) Wajib Diisi</span>
                    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm">Tambah</button>
        <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Praktikum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body"> 
      <p>Apakah anda yakin menghapus data praktikum kelas<input size="50" style="border:0" id="deletePraktikumForm" readonly></input> </p>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm btn-sm">Hapus</button>
        <button type="button" class="btn btn-light btn-sm btn-sm" data-dismiss="modal">Batal</button>
      
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete Modal -->

<!-- Edit Modal -->
<!-- <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" method="post" data-toggle="validator" action="/master/user" id="editForm">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="ID" readonly>
                      </div>
                      <div class="form-group">
                        <label for="role_id">Role ID</label>
                        <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role ID" readonly>
                      </div>
                        <input type="hidden" class="form-control" id="role" name="role" placeholder="Nama Role" readonly>
                      <div class="form-group">
                        <label for="role_id">Nama Role</label>
                        <select name='role_id' class='form-control'>
                                <option value="1" >Admin</option>
                                <option value="2" >Mahasiswa</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Email">
                      </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-gradient-primary mr-2">Edit</button>
                      <button class="btn btn-light"  data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<!-- End Edit Modal -->
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
      var nama = $(this).data('nama');
      var matkul = $(this).data('matkul');
      $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        
        console.log(data);
        
        $('#deletePraktikumForm').val(nama+' matakuliah '+matkul+' ?');
        
        $('#delete_modal').attr('action', 'praktikum/delete/'+id);
        $('#deletemodalpop').modal('show');
    });
    //start edit
    // table.on('click', '.edit', function(){
    //     $tr = $(this).closest('tr');
    //     if($($tr).hasClass('child')){
    //         $tr = $tr.prev('.parent');
    //     }

    //     var data = table.row($tr).data();
        
    //     console.log(data);
    //     $('#id').val(data[0]);
    //     $('#role_id').val(data[1]);
    //     $('#role').val(data[2]);
    //     $('#name').val(data[3]);
    //     $('#email').val(data[4]);
        
    //     $('#editForm').attr('action', '/master/user/'+data[0]);
    //     $('#editUser').modal('show');
    // });
    //end
});

$(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
@endpush