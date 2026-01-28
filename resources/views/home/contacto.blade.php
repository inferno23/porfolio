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
<style>
:root {
  /* Colores de eventos */
  --fc-event-bg-color: #FFCC99; /* Naranja principal */
  --fc-event-border-color: #CC5200; /* Naranja oscuro para bordes */
  --fc-event-text-color: #fff; /* Texto blanco */
  
  /* Botones y cabecera */
  --fc-button-bg-color: #f8bd96; /* Naranja claro */
  --fc-button-border-color: #FF6600;
  --fc-button-hover-bg-color: #CC5200;
  --fc-button-hover-border-color: #993D00;
  --fc-button-active-bg-color: #f7924f;
  
  /* Bordes de la tabla */
  --fc-border-color: #FFCC99; 
}

/* Opcional: Cambiar color de fondo de los eventos en el calendario */
.fc-event {
    background-color: var(--fc-event-bg-color);
    border-color: var(--fc-event-border-color);
}



</style>
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
  <div class="bg-orange w-100 rounded text-center" style="padding-top: 3rem; padding-bottom: 3rem; margin-top: 1rem;">
  </div>

  <div id="home" class="bg-image" >
   
      <div class="table-cell">
        <div class="container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.2438311665974!2d-60.63963392438149!3d-32.94457127359414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab18f7a8b801%3A0x927b4997d5fdcc27!2sMultiespacio%20Nicasio!5e0!3m2!1ses!2sar!4v1769639347225!5m2!1ses!2sar" width="900" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      </div>
    
  </div><!-- End Intro Section -->
  <div class="bg-orange w-100 rounded text-center" style="padding-top: 3rem; padding-bottom: 3rem; margin-top: 1rem;">
  </div>
  <main id="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow border-0 overflow-hidden" style="border-radius: 1rem;">
                        <!-- Encabezado con color personalizado naranja -->
                        <div class="card-header border-0 text-white text-center py-4" style="background-color: #fd7e14;">
                            <h3 class="fw-bold mb-0">Contáctanos</h3>
                            <small class="opacity-75">Responderemos en breve</small>
                        </div>
                        
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('contact.submit') }}">
                                @csrf
        
                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="form-label text-secondary fw-semibold">Nombre</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" 
                                        style="border-color: #ffe8d6; focus-ring-color: #fd7e14;"
                                        placeholder="Tu nombre">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label text-secondary fw-semibold">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="nombre@ejemplo.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <!-- Mensaje -->
                                <div class="mb-4">
                                    <label for="message" class="form-label text-secondary fw-semibold">Mensaje</label>
                                    <textarea name="message" id="message" rows="4" 
                                        class="form-control @error('message') is-invalid @enderror"
                                        placeholder="Escribe tu mensaje aquí...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <!-- Botón Naranja -->
                                <div class="d-grid">
                                    <button type="submit" class="btn text-white fw-bold py-2 shadow-sm" 
                                        style="background-color: #fd7e14; transition: 0.3s;"
                                        onmouseover="this.style.backgroundColor='#e86b00'"
                                        onmouseout="this.style.backgroundColor='#fd7e14'">
                                        Enviar Mensaje
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
<div class="bg-orange w-100 rounded text-center" style="padding-top: 3rem; padding-bottom: 3rem; margin-top: 1rem;">
</div>
    

    
   
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


  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js'></script>


</body>

    <!-- FullCalendar CSS -->
   
   

</html>