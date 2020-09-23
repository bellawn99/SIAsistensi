@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('admin/master/dosen')}}" style="color:black; text-decoration:none">Master Dosen</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Dosen</h4>
                    
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDosen">
                    Tambah Data Dosen
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importDosen">
                    Import Data Dosen
                    </button><br><br>

                    
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIDN</th>    
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($dosens as $item)
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nidn }}</td>  
                            <td>{{ $item->nama }}</td>
                            <td>
                            <a href="{{route('master.editDosen',$item['id'])}}">
                            <button type="button" class="btn btn-warning btn-sm" ><i class=" mdi mdi-border-color "></i></button></a>
                            <a data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

<!-- Add Modal -->
<div class="modal fade" id="tambahDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.dosen') }}" method="post">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="nidn">NIDN</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="nidn" placeholder="NIDN" >
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" >
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

<!-- Import Modal -->
<div class="modal fade" id="importDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import Data Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('import.dosen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                    <input type="file" class="custom-file-input" name="file" accept=".csv" id="kolomImportDosen" lang="in">
                    <label class="custom-file-label" for="kolomImportDosen" data-browse="Cari">Import</label>                         
                    </div><br>
                    <b>PENTING!</b><br><br>
                    <img src="{{url('assets/images/penjelasan/dosen.png')}}" width="100%"/><br>
                    <ol>
                      <b><li>Pastikan <u>Judul Kolom</u> yang ada pada file(.xlsx)/(.xls) berada di baris paling atas/pertama</li></b>
                      <b><li>Pastikan data dosen yang ada di file (.xlsx)/(.xls) berada di baris kedua</li></b>
                      <b><li>Judul kolom tidak perlu sama persis dengan contoh diatas</li></b>
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

<!-- Delete Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body"> 
      <p>Apakah anda yakin menghapus data dosen <input style="border:0" id="deleteDosenForm" readonly></input> </p>
      
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
        
        $('#deleteDosenForm').val(nama+' ?');
        
        $('#delete_modal').attr('action', 'dosen/delete/'+id);
        $('#deletemodalpop').modal('show');
    });

    $('#kolomImportDosen').on('change',function(){
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