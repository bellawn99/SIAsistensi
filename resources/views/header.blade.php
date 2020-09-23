<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asistensi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('landing/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ url('landing/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/jquery.fancybox.min.css')}}">

    <link rel="stylesheet" href="{{ url('landing/css/bootstrap-datepicker.css')}}">

    <link rel="stylesheet" href="{{ url('landing/fonts/flaticon/font/flaticon.css')}}">

    <link rel="shortcut icon" href="{{url('assets/images/logo-mini.svg')}}" />

    <link rel="stylesheet" href="{{ url('landing/css/style.css')}}">
    <style>
@media screen (max-width: 425px) {
   img {
      width: 100%
   }
}
</style>

  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto"><a href="{{ url('/') }}"><img src="{{ url('assets/images/logo.svg') }}" style="max-width: 100%; height: 30px;"></a></div>

                <!-- <a href="{{url('/login')}}">
                <button type="button" class="site-logo btn btn-primary btn-pill btn-xs" style="padding-top:5%; padding-bottom:5%; font-size:inherit; padding-right:10%;padding-left:10%" >&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</button></a> -->
                <!-- <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <a href="{{url('/login')}}" class="nav-link">Login</a>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div> -->
          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block  m-0 p-0">
                <a href="{{url('/login')}}" class="nav-link" style="font-weight:bold; font-size:x-large">Login</a>
                <a href="{{url('/register')}}" class="nav-link" style="font-weight:bold; font-size:x-large">Register</a>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

   