

<!-- CAMBIO background-color:black POR   #1a1b1c;height: 48px;   -->
<nav style=" height:49px" class="navbar navbar-expand topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar)   1a1b1c   -->
    
          

    <!-- Topbar Navbar -->
    
    <div class="consulting col-4">
     Multiespacio Nicasio 
    </div>
    
              

        <ul class="navbar-nav ml-auto">
            
            <img src="{{ asset('templates/frontend/devfolio') }}/assets/img/footer.png" style="height: 35px; position: absolute; bottom: 10px;  object-position: center;" class="img-fluid rounded b-shadow-a" alt="">
               
            
        @if(\Auth::user()->role== 1)
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link fondo" href="{{ route('admin') }}">
                    <span>Panel</span></a>
            </li>
            
        @endif

       
    
       
       

        
        
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle fondo" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                        src="{{ asset('templates/backend/sb-admin-2') }}/img/usuario.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Datos de Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <!--a class="btn-danger" href="{{ url('/admin/logout') }}"> Salir -Cerrar sesion </a-->
                   
                    <a class="dropdown-item btn-danger" href="{{ url('/admin/logout') }}" >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </li>
    
        </ul>
      
</nav>

@section('js-script')
    <script type="text/javascript">
        $("#btn-website").on("click",function(){
            let url = $(this).data("url")
            window.open(url)
        })
    </script>
@stop