<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
  <title>Administrador | Unidad de Cultivos</title>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  {{-- virtules --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Savate:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">


  {{-- Locales--}}
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  @stack('styles')
  <style>
    .main-header {
      border-bottom: none !important;
      margin-bottom: 0 !important;
    }

    .content-wrapper {
      margin-top: 0 !important;
      padding-top: 0 !important;
    }

    body.layout-fixed .wrapper .content-wrapper {
      padding-top: 0 !important;
      margin-top: 0 !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini ">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-0 mb-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('cefa.acuaponico.index') }}"
          class="nav-link text-dark {{ request()->routeIs('cefa.acuaponico.index') ? 'border-bottom border-dark' : '' }}">
          Inicio
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('acuaponico.admin.welcome') }}"
          class="nav-link text-dark {{ request()->routeIs('acuaponico.admin.welcome') ? 'border-bottom border-dark' : '' }}">
          Administrador
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('acuaponico.admin.admin.usuarios') }}"
          class="nav-link text-dark {{ request()->routeIs('acuaponico.admin.admin.usuarios') ? 'border-bottom border-dark' : '' }}">
          Usuarios
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('acuaponico.admin.admin.produccion') }}"
          class="nav-link text-dark {{ request()->routeIs('acuaponico.admin.admin.produccion') ? 'border-bottom border-dark' : '' }}">
          Produccion
        </a>
      </li>
      <!-- Botón de logout -->
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-link nav-link" style="color: dark;">
            <i class="fas fa-sign-out-alt" style="color: dark"></i>
          </button>
        </form>
      </li>
    </ul>
  </nav>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: rgb(207, 237, 218); 
                position: fixed; top: 0; left: 0; height: 100vh; width: 250px; z-index: 1030;">
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
            <a href=" {{ route('acuaponico.admin.admin.usuarios')}}" class="nav-link" id="gestionUsuarios">
              <i class="nav-icon fas fa-th"></i>
              <p>Gestión de Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href=" {{ route('acuaponico.admin.admin.produccion')}}" class="nav-link" id="produccion">
              <i class="nav-icon fas fa-th"></i>
              <p>Producción</p>
            </a>
          </li>
          <li class="nav-item">
            <a href=" {{ route('acuaponico.admin.admin.actividades')}}" class="nav-link" id="produccion">
              <i class="nav-icon fas fa-th"></i>
              <p>Actividades</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Main content -->
  <div class="content-wrapper pt-0 mt-0" style="margin-top: 0 !important; padding-top: 0 !important;">
    @yield('content')
    @yield('content2')
    @yield('content3')
  </div>


  <!-- jQuery -->
  <script src={{asset('AdminLTE/plugins/jquery/jquery.min.js')}}></script>
  <script src={{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
  <script src={{asset('AdminLTE/dist/js/adminlte.min.js')}}></script>
  <script src={{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <!-- pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

  <!-- excel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  @stack('scripts')
</body>

</html>