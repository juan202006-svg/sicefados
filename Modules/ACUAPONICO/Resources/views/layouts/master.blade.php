<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Administrador | Unidad de Cultivos</title>

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
            width: 280px;
            z-index: 1030;
            background-color: #66bee1 !important;
            display: flex;
            flex-direction: column;
        }

        .main-sidebar .sidebar {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 80px;
        }

        .main-sidebar .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .main-sidebar .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 3px;
        }

        .sidebar nav {
            position: sticky;
            top: 0;
            z-index: 1040;
            background-color: #66bee1;
        }

        .navbar {
            padding: 0.5rem 1rem;
            background-color: #89d1e9 !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: white !important;
            transition: all 0.2s ease;
            padding: 0.6rem 1.2rem;
            margin: 0 0.1rem;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: white !important;
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
            height: 3px;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 0 0.5rem;
            align-self: center;
        }

        .navbar-nav {
            gap: 5px;
        }

        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 6px;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .navbar-nav .nav-link i {
            margin: 0;
            line-height: 1;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
            margin-top: 5px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            background-color: #66bee1 !important;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            color: white !important;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            padding-left: 1.75rem;
        }

        .dropdown-item.active {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
        }

        .dropdown-header {
            font-size: 0.75rem;
            padding: 0.25rem 1.5rem;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.2) !important;
            margin: 0.25rem 0;
        }

        .nav-sidebar .nav-link {
            color: white !important;
            transition: all 0.2s ease;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        .nav-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
        }

        .nav-sidebar .nav-link.active i {
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
            text-decoration: none !important;
        }

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

<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm" style="width: 83%;">
        <ul class="navbar-nav" style="margin-left: 5%;">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('cefa.acuaponico.index') }}"
                   class="nav-link {{ request()->routeIs('cefa.acuaponico.index') ? 'active' : '' }}">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block ml-2">
                <div class="nav-divider"></div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.admin.welcome') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.admin.welcome') ? 'active' : '' }}">
                    <i class="fas fa-user-shield mr-2"></i> Administrador
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.admin.admin.registroacuaponicos') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registroacuaponicos') ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i> Acuapónicos
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.admin.admin.usuarios') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.usuarios') ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i> Usuarios
                </a>
            </li>
            <li class="nav-item dropdown d-none d-sm-inline-block">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs(['acuaponico.admin.admin.registroacuaponicos', 'acuaponico.admin.admin.registrolote', 'acuaponico.admin.admin.registrocategoria', 'acuaponico.admin.admin.registroespecie', 'acuaponico.admin.admin.registrocultivo', 'acuaponico.admin.admin.registroresiembras', 'acuaponico.admin.admin.seguimientogeneral', 'acuaponico.admin.admin.pezseguimiento', 'acuaponico.admin.admin.plantaseguimiento', 'acuaponico.admin.admin.registroseguimiento']) ? 'active' : '' }}"
                   id="produccionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-chart-line mr-2"></i> Producción
                </a>
                <div class="dropdown-menu dropdown-menu-left animate slideIn" aria-labelledby="produccionDropdown">
                    <h6 class="dropdown-header text-uppercase small font-weight-bold">Registros</h6>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registroacuaponicos') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registroacuaponicos') }}"><i class="fas fa-users mr-2"></i> Sistemas acuapónicos</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registrolote') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registrolote') }}"><i class="fas fa-clipboard-list mr-2"></i> Registro de lotes</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registrocategoria') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registrocategoria') }}"><i class="fas fa-tags mr-2"></i> Registro de categorías</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registroespecie') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registroespecie') }}"><i class="fas fa-fish mr-2"></i> Registros de especies</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registrocultivo') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registrocultivo') }}"><i class="fas fa-seedling mr-2"></i> Registros de cultivos</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registroresiembras') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registroresiembras') }}"><i class="fas fa-undo-alt mr-2"></i> Gestión de resiembras</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header text-uppercase small font-weight-bold">Seguimientos</h6>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.seguimientogeneral') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.seguimientogeneral') }}"><i class="fas fa-clipboard-check mr-2"></i> Seguimiento General</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.pezseguimiento') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.pezseguimiento') }}"><i class="fas fa-fish mr-2"></i> Seguimiento peces</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.plantaseguimiento') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.plantaseguimiento') }}"><i class="fas fa-leaf mr-2"></i> Seguimiento plantas</a>
                    <a class="dropdown-item {{ request()->routeIs('acuaponico.admin.admin.registroseguimiento') ? 'active' : '' }}"
                       href="{{ route('acuaponico.admin.admin.registroseguimiento') }}"><i class="fas fa-undo-alt mr-2"></i> Seguimiento resiembra</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('acuaponico.admin.admin.registrocosecha') }}"><i class="fas fa-harvest mr-2"></i> Cosecha</a>
                </div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('acuaponico.admin.admin.actividades') }}"
                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.actividades') ? 'active' : '' }}">
                    <i class="fas fa-users mr-2"></i> Actividades
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="d-none d-sm-inline ml-2">Salir</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar elevation-4">
        <a href="#" class="brand-link d-flex flex-column align-items-center py-3">
            <img src="{{ asset('modules/acuaponico/images/iconos/icolog.png') }}"
                 alt="Logo Acuapónico"
                 class="img-circle elevation-3"
                 style="width: 90px; height: 90px; object-fit: cover;">
            <span class="brand-text mt-2" style="font-size: 18px; color: white; font-weight: bold;">
                Acuapónico
            </span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.admin.admin.usuarios') }}"
                           class="nav-link {{ request()->routeIs('acuaponico.admin.admin.usuarios') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestión de Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#submenuProduccion"
                           class="nav-link {{ request()->routeIs(['acuaponico.admin.admin.registroacuaponicos', 'acuaponico.admin.admin.registrolote', 'acuaponico.admin.admin.registrocategoria', 'acuaponico.admin.admin.registroespecie', 'acuaponico.admin.admin.registrocultivo']) ? 'active' : '' }}"
                           data-toggle="collapse"
                           aria-expanded="{{ request()->routeIs(['acuaponico.admin.admin.registroacuaponicos', 'acuaponico.admin.admin.registrolote', 'acuaponico.admin.admin.registrocategoria', 'acuaponico.admin.admin.registroespecie', 'acuaponico.admin.admin.registrocultivo']) ? 'true' : 'false' }}">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>
                                Producción
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 {{ request()->routeIs(['acuaponico.admin.admin.registroacuaponicos', 'acuaponico.admin.admin.registrolote', 'acuaponico.admin.admin.registrocategoria', 'acuaponico.admin.admin.registroespecie', 'acuaponico.admin.admin.registrocultivo']) ? 'show' : '' }}"
                            id="submenuProduccion">
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registroacuaponicos') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registroacuaponicos') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registroacuaponicos') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Sistemas acuapónicos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registrolote') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registrolote') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registrolote') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Registro de lotes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registrocategoria') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registrocategoria') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registrocategoria') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Registro de categorías</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registroespecie') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registroespecie') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registroespecie') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Registros de especies</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registrocultivo') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registrocultivo') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registrocultivo') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Registros de cultivos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#submenuControlSeguimientos"
                           class="nav-link {{ request()->routeIs(['acuaponico.admin.admin.seguimientogeneral', 'acuaponico.admin.admin.pezseguimiento', 'acuaponico.admin.admin.plantaseguimiento']) ? 'active' : '' }}"
                           data-toggle="collapse"
                           aria-expanded="{{ request()->routeIs(['acuaponico.admin.admin.seguimientogeneral', 'acuaponico.admin.admin.pezseguimiento', 'acuaponico.admin.admin.plantaseguimiento']) ? 'true' : 'false' }}">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>
                                Control Seguimientos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 {{ request()->routeIs(['acuaponico.admin.admin.seguimientogeneral', 'acuaponico.admin.admin.pezseguimiento', 'acuaponico.admin.admin.plantaseguimiento']) ? 'show' : '' }}"
                            id="submenuControlSeguimientos">
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.seguimientogeneral') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.seguimientogeneral') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.seguimientogeneral') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimiento General</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.pezseguimiento') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.pezseguimiento') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.pezseguimiento') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimiento peces</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.plantaseguimiento') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.plantaseguimiento') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.plantaseguimiento') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimiento plantas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#submenuResiembra"
                           class="nav-link {{ request()->routeIs(['acuaponico.admin.admin.registroresiembras', 'acuaponico.admin.admin.registroseguimiento']) ? 'active' : '' }}"
                           data-toggle="collapse"
                           aria-expanded="{{ request()->routeIs(['acuaponico.admin.admin.registroresiembras', 'acuaponico.admin.admin.registroseguimiento']) ? 'true' : 'false' }}">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>
                                Resiembras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="collapse nav flex-column ms-3 {{ request()->routeIs(['acuaponico.admin.admin.registroresiembras', 'acuaponico.admin.admin.registroseguimiento']) ? 'show' : '' }}"
                            id="submenuResiembra">
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registroresiembras') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registroresiembras') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registroresiembras') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Gestión resiembras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('acuaponico.admin.admin.registroseguimiento') }}"
                                   class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registroseguimiento') ? 'active' : '' }}">
                                    <i class="{{ request()->routeIs('acuaponico.admin.admin.registroseguimiento') ? 'fas' : 'far' }} fa-circle nav-icon"></i>
                                    <p>Seguimiento resiembra</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.admin.admin.registrocosecha') }}"
                           class="nav-link {{ request()->routeIs('acuaponico.admin.admin.registrocosecha') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Cosecha</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('acuaponico.admin.admin.actividades') }}"
                           class="nav-link {{ request()->routeIs('acuaponico.admin.admin.actividades') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Actividades</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper pt-0 mt-0" style="margin-top: 0 !important; padding-top: 55px !important; margin-left: 250px !important;">
        @yield('content')
        @yield('content2')
        @yield('content3')
        @yield('content4')
        @yield('content5')
        @yield('content6')
        @yield('content7')
        @yield('content8')
        @yield('content9')
        @yield('content10')
        @yield('content11')
    </div>

    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>