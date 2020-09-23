@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-av-timer menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('admin/periode')}}" style="color:black; text-decoration:none">Periode</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Periode</h4>
                    
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPeriode">
                    Tambah Data Periode
                    </button><br><br>

                    
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Mulai</th>    
                            <th>Tanggal Selesai</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($periodes as $item)
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->tgl_mulai }}</td>  
                            <td>{{ $item->tgl_selesai }}</td>
                            <td>{{ $item->thn_ajaran }}</td>
                            <td>
                            @if($item->semester === 'genap')
                            Genap
                            @else
                            Ganjil
                            @endif
                            </td>
                            <td>
                            @if($item->status === 'daftar')
                            Daftar
                            @else
                            Pengumuman
                            @endif
                            </td>
                            <td>
                            <a href="{{route('edit.periode',$item['berita_id'])}}">
                            <button type="button" class="btn btn-warning btn-sm" ><i class=" mdi mdi-border-color "></i></button></a>
                            <input type="hidden" id="berita_id" name="berita_id">
                            <a data-id="{{ $item->berita_id }}" data-tgl_m="{{ $item->tgl_mulai }}" data-tgl_s="{{ $item->tgl_selesai }}" data-thn="{{ $item->thn_ajaran }}" class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


<!-- Add Modal -->
<div class="modal fade" id="tambahPeriode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.periode') }}" method="post">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai</label>&nbsp;<span>*</span>
                        <input class="form-control" type="date" name="tgl_mulai">
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input class="form-control" type="date" name="tgl_selesai">
                    </div>
                      <div class="form-group">
                        <label for="thn_ajaran">Tahun Ajaran</label>&nbsp;<span>*</span>
                        <input type="text" class="form-control" name="thn_ajaran" placeholder="Tahun Ajaran" >
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>&nbsp;<span>*</span>
                        <select name="semester" class="form-control">
                                <option value="Genap" name="genap" id="genap">Genap</option>
                                <option value="Ganjil" name="ganjil" id="ganjil">Ganjil</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>&nbsp;<span>*</span>
                        <select name="status" class="form-control">
                                <option value="Daftar" name="daftar" id="daftar">Daftar</option>
                                <option value="Pengumuman" name="pengumuman" id="pengumuman">Pengumuman</option>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body"> 
      <p>Apakah anda yakin menghapus data periode tanggal <input size="50" style="border:0" id="deletePeriodeForm" readonly></input> </p>
      
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
      var tgl_m = $(this).data('tgl_m');
      var tgl_s = $(this).data('tgl_s');
      var thn = $(this).data('thn');
      $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        if(!tgl_s){
        $('#deletePeriodeForm').val(tgl_m+' tahun ajaran '+thn+' ?');
        }else{
        $('#deletePeriodeForm').val(tgl_m+' sampai '+tgl_s+' tahun ajaran '+thn+' ?');
        }
        
        $('#delete_modal').attr('action', 'periode/delete/'+id);
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