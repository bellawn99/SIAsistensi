@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-file-multiple menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('superadmin/asistensi')}}" style="color:black; text-decoration:none">Daftar Asistensi</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  @if(count($a) == 0 )
                  <h3><center>TIDAK ADA ASISTENSI</center></h3>
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

                      <!-- <div class="form-group col-md-4">
                      {!! Form::label('mat','Pilih Matakuliah') !!}
                      {!! Form::select('idMatkul', $matkul, null, array('id'=>'matkul','class' => 'form-control')) !!}
                      </div> -->
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matakuliah</th>
                            <th>Kelas</th>    
                            <th>Semester</th>                            
                            <th>Dosen</th>
                            <th>Asisten Praktikum</th>
                        </tr>
                      </thead>
                      <tbody id="a">
                        <tr>
                          @foreach ($a as $index => $item)
                            <td>{{ $index+1 }}</td>
                            <td>{{ str_limit($item->nama_matkul, 20) }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>                            
                            <td>{{ $item->nama_dosen }}</td>
                            <td id="satu">
                            @foreach($satu as $key => $a)
                            @if($a->noPraktikum == $item->noPraktikum)
                            {{ $a->name1 }}
                            <br>
                            @endif
                            @endforeach
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif






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

$(document).ready(function(){
    $('#matkul').on('change', function(e){
      $i = 1;
     
      var id = e.target.value;
      $.get('{{ url('admin/asistensi') }}/'+id, function(data){
        console.log(id);
        console.log(data);
        $('#a').empty();
        $('#satu').empty();
        $.each(data, function(index, element){
          var str = element.nama_matkul;
          var pendek = String(str).substr(0, 20);
          $('#a').append("<tr><td>"+$i+++"</td><td>"+pendek+"</td><td>"+element.nama+"</td><td>"+element.semester+"</td><td>"+element.nama_dosen+"</td></tr>");
          $('#satu').append("<tr><td>"+element.name1+"</td></tr>");
        });
      });
    });
});
</script>
@endpush