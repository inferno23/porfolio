<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ 'Multiespacio Nicasio'  }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/img/favicon.jpeg" rel="icon">
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/img/favicon.jpeg" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('templates/frontend/devfolio') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  
  ======================================================== -->
</head>

<body id="page-top">

  <!-- ======= Header/ Navbar ======= -->
  <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav" style="background: #f9e7db;box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);">
    
    
    
    <div class="container">
      <a class="navbar-brand js-scroll" href="#page-top">
        
          <img src="{{ asset('templates/frontend/devfolio') }}/assets/img/logo.png" style="height: 55px; object-fit: cover; object-position: center;" class="img-fluid rounded b-shadow-a" alt="">

     </a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll active" href="{{ route('home') }}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="#about">Acerca</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="#contact">Contacto</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll" href="cursos">Cursos</a>
          </li>
           <li class="nav-item">
            <a class="nav-link js-scroll" href="institucional">Institucional</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="mision">Mision</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="novedades">Novedades</a>
          </li>
           <li class="nav-item">
            <a class="nav-link js-scroll" href="objetivos">Objetivos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ======= Intro Section ======= -->
  <div id="home" class="intro route bg-image" style="background-image: url({{ asset('storage/uploads/image/header/'.$getHeader->image ?? 'gambar' ) }}">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="intro-title mb-4">{{ $getHeader->up_text ?? 'Nicasio' }}</h1>
          </div>
      </div>
    </div>
  </div><!-- End Intro Section -->

  <main id="main">

   

    <!-- ======= Portfolio Section ======= -->
    @if($getCursos->count()>0)
    <section id="work" class="portfolio-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
              Imagenes de la Sala 
              </h3>
              <p class="subtitle-a">Multiespacio               </p>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($getCursos as $foto)
          <div class="col-md-4">
            <div class="work-box">
              <a href="{{ asset('storage/uploads/image/foto/'.$foto->image) }}" data-gall="portfolioGallery" class="venobox">
                <div class="work-img">
                  <img src="{{ asset('storage/uploads/image/foto/'.$foto->image) }}" alt="" class="img-fluid">
                </div>
              </a>
             
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Portfolio Section -->
    @endif

    <!-- ======= Contact Section ======= -->
    <section class="paralax-mf footer-paralax bg-image sect-mt4 route">
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row">
                  <div class="col-md-6 mx-auto">
                    
                    <img src="{{ asset('templates/frontend/devfolio') }}/assets/img/viviendoNicasio.png" style="width: 80%">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
           <div class="redes">
                          <div class="accesoRedes row">
                          <div class="col-sm-6 col-lg-4"><a target="_blank" href="https://m.facebook.com/people/Multiespacio-Nicasio/100064140548766/?locale=en_GB"><img src="{{ asset('templates/frontend/devfolio') }}/assets/img/accesofb.png"></a></div>
                          <div class="col-sm-6 col-lg-4"><a target="_blank" href="https://www.instagram.com/multiespacio_nicasio/?hl=es"><img src="{{ asset('templates/frontend/devfolio') }}/assets/img/accesoig.png"></a></div>
                          <!-- <div class="col-sm-6 col-lg-3"><a target="_blank"
                                  href="https://www.youtube.com/channel/UCvWX4DkG9-Ww1FG-W9KxD-Q"><img src="{{ asset('templates/frontend/devfolio') }}/assets/img/accesoyt.png"></a>
                          </div> -->
                          <div class="col-sm-6 col-lg-4"><a target="_blank" href="https://walink.co/410dee"><img src="{{ asset('templates/frontend/devfolio') }}/assets/img/accesowapp.png"></a></div>
                         </div>
                      </div>
          <div class="copyright-box">
            <p class="copyright"></p>
            <div class="credits">
                        <img src="{{ asset('templates/frontend/devfolio') }}/assets/img/footer.png" style="height: 45px; object-fit: cover; object-position: center;" class="img-fluid rounded b-shadow-a" alt="">

            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->
  <div style="width: 100%; background-color: #606060; display: flex; justify-content: center; align-items: center;">
  <img src="assets/image/footer.png" style="height: 80px;">
</div>
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/counterup/jquery.counterup.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/typed.js/typed.min.js"></script>
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('templates/frontend/devfolio') }}/assets/js/main.js"></script>

</body>

</html>