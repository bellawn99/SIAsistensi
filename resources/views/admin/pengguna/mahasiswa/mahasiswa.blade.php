@extends('layouts.master')

@push('css')
<style type="text/css">
    $custom-file-text: (
in: "Cari",
);
</style>
@endpush

@section('icon')
<i class="mdi mdi-account menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('admin/pengguna/user-mahasiswa')}}" style="color:black; text-decoration:none">Mahasiswa</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Mahasiswa</h4>
                    
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahMhs">
                    Tambah Data Mahasiswa
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importMhs">
                    Import Data Mahasiswa
                    </button><br><br>

                    
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>ID</th>  
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>No Telepon</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($users as $item)
                            <td>{{ $item->id }}</td> 
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td><a type="button" data-toggle="modal" data-target="#yourModal{{$item->id}}"><img src="{{ URL::to('/') }}/images/{{ $item->foto }}" class="img-thumbnail" width="100%" /></a></td>
                            <td>
                            <a href="{{route('pengguna.detail',$item->id)}}">
                            <button type="button" class="btn btn-info btn-sm" ><i class=" mdi mdi-eye "></i></button></a>
                            <button type="button" class="btn btn-warning btn-sm" data-id="{{ $item->id }}" data-username="{{ $item->username }}" data-nama="{{ $item->nama }}" data-toggle="modal" data-target="#ubah{{$item->id}}"><i class=" mdi mdi-autorenew "></i></button>
                            <a data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
<!-- Detail Foto Modal -->
@foreach ($users as $item)
<div class="modal fade" id="yourModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail Foto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <img src="{{ URL::to('/') }}/images/{{ $item->foto }}" style="border-radius:50%; max-width:40%; max-height:40%; min-width:40%; min-height:40%; display:block; margin:auto;" width="50%" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2 btn-sm" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail Foto Modal -->

@foreach ($users as $item)
<!-- Reset Mahasiswa Modal -->
<div class="modal fade" id="ubah{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('reset.mahasiswa') }}" method="post">
        {{csrf_field()}}
        {{ method_field('POST') }}
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      <input type="hidden" value="{{ $item->username }}" id="username" name="username">
      Yakin akan reset password akun {{ $item->nama }}?
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm">Reset</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Reset Mahasiswa Modal -->

<!-- Import Modal -->
<div class="modal fade" id="importMhs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('import.pengguna.mhs') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                    <input type="file" class="custom-file-input" name="file" accept=".csv" id="kolomImportMhs" lang="in">
                    <label class="custom-file-label" for="kolomImportMhs" data-browse="Cari">Import</label>                         
                    </div><br>
                    <b>PENTING!</b><br><br>
                    <img src="{{url('assets/images/penjelasan/mahasiswa.png')}}" width="100%"/><br>
                    <ol>
                      <b><li>Pastikan <u>Judul Kolom</u> yang ada pada file(.xlsx)/(.xls) berada di baris paling atas/pertama</li></b>
                      <b><li>Pastikan data mahasiswa yang ada di file (.xlsx)/(.xls) berada di baris kedua</li></b>
                      <b><li>Judul kolom tidak perlu sama persis dengan contoh diatas</li></b>
                      <b><li><u>Username</u> dan <u>Password</u> untuk mahasiswa akan otomatis diambilkan dari NIU</li></b>
                    </ol>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm">Import</button>
        <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Import Modal -->

<!-- Add Modal -->
<div class="modal fade" id="tambahMhs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.pengguna.mhs') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="email">Email</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="email" placeholder="Email" >
                      </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" >
                      </div>
                      <div class="form-group">
                        <label for="nim">NIM</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="nim" placeholder="NIM" >
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>&nbsp;<span>*</span>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="no_hp">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor Telepon" >
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="col-md-12">
                          <input type="file" class="custom-file-input" name="foto" id="kolomTambahMhs" lang="in">
                          <label class="custom-file-label" for="kolomTambahMhs" data-browse="Cari">Foto</label>                         
                        </div>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body"> 
      <p>Apakah anda yakin menghapus data mahasiswa <input style="border:0" id="deleteuserForm" readonly></input> </p>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      
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
      $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        
        console.log(data);
        
        $('#deleteuserForm').val(nama+' ?');
        
        $('#delete_modal').attr('action', 'user-mahasiswa/delete/'+id);
        $('#deletemodalpop').modal('show');
    });

    $('#kolomImportMhs').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('#kolomTambahMhs').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
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