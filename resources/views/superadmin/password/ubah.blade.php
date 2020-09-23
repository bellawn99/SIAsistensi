@extends('layouts.master')

@section('icon')
<i class="mdi mdi-lock-open menu-icon"></i>
@endsection

@section('title')
<a style="color:grey; text-decoration:none">Ubah Password</a>
@endsection

@push('css')
<style type="text/css">
    $custom-file-text: (
in: "Cari",
);
</style>
@endpush
@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Ubah Password</h4>
                    
                  @if (session('errors'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert">
                      <li>{{$errors}}</li>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{ route('superadmin.changePasswordAdmin') }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }} 
                      <div class="form-group">
                        <label for="password">Password Saat Ini</label>&nbsp;<span>*</span>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="form-group">
                        <label for="new-password">Password Baru</label>&nbsp;<span>*</span>
                        <input type="password" class="form-control" id="new-password" name="new-password">
                      </div>
                      <div class="form-group">
                        <label for="new-password-confirm">Password Baru (Ulangi)</label>&nbsp;<span>*</span>
                        <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm">
                      </div>
                      <span>(*) Wajib Diisi</span><br><br>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2 btn-sm" value="Ubah">
                      <button type="button" class="btn btn-light btn-sm"  onclick="location.href='{{url('admin/dashboard')}}'">Batal</button>
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