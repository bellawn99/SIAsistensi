<footer class="footer-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>Tentang Asistensi</h3>
            <p>ASISTENSI merupakan sistem informasi berbasis website yang digunakan untuk pendaftaran calon asisten praktikum.</p>          </div>

          <div class="col-md-3 ml-auto">
            <h3>Follow Us</h3>
              <a href="#"><i class="icon-facebook" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#"><i class="icon-instagram" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="#"><i class="icon-twitter" aria-hidden="true"></i></a>
          </div>

          <div class="col-md-4">
            <h3>Hubungi Kami</h3>
            <p><i class="icon-phone" aria-hidden="true"> 088-888-888-888 </i></p>
          </div>

        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> | Made with <i class="icon-heart" aria-hidden="true"></i> and <i class="icon-code" aria-hidden="true"></i>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->

  
  <script src="{{ url('landing/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery-ui.js')}}"></script>
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
  <script src="{{ url('landing/js/popper.min.js')}}"></script>
  <script src="{{ url('landing/js/bootstrap.min.js')}}"></script>
  <script src="{{ url('landing/js/owl.carousel.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.countdown.min.js')}}"></script>
  <script src="{{ url('landing/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ url('landing/js/aos.js')}}"></script>
  <script src="{{ url('landing/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{ url('landing/js/jquery.sticky.js')}}"></script>

  
  <script src="{{ url('landing/js/main.js')}}"></script>
  <script>
    $('.without-loop').owlCarousel({
    dots:true,
    loop:false,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
  })
  </script>
  </body>
</html>