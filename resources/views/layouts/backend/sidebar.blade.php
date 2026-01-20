 @if(\Auth::user()->role== 1)
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <!-- CAMBIO background-color:black POR   #1a1b1c   -->


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

   
    <!-- Nav Item - Pages Collapse Menu -->

   


 @if(\Auth::user()->email== "licenciadomarcofarfan@gmail.com" || \Auth::user()->email== "marcko_23@hotmail.com")
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Configuraciones</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user.index') }}">Usuarios</a>
                <a class="collapse-item" href="{{ route('about.index') }}">Detalle de la pagina</a>
                <a class="collapse-item" href="{{ route('portfolio.index') }}">Portfolio</a>
                <a class="collapse-item" href="{{ route('header.index') }}">Cabeceras</a>
                <a class="collapse-item" href="{{ route('footer.index') }}">Pie de página</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-list"></i>
            <span>Layout</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('layout.header') }}">Cabeceras</a>
                <a class="collapse-item" href="{{ route('layout.about') }}">Detalles de Paginas</a>
                <a class="collapse-item" href="{{ route('layout.footer') }}">Pie de página</a>
            </div>
        </div>
    </li>
    @endif
    


    <li class="nav-item {{ Request::is('header') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('header.index') }}">
        <i class="fa fa-window-maximize"></i>
            <span>Imagen principal</span></a>
    </li>

 <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('about.index') }}">
        <i class="fa fa-bars"></i>
            <span>Cuerpo de la página</span></a>
    </li>
    
    <li class="nav-item {{ Request::is('footer') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('footer.index') }}">
        <i class="fa fa-arrow-circle-down"></i>
            <span>Pie de página</span></a>
    </li>



    
    
    <li class="nav-item {{ Request::is('curso') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('curso.index') }}">
            <i class="fa fa-university"></i>
            <span>Cursos</span></a>
    </li>

    <li class="nav-item {{ Request::is('novedad') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('novedad.index') }}">
            <i class="fa fa-newspaper"></i>
            <span>Novedades</span></a>
    </li>
    
    



    <li class="nav-item {{ Request::is('obra') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('obra.index') }}">
            <i class="fa fa-sitemap"></i>
            <span>Obras</span></a>
    </li>
<li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.index') }}">
        <i class="fa fa-user"></i>
            <span>Usuarios</span></a>
    </li>
    
    @endif
    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>