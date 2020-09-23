@extends('layouts.master')

@section('icon')
<i class="mdi mdi-home menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('/mahasiswa/dashboard')}}" style="color:black; text-decoration:none">Dashboard</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
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
                    
                  <center>Selamat Datang, <b>{{ Auth::user()->nama }}</b></center><br>
                  <center>Silahkan Melengkapi <a href="{{url('mahasiswa/profil')}}">Profil</a> Untuk Melanjutkan Proses Pendaftaran</center>
                  </div>
                </div>
              </div>

@endsection

@push('js')
@endpush