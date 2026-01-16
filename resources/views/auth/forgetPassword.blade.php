<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Multiespacio">
    <meta name="description" content="Multiespacio">
    <meta name="author" content="Multiespacio">

    <title>Multiespacio Nicasio - Recuperación de Clave</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <link href="{{ asset('templates/backend/sb-admin-2') }}/css/logueo.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('templates/backend/sb-admin-2') }}/img/favicon.ico">

</head>

<body>

    <div class="header"><h2></h2></div>
    <div id="wrap">
      <div id="regbar">
        <div id="navthing">
          <h1>Multiespacio <b> Nicasio</b></h1>
        </div>
      </div>
    </div>

<body class="main-bg">
    <div class="login-container text-c animated flipInX">
        <div>
            <h1 class="logo-badge text-whitesmoke" style="color: #002060;"><span class="fa fa-user-circle"></span></h1>
        </div>
        <p class="text-whitesmoke" style="color: #002060;">Recuperar Clave de Acceso</p>
            <div class="container-content">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    @include('layouts.components.alert-dismissible')
                                </div>
                                <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                    <div class="form-group row">
                                        <label for="email_address" class="col-md-3 col-form-label text-md-right">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                          @if ($errors->has('email'))
                                              <span class="text-danger">{{ $errors->first('email') }}</span>
                                          @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-4">
                                          <button type="submit" class="form-button button-l margin-b">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('templates/backend/sb-admin-2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/js/sb-admin-2.min.js"></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>

</body>

</html>