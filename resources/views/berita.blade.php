@include('header')
<div class="intro-section single-cover" id="home-section">
      
      <div class="slide-1 " style="background-image: url({{url('landing/images/awal.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-6">
                  <h1 data-aos="fade-up" data-aos-delay="0">{{ $berita['judul'] }}</h1>
                </div>

                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
        <div class="col-lg-4 pl-lg-5">

        <div class="mb-5 text-center border rounded course-instructor">
        <div class="mb-4 text-center">
            <img src="{{ url('landing/images/'.$berita->foto.'')}}" alt="Image" width="100%" height="100%">  
        </div>
        </div>

        </div>
          <div class="col-lg-8 mb-5">

            <div class="mb-5">
              <h3 class="text-black">{{ $berita['judul'] }}</h3>
              <p class="mb-4">
                <strong class="text-black mr-3"><span class="icon-clock-o"></span> {{ date('d, M Y', strtotime($berita['created_at'])) }}</strong> <br>
                <strong class="text-black mr-3"><span class="icon-person"></span> {{ $nama['nama'] }}</strong> 
              </p>
              <p>{!!nl2br(str_replace(" ", " &nbsp;", $berita['isi']))!!}</p>
            </div>

          </div>
          
        </div>
      </div>
    </div>

    @if(count($lain)>=1)
    <div class="site-section courses-title bg-dark" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Berita Lain</h2>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">
          <div class="owl-carousel col-12 nonloop-block-14 without-loop">
          @foreach($lain as $b)
            <div class="course bg-white h-100 align-self-stretch">
              
              <figure class="m-0">
                <a href="{{url('berita/'.$b['id'])}}"><img src="{{ url('landing/images/'.$b->foto.'')}}" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span>{{ date('d-m-Y', strtotime($b->created_at)) }}</div>
                <h3><a href="{{url('berita/'.$b['id'])}}">{{ $b->judul }}</a></h3>
                <p>{!!str_limit(nl2br(str_replace(" ", " &nbsp;", $b->isi)),20)!!} </p>
              </div>
              
            </div>
          @endforeach
          </div>
        </div><br><br><br><br><br>


        @if(count($lain) > 3)
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Sebelumnya</button>
            <button class="customNextBtn btn btn-primary m-1">Selanjutnya</button>
          </div>
        </div>
        @endif
      </div>
    </div>
    @endif
@include('footer')