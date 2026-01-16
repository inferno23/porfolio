<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'JaqueMate' }}</title>
    
    <link rel="shortcut icon" href="{{ asset('templates/backend/sb-admin-2') }}/img/favicon.ico">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('templates/backend/sb-admin-2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/backend/sb-admin-2') }}/css/sb-admin-2.min.css" rel="stylesheet">

    @yield('css-plugins')
    @yield('css-script')
    
</head>

<body id="page-top">
    <div class="header" style="background-color:#002060; height:25px; text-align:right; padding-top:5px; padding-right:5px; color:white;">
        <h6><span class="mr-2 d-none d-lg-inline small">{{ Auth::user()->name }}</span></h6>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
    
    @if(\Auth::user()->role== 1)
        <!-- Sidebar -->
        @include('layouts.backend.sidebar')
        <!-- End of Sidebar -->
    @endif
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content padding-left:0px margin-left:0px">

                <!-- Topbar Navbar -->
                @include('layouts.backend.navbar')
                <!-- End of Topbar Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer
            <link href="{{ asset('templates/backend/sb-admin-2') }}/css/logueo.css" rel="stylesheet">
  
            <footer class="sticky-footer bg-white">


            </footer>
            End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-primary">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/backend/sb-admin-2') }}/js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
    </script>
    @yield('js-plugins')
    @yield('js-script')
</body>

</html>