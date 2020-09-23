@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('superadmin/master/semester')}}" style="color:black; text-decoration:none">Master Semester</a> / <a style="color:grey; text-decoration:none">Edit Semester</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data Semester</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('admin/master/semester/update/'.$semesters->id)}}">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$semesters->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" value="{{$semesters->semester}}">
                      </div>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Edit">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/master/semester')}}'">Batal</button>
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