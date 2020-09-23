<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asistensi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/dataTables.bootstrap4.min.css')}}">
    <style>
      .modal-open {
  overflow: hidden;
}

.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}

.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  outline: 0;
}

.modal-dialog {
  position: relative;
  width: auto;
  margin: 0.5rem;
  pointer-events: none;
}

.modal.fade .modal-dialog {
  transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  -webkit-transform: translate(0, -25%);
  transform: translate(0, -25%);
}

@media screen and (prefers-reduced-motion: reduce) {
  .modal.fade .modal-dialog {
    transition: none;
  }
}

.modal.show .modal-dialog {
  -webkit-transform: translate(0, 0);
  transform: translate(0, 0);
}

.modal-dialog-centered {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  min-height: calc(100% - (0.5rem * 2));
}

.modal-dialog-centered::before {
  display: block;
  height: calc(100vh - (0.5rem * 2));
  content: "";
}

.modal-content {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  width: 100%;
  pointer-events: auto;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  outline: 0;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  background-color: #000;
}

.modal-backdrop.fade {
  opacity: 0;
}

.modal-backdrop.show {
  opacity: 0.5;
}

.modal-header {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: start;
  align-items: flex-start;
  -ms-flex-pack: justify;
  justify-content: space-between;
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
  border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;
}

.modal-header .close {
  padding: 1rem;
  margin: -1rem -1rem -1rem auto;
}

.modal-title {
  margin-bottom: 0;
  line-height: 1.5;
}

.modal-body {
  position: relative;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  padding: 1rem;
}

.modal-footer {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  -ms-flex-pack: end;
  justify-content: flex-end;
  padding: 1rem;
  border-top: 1px solid #e9ecef;
}

.modal-footer > :not(:first-child) {
  margin-left: .25rem;
}

.modal-footer > :not(:last-child) {
  margin-right: .25rem;
}

.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll;
}

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
  }
  .modal-dialog-centered {
    min-height: calc(100% - (1.75rem * 2));
  }
  .modal-dialog-centered::before {
    height: calc(100vh - (1.75rem * 2));
  }
  .modal-sm {
    max-width: 300px;
  }
}

@media (min-width: 992px) {
  .modal-lg {
    max-width: 800px;
  }
}


    </style>
    <!-- <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">    -->
    <!-- <link rel="stylesheet" href="{{url('assets/css/jquery.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{url('assets/css/rowReorder.dataTables.min.css')}}">  -->
    <link rel="stylesheet" href="{{url('assets/css/responsive.dataTables.min.css')}}">   
    @stack('css')
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{url('assets/images/logo-mini.svg')}}" />

 
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        @if (Auth::user()->role_id == 1)
          <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{url('assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{url('assets/images/logo-mini.svg')}}" alt="logo" /></a>
        @elseif(Auth::user()->role_id == 1)
          <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{url('assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{url('assets/images/logo-mini.svg')}}" alt="logo" /></a>
        @else
          <a class="navbar-brand brand-logo" href="{{ route('mahasiswa.beranda') }}"><img src="{{url('assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('mahasiswa.beranda') }}"><img src="{{url('assets/images/logo-mini.svg')}}" alt="logo" /></a>
        @endif
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{asset('images/'.Auth::user()->foto.'')}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->nama }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              @if (Auth::user()->role_id == 1)
                <a class="dropdown-item" href="{{ route('admin.ubahPass') }}">
                  <i class="mdi mdi-lock-open mr-2 text-success"></i> Ubah Password </a>
                <div class="dropdown-divider"></div>
              @elseif (Auth::user()->role_id == 3)
                <a class="dropdown-item" href="{{ route('admin.ubahPass') }}">
                  <i class="mdi mdi-lock-open mr-2 text-success"></i> Ubah Password </a>
                <div class="dropdown-divider"></div>
              @else
                <a class="dropdown-item" href="{{ route('mhs.ubahPass') }}">
                  <i class="mdi mdi-lock-open mr-2 text-success"></i> Ubah Password </a>
                <div class="dropdown-divider"></div>
              @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-2 text-primary"></i>{{ __('Logout') }}
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $a = Route::current()->getName(); !empty($a)&&isset($a)?$rut=$a:$rut=''; ?>
        @if (Auth::user()->role_id == 1)
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{$rut == 'admin.dashboard' ? 'active' : ''}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pengajuan') }} " class="nav-link {{$rut == 'pengajuan' ? 'active' : ''}}">
                <span class="menu-title">Pengajuan</span>
                <i class="mdi mdi-file-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('asistensi') }} " class="nav-link {{$rut == 'asistensi' ? 'active' : ''}}">
                <span class="menu-title">Asistensi</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pengguna.mhs') }} " class="nav-link {{$rut == 'pengguna.mhs' ? 'active' : ''}}">
                <span class="menu-title">Pengguna</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{$rut == 'master.dosen' ? 'active' : ''}}" href="{{ route('master.dosen') }}"> Dosen </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'master.matkul' ? 'active' : ''}}" href="{{ route('master.matkul') }}"> Matakuliah </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'master.ruangan' ? 'active' : ''}}" href="{{ route('master.ruangan') }}"> Ruangan </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'master.jadwal' ? 'active' : ''}}" href="{{ route('master.jadwal') }}"> Jadwal </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'master.kelas' ? 'active' : ''}}" href="{{ route('master.kelas') }}"> Kelas </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'praktikum' ? 'active' : ''}}" href="{{ route('praktikum') }}">
                <span class="menu-title">Praktikum</span>
                <i class="mdi mdi-book menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'periode' ? 'active' : ''}}" href="{{ route('periode') }}">
                <span class="menu-title">Periode</span>
                <i class="mdi mdi-av-timer menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'ketentuan' ? 'active' : ''}}" href="{{ route('ketentuan') }}">
                <span class="menu-title">Ketentuan</span>
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'berita' ? 'active' : ''}}" href="{{ route('berita') }}">
                <span class="menu-title">Berita</span>
                <i class="mdi mdi-newspaper menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'admin.profil' ? 'active' : ''}}" href="{{ route('admin.profil') }}">
                <span class="menu-title">Profil</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            
          </ul>
        </nav>

        @elseif(Auth::user()->role_id == 3)
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a href="{{ route('superadmin.dashboard') }}" class="nav-link {{$rut == 'superadmin.dashboard' ? 'active' : ''}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('superadmin.pengajuan') }} " class="nav-link {{$rut == 'superadmin.pengajuan' ? 'active' : ''}}">
                <span class="menu-title">Pengajuan</span>
                <i class="mdi mdi-file-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('superadmin.asistensi') }} " class="nav-link {{$rut == 'superadmin.asistensi' ? 'active' : ''}}">
                <span class="menu-title">Asistensi</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-page" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Pengguna</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
              <div class="collapse" id="general-page">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.pengguna.admin' ? 'active' : ''}}" href="{{ route('superadmin.pengguna.admin') }}"> Admin </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.pengguna.mhs' ? 'active' : ''}}" href="{{ route('superadmin.pengguna.mhs') }}"> Mahasiswa </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.master.dosen' ? 'active' : ''}}" href="{{ route('superadmin.master.dosen') }}"> Dosen </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.master.matkul' ? 'active' : ''}}" href="{{ route('superadmin.master.matkul') }}"> Matakuliah </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.master.ruangan' ? 'active' : ''}}" href="{{ route('superadmin.master.ruangan') }}"> Ruangan </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.master.jadwal' ? 'active' : ''}}" href="{{ route('superadmin.master.jadwal') }}"> Jadwal </a></li>
                  <li class="nav-item"> <a class="nav-link {{$rut == 'superadmin.master.kelas' ? 'active' : ''}}" href="{{ route('superadmin.master.kelas') }}"> Kelas </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'superadmin.praktikum' ? 'active' : ''}}" href="{{ route('superadmin.praktikum') }}">
                <span class="menu-title">Praktikum</span>
                <i class="mdi mdi-book menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'superadmin.periode' ? 'active' : ''}}" href="{{ route('superadmin.periode') }}">
                <span class="menu-title">Periode</span>
                <i class="mdi mdi-av-timer menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'superadmin.ketentuan' ? 'active' : ''}}" href="{{ route('superadmin.ketentuan') }}">
                <span class="menu-title">Ketentuan</span>
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'superadmin.berita' ? 'active' : ''}}" href="{{ route('superadmin.berita') }}">
                <span class="menu-title">Berita</span>
                <i class="mdi mdi-newspaper menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'superadmin.profil' ? 'active' : ''}}" href="{{ route('superadmin.profil') }}">
                <span class="menu-title">Profil</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            
          </ul>
        </nav>
        @else
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link {{$rut == 'mahasiswa.beranda' ? 'active' : ''}}" href="{{ route('mahasiswa.beranda') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'daftar' ? 'active' : ''}}" href="{{ route('daftar') }}">
                <span class="menu-title">Daftar</span>
                <i class=" mdi mdi-file-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'pengumuman' ? 'active' : ''}}" href="{{ route('pengumuman') }}">
                <span class="menu-title">Pengumuman</span>
                <i class=" mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{$rut == 'mhs.profil' ? 'active' : ''}}" href="{{ route('mhs.profil') }}">
                <span class="menu-title">Profil</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            
          </ul>
        </nav>
         
        @endif
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper" style="width:100%">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  @yield('icon')
                </span> @yield('title') </h3>
              <nav aria-label="breadcrumb">
              </nav>
            </div>

            @yield('content')

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center d-block d-sm-inline-block" >Copyright © 2020</span>
              <span class="text-muted text-center d-block d-sm-inline-block">Make with <i class="mdi mdi-heart"></i>and <i class=" mdi mdi-code-tags "></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{url('assets/js/jquery-3.3.1.js')}}"></script>
    <script src="{{url('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/sweetalert.min.js')}}"></script>
    <script>
      @if(session('status'))
      swal({
        title:'{{ session('status') }}',
        icon : '{{ session('statuscode') }}',
        button : "OK",
      });
      @endif
    </script>
    <script src="{{url('assets/js/popper.min.js')}}"></script>
    <!-- <script src="{{url('assets/vendors/js/vendor.bundle.base.js')}}"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{url('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{url('assets/js/off-canvas.js')}}"></script>
    <script src="{{url('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{url('assets/js/misc.js')}}"></script>
    <!-- endinject -->

    

    <!-- Custom js for this page -->
    <!-- <script src="{{url('assets/js/dashboard.js')}}"></script> -->
    <script src="{{url('assets/js/todolist.js')}}"></script>
    
    @stack('js')
    <!-- End custom js for this page -->
  </body>
</html>