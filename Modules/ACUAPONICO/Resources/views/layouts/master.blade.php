<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
    <title>Administrador | Unidad de Cultivos</title>
    
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
     @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
      <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link text-white">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-white">Contact</a>
      </li>
    </ul>
  </nav>

    <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: rgb(207, 237, 218)">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src=" {{asset('AdminLTE/dist/img/logoaco.png') }}" style="width: 130px; ">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="" class="nav-link" id="gestionUsuarios">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gestión de Categorias</p>
                </a>
            </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>


<!-- jQuery -->
<script src={{asset('AdminLTE/plugins/jquery/jquery.min.js')}}></script>
<script src={{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<script src={{asset('AdminLTE/dist/js/adminlte.min.js')}}></script>
<script src={{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}></script>

@stack('scripts')
</body>
</html>


 