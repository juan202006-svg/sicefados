<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion SA || Pasante</title>
    <link rel="icon" href="{{ asset('AdminLTE/dist/img/IconoAcuaponico.png') }}" type="image/x-icon">
    
    <!-- Bootstrap local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap/css/bootstrap.min.css') }}">
    
    <!-- Font Awesome local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    
    <!-- AdminLTE local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    
    <!-- OverlayScrollbars local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    
    <!-- DataTables local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    
    <!-- Select2 local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    
    <!-- SweetAlert2 local -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <link rel="icon" href="{{ secure_asset('favicon.ico') }}" type="image/x-icon">
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
            background-color: #E1F5FE;
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
            background-color: #66bee1 !important;
        }
        
        /* Estilos navbar */
        .navbar {
            padding: 0.5rem 1rem;
            background-color: #89d1e9 !important;
        }
        
        .navbar-light .navbar-nav .nav-link {
            color: white;
            transition: all 0.2s ease;
            padding: 0.6rem 1.2rem;
            margin: 0 0.1rem;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }
        
        .navbar-light .navbar-nav .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .navbar-light .navbar-nav .active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .navbar-light .navbar-nav .active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            width: 60%;
            height: 2px;
            background-color: white;
        }
        
        .nav-divider {
            width: 1px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 0 0.5rem;
            align-self: center;
        }
        
        /* Sidebar styles */
        .nav-link.active.bg-info {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
        }
        
        .nav-sidebar .nav-link p {
            color: white;
        }
        
        .nav-sidebar .nav-link i {
            color: white;
        }
        
        .brand-link {
            border-bottom: none;
            background-color: #66bee1 !important;
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
            margin-top: 5px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            background-color: #66bee1;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            color: white;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        
        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.75rem;
        }
        
        .dropdown-header {
            font-size: 0.75rem;
            padding: 0.25rem 1.5rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 0.25rem 0;
        }
        
        /* Loader styles */
        #global-loader {
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #B3E5FC;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-weight: bold;
            font-size: 18px;
            transition: opacity 0.3s ease;
        }
        
        .dots-loader {
            display: flex;
            gap: 12px;
            margin-bottom: 10px;
        }
        
        .dots-loader span {
            width: 15px;
            height: 15px;
            background-color: #7cbcec;
            border-radius: 50%;
            animation: bounce 1.2s infinite ease-in-out;
        }
        
        .dots-loader span:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .dots-loader span:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        @keyframes bounce {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.3;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .text-loader {
            color: #01579B;
        }
        
        .content-header {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }
        
        /* Animación del dropdown */
        @keyframes slideIn {
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
</head>

<body class="hold-transition sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
        <div class="dots-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="text-loader">Cargando...</div>
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm" style="width: 83%; background-color: #01defc;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('cefa.acuaponico.index') }}"
                   class="nav-link {{ request()->routeIs('cefa.acuaponico.index') ? 'active' : '' }}" style="color: white;">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
            </li>
            
            <li class="nav-item d-none d-sm-inline-block ml-2">
                <div class="nav-divider"></div>
            </li>
            
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.pasante.welcomepas') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.pasante.welcomepas') ? 'active' : '' }}" style="color: white;">
                    <i class="fas fa-user-tie mr-2"></i> Pasante
                </a>
            </li>
            
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('acuaponico.pasante.pasante.*') && !request()->routeIs('acuaponico.pasante.pasante.indextracking*') ? 'active' : '' }}" 
                   id="gestionDropdown" role="button" data-toggle="dropdown" aria-expanded="false" style="color: white;">
                    <i class="fas fa-tasks mr-2"></i> Gestión
                </a>
                <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="gestionDropdown">
                    <h6 class="dropdown-header text-uppercase small">Registros</h6>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.acuaponicoindex') }}">
                        <i class="fas fa-th-large mr-2"></i> Sistemas Acuaponicos
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.index') }}">
                        <i class="fas fa-boxes mr-2"></i> Lotes
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.categoria') }}">
                        <i class="fas fa-tags mr-2"></i> Categorías
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.indexspecies') }}">
                        <i class="fas fa-dna mr-2"></i> Especies
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.crops') }}">
                        <i class="fas fa-seedling mr-2"></i> Cultivos
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.indexresowing') }}">
                        <i class="fas fa-recycle mr-2"></i> Resiembras
                    </a>
                </div>
            </li>
            
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('acuaponico.pasante.pasante.indextracking*') ? 'active' : '' }}" 
                   id="seguimientoDropdown" role="button" data-toggle="dropdown" aria-expanded="false" style="color: white;">
                    <i class="fas fa-chart-line mr-2"></i> Seguimientos
                </a>
                <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="seguimientoDropdown">
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.indextracking') }}">
                        <i class="fas fa-chart-line mr-2"></i> Generales
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.indextrakingfish') }}">
                        <i class="fas fa-fish mr-2"></i> Peces
                    </a>
                    <a class="dropdown-item" href="{{ route('acuaponico.pasante.pasante.indextrackingplant') }}">
                        <i class="fas fa-leaf mr-2"></i> Plantas
                    </a>
                </div>
            </li>
            
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.pasante.pasante.indexharvest') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexharvest') ? 'active' : '' }}" style="color: white;">
                    <i class="fas fa-tractor mr-2"></i> Cosechas
                </a>
            </li>
            
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.pasante.pasante.indexactivity') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexactivity') ? 'active' : '' }}" style="color: white;">
                    <i class="fas fa-clipboard-list mr-2"></i> Actividades
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Botón de pantalla completa -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: white;">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            
            <!-- Botón de logout -->
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" title="Cerrar sesión" style="color: white;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="d-none d-sm-inline ml-2">Salir</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link d-flex flex-column align-items-center py-3">
            <img src="{{ asset('modules/acuaponico/images/iconos/icolog.png') }}" 
                 alt="Logo Acuapónico" 
                 class="img-circle elevation-3" 
                 style="width: 90px; height: 90px; object-fit: cover;">
            <span class="brand-text mt-2" style="font-size: 18px; color: white; font-weight: bold;">
                Acuapónico
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.welcomepas') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.welcomepas') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.acuaponicoindex') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.acuaponicoindex') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Sistemas Acuaponicos</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.index') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.index') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>Gestión de Lotes</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.categoria') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.categoria') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Gestión de Categorias</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.indexspecies') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexspecies') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-dna"></i>
                            <p>Gestión de Especies</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.crops') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.crops') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>Gestión de Cultivos</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.indexresowing') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexresowing') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Gestión de Resiembras</p>
                        </a>
                    </li>
                    
                    @php
                    $seguimientoRoutes = [
                        'acuaponico.pasante.pasante.indextracking',
                        'acuaponico.pasante.pasante.indextrakingfish',
                        'acuaponico.pasante.pasante.indextrackingplant'
                    ];
                    $isSeguimientoActive = collect($seguimientoRoutes)->contains(fn($route) => request()->routeIs($route));
                    @endphp
                    
                    <li class="nav-item">
                        <a href="#submenuSeguimiento" 
                          class="nav-link {{ $isSeguimientoActive ? 'active bg-info text-white' : '' }}" 
                          data-toggle="collapse" 
                          aria-expanded="{{ $isSeguimientoActive ? 'true' : 'false' }}">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>
                                Control Seguimientos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 {{ $isSeguimientoActive ? 'show' : '' }}" id="submenuSeguimiento">
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.pasante.pasante.indextracking') }}" 
                                  class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indextracking') ? 'active bg-info text-white' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.pasante.pasante.indextracking') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimientos Generales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.pasante.pasante.indextrakingfish') }}" 
                                  class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indextrakingfish') ? 'active bg-info text-white' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.pasante.pasante.indextrakingfish') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimientos Peces</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.pasante.pasante.indextrackingplant') }}" 
                                  class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indextrackingplant') ? 'active bg-info text-white' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.pasante.pasante.indextrackingplant') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimientos Plantas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.indexharvest') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexharvest') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-tractor"></i>
                            <p>Gestión de Cosechas</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.pasante.pasante.indexactivity') }}" 
                           class="nav-link {{ request()->routeIs('acuaponico.pasante.pasante.indexactivity') ? 'active bg-info text-white' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Control de Actividades</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Main content -->
    <div class="content-wrapper pt-0 mt-0">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('cefa.acuaponico.index') }}">Inicio</a>
                            </li>
                            @stack('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        
        @yield('content')
        @yield('content2')
    </div>

    <!-- jQuery local -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    
    <!-- Bootstrap local -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- AdminLTE local -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    
    <!-- OverlayScrollbars local -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    
    <!-- Select2 local -->
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    
    <!-- DataTables local -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    
    <!-- SweetAlert2 local -->
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('global-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.style.display = 'none', 300);
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;
            
            // Abrir submenú de seguimiento si está activo
            if (currentUrl.includes('indextracking') || currentUrl.includes('indextrakingfish') || currentUrl.includes('indextrackingplant')) {
                const submenu = document.getElementById('submenuSeguimiento');
                const toggleBtn = document.querySelector('[data-toggle="collapse"][href="#submenuSeguimiento"]');
                
                if (submenu) submenu.classList.add('show');
                if (toggleBtn) {
                    toggleBtn.classList.remove('collapsed');
                    toggleBtn.setAttribute('aria-expanded', 'true');
                }
            }
            
            // Marcar enlaces activos
            document.querySelectorAll('.nav-link').forEach(function(link) {
                const linkHref = link.href;
                if (linkHref !== "#" && currentUrl.includes(linkHref)) {
                    link.classList.add('active');
                }
            });
            
            // Inicializar dropdowns del navbar
            $('.dropdown-toggle').dropdown();
        });
    </script>
    
    @yield('scripts')
</body>
</html>