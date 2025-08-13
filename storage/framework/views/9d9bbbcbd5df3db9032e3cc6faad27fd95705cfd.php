<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="<?php echo e(asset('images/Favicon2.png')); ?>" type="image/x-icon">
  <title>Administrador | Unidad de Cultivos</title>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  
<!-- DataTables CSS -->

  <!-- Bootstrap 5 CSS (si no lo tienes ya) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Savate:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">



  
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <?php echo $__env->yieldPushContent('styles'); ?>
  <style>
    .main-header {
        border-bottom: none !important;
        margin-bottom: 0 !important;
        position: fixed;
        top: 0;
        left: 0;
        width: 80%;
        z-index: 1030;
    }

    .content-wrapper {
        margin-top: 0 !important;
        padding-top: 55px !important;
        margin-left: 250px !important;
        min-height: calc(100vh - 55px);
    }

    body.layout-fixed .wrapper .content-wrapper {
        padding-top: 55px !important;
        margin-top: 0 !important;
        margin-left: 250px !important;
    }
    
    .main-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        z-index: 1030;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm" style="width: 83%;">
    <!-- Left navbar links -->
    <ul class="navbar-nav" style="margin-left: 48%;">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo e(route('cefa.acuaponico.index')); ?>"
               class="nav-link <?php echo e(request()->routeIs('cefa.acuaponico.index') ? 'active' : ''); ?>">
                <i class="fas fa-home mr-2"></i> Inicio
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block ml-2">
            <div class="nav-divider"></div>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block" style="margin-left: ">
            <a href="<?php echo e(route('acuaponico.admin.welcome')); ?>"
               class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.welcome') ? 'active' : ''); ?>">
                <i class="fas fa-user-shield mr-2"></i> Administrador
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo e(route('acuaponico.admin.admin.usuarios')); ?>"
               class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.usuarios') ? 'active' : ''); ?>">
                <i class="fas fa-users mr-2"></i> Usuarios
            </a>
        </li>
        
        <li class="nav-item dropdown d-none d-sm-inline-block">
            <a href="#" class="nav-link dropdown-toggle <?php echo e(request()->routeIs('acuaponico.admin.admin.produccion*') ? 'active' : ''); ?>" 
               id="produccionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chart-line mr-2"></i> Producción
            </a>
            <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="produccionDropdown">
                <h6 class="dropdown-header text-uppercase small font-weight-bold text-muted">Registros</h6>
                <a class="dropdown-item" href="<?php echo e(route('acuaponico.admin.admin.registrolote')); ?>"><i class="fas fa-clipboard-list mr-2"></i> Registro de lotes</a>
                <a class="dropdown-item" href="<?php echo e(route('acuaponico.admin.admin.registrocategoria')); ?>"><i class="fas fa-tags mr-2"></i> Registro de categorías</a>
                <a class="dropdown-item" href="<?php echo e(route('acuaponico.admin.admin.registroespecie')); ?>"><i class="fas fa-fish mr-2"></i> Registros de especies</a>
                <a class="dropdown-item" href="<?php echo e(route('acuaponico.admin.admin.registrocultivo')); ?>"><i class="fas fa-seedling mr-2"></i> Registros de cultivos</a>
                
                <div class="dropdown-divider"></div>
                
                <h6 class="dropdown-header text-uppercase small font-weight-bold text-muted">Seguimientos</h6>
                <a class="dropdown-item" href="#"><i class="fas fa-clipboard-check mr-2"></i> Seguimientos</a>
                <a class="dropdown-item" href="#"><i class="fas fa-fish mr-2"></i> Seguimientos de peces</a>
                <a class="dropdown-item" href="#"><i class="fas fa-leaf mr-2"></i> Seguimientos de plantas</a>
                
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="#"><i class="fas fa-harvest mr-2"></i> Cosecha</a>
            </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-link nav-link" title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="d-none d-sm-inline ml-2">Salir</span>
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
    /* Estilos base */
    .navbar {
        padding: 0.5rem 1rem;
        background-color: #fff !important;
    }
    
    .navbar-light .navbar-nav .nav-link {
        color: #5a5a5a;
        transition: all 0.2s ease;
        padding: 0.6rem 1.2rem;
        margin: 0 0.1rem;
        border-radius: 4px;
        font-weight: 500;
        font-size: 0.95rem;
        position: relative;
    }
    
    /* Efecto hover */
    .navbar-light .navbar-nav .nav-link:hover {
        color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    /* Item activo */
    .navbar-light .navbar-nav .active {
        color: #007bff !important;
        background-color: rgba(0, 123, 255, 0.1);
    }
    
    .navbar-light .navbar-nav .active:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 60%;
        height: 2px;
        background-color: #007bff;
    }
    
    /* Separador entre items */
    .nav-divider {
        width: 1px;
        height: 30px;
        background-color: rgba(0, 0, 0, 0.1);
        margin: 0 0.5rem;
        align-self: center;
    }
    
    /* Dropdown mejorado */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0.5rem 0;
        margin-top: 5px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem;
        color: #495057;
        transition: all 0.2s;
        font-size: 0.9rem;
    }
    
    .dropdown-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
        color: #007bff;
        padding-left: 1.75rem;
    }
    
    .dropdown-header {
        font-size: 0.75rem;
        padding: 0.25rem 1.5rem;
    }
    
    .dropdown-divider {
        border-color: rgba(0, 0, 0, 0.05);
        margin: 0.25rem 0;
    }
    
    /* Botón de salida */
    .navbar-light .navbar-nav .btn-link {
        margin-left: -20%;
        color: #5a5a5a;
        transition: all 0.2s;
    }
    
    .navbar-light .navbar-nav .btn-link:hover {
        color: #dc3545;
        text-decoration: none;
    }
    
    /* Animación del dropdown */
    @keyframes  slideIn {
        0% {
            opacity: 0;
            transform: translateY(5px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate.slideIn {
        animation: slideIn 0.2s ease-out;
    }
</style>





  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: rgb(207, 237, 218); 
                position: fixed; top: 0; left: 0; height: 100vh; width: 250px; z-index: 1030; ">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src=" <?php echo e(asset('AdminLTE/dist/img/logoaco.png')); ?>" style="width: 130px; ">
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
            <a href=" <?php echo e(route('acuaponico.admin.admin.usuarios')); ?>" class="nav-link" id="gestionUsuarios">
              <i class="nav-icon fas fa-th"></i>
              <p>Gestión de Usuarios</p>
            </a>
          </li>

          <?php
          $produccionRoutes = [
              'acuaponico.admin.admin.registrolote',
              'acuaponico.admin.admin.registrocategoria',
              'acuaponico.admin.admin.registroespecie',
              'acuaponico.admin.admin.registrocultivo',
              'acuaponico.admin.admin.registroseguimiento',
          ];
          $isProduccionActive = collect($produccionRoutes)->contains(fn($route) => request()->routeIs($route));
          ?>

          <li class="nav-item">
              <a href="#submenuProduccion" 
                class="nav-link <?php echo e($isProduccionActive ? 'active bg-info text-white' : ''); ?>" 
                data-bs-toggle="collapse" 
                aria-expanded="<?php echo e($isProduccionActive ? 'true' : 'false'); ?>">
                  <i class="nav-icon fas fa-seedling"></i>
                  <p>
                      Producción
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="collapse nav flex-column ms-3 <?php echo e($isProduccionActive ? 'show' : ''); ?>" id="submenuProduccion">
                  <li class="nav-item">
                      <a href="<?php echo e(route('acuaponico.admin.admin.registrolote')); ?>" 
                        class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.registrolote') ? 'active bg-info text-white' : ''); ?>">
                          <i class="<?php echo e(request()->routeIs('acuaponico.admin.admin.registrolote') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                          <p>Registro de lotes</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('acuaponico.admin.admin.registrocategoria')); ?>" 
                        class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.registrocategoria') ? 'active bg-info text-white' : ''); ?>">
                          <i class="<?php echo e(request()->routeIs('acuaponico.admin.admin.registrocategoria') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                          <p>Registro de categorías</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('acuaponico.admin.admin.registroespecie')); ?>" 
                        class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.registroespecie') ? 'active bg-info text-white' : ''); ?>">
                          <i class="<?php echo e(request()->routeIs('acuaponico.admin.admin.registroespecie') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                          <p>Registros de especies</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('acuaponico.admin.admin.registrocultivo')); ?>" 
                        class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.registrocultivo') ? 'active bg-info text-white' : ''); ?>">
                          <i class="<?php echo e(request()->routeIs('acuaponico.admin.admin.registrocultivo') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                          <p>Registro de cultivos</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('acuaponico.admin.admin.registroseguimiento')); ?>" 
                        class="nav-link <?php echo e(request()->routeIs('acuaponico.admin.admin.registroseguimiento') ? 'active bg-info text-white' : ''); ?>">
                          <i class="<?php echo e(request()->routeIs('acuaponico.admin.admin.registroseguimiento') ? 'fas' : 'far'); ?> fa-circle nav-icon"></i>
                          <p>Seguimientos</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cosecha</p>
                      </a>
                  </li>
              </ul>
          </li>
          <style>
              .nav-link.active.bg-info {
                  background-color: #5bc0de !important; /* azul claro */
                  color: white !important;
              }
          </style>



          <li class="nav-item">
            <a href=" <?php echo e(route('acuaponico.admin.admin.actividades')); ?>" class="nav-link" id="produccion">
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
  <div class="content-wrapper pt-0 mt-0" style="margin-top: 0 !important; padding-top: 55px !important; margin-left: 250px !important;">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('content2'); ?>
    <?php echo $__env->yieldContent('content3'); ?>
    <?php echo $__env->yieldContent('content4'); ?>
    <?php echo $__env->yieldContent('content5'); ?>
  </div> 


  <!-- jQuery -->
  <script src=<?php echo e(asset('AdminLTE/plugins/jquery/jquery.min.js')); ?>></script>
  <script src=<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
  <script src=<?php echo e(asset('AdminLTE/dist/js/adminlte.min.js')); ?>></script>
  <script src=<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <!-- pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

  <!-- excel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <?php echo $__env->yieldPushContent('scripts'); ?>
  <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/layouts/master.blade.php ENDPATH**/ ?>