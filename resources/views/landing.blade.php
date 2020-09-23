@include('header')

    <div class="intro-section" id="home-section">
      
      <div class="slide-1" style="background-image: url({{url('landing/images/awal.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-12 mb-12">
                  <h1  data-aos="fade-up" data-aos-delay="100" style="text-align:center">ASISTENSI PRAKTIKUM KOMSI</h1>

                </div>

              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" id="programs-section">
      <div class="container">

        <div class="row mb-5 align-items-center">
          <div class="col-lg-5 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ url('landing/images/undraw_teaching.svg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-7 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Syarat dan Ketentuan</h2>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
            <table>  
              
              @foreach ($ketentuans as $index => $item)
              <tr>
              <td><span class="custom-icon-inner mr-3"><span class="icon">{{ $index+1 }}</span></span></td>

              <td><div><h3 class="m-0">{{ $item->ketentuan }}</h3></div></td>
              </tr>
              @endforeach
              
            </table>
          </div>
              

          </div>
        </div>

      </div>
    </div>
    
    <div class="site-section courses-title" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Berita</h2>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

        <div class="owl-carousel col-12 nonloop-block-14 without-loop">
          @foreach($berita as $b)
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


        @if(count($berita) > 3)
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Sebelumnya</button>
            <button class="customNextBtn btn btn-primary m-1">Selanjutnya</button>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-5 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ url('landing/images/undraw_teacher.svg')}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-7 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="section-title mb-3">Hubungi Kami</h2>
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
            <form method="post" data-aos="fade" action="/">
            {{csrf_field()}}
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="no_hp" class="form-control" placeholder="No Telepon">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" name="pesan" id="" cols="30" rows="10" placeholder="Tulis pesanmu disini."></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Kirim Pesan">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    
@include('footer')     
    