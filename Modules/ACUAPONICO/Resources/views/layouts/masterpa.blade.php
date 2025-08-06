<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Gestion SA || Pasante </title>
    <link rel="icon" href="{{ asset('AdminLTE/dist/img/IconoAcuaponico.png') }}" type="image/x-icon" style="border-radius: 10px;">
    <!-- Fuente -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome (local) -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap (local) -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">


    <!-- Cambios en CSS al final del <head> -->
    <style>
        /* Fondo general */
        body {
            background-color: #E1F5FE;
            color: #263238;
            font-family: 'Source Sans Pro', sans-serif;
        }

        /* Navbar */
        .main-header {
            background-color: #0288D1 !important;
        }

        /* Sidebar */
        .main-sidebar {
            background-color: #01579B !important;
            color: white;
            margin-top: 58px;
        }

        .brand-link {
            background-color: #01579B !important;
            color: white !important;
        }

        /* Texto e iconos del menú */
        .nav-link,
        .nav-link i {
            color: white !important;
        }

        /* Hover sobre enlaces */
        .nav-link:hover {
            background-color: #03A9F4 !important;
            color: white !important;
        }

        /* ✅ Estilo para marcar el menú activo */
        .nav-link.active {
            background-color: #0288D1 !important;
            font-weight: bold;
            border-left: 5px solid #81D4FA;
            /* línea decorativa */
            color: white !important;
        }

        /* Footer */
        .main-footer {
            background-color: #455A64 !important;
            color: white;
        }

        .main-footer a {
            color: #B2EBF2;
        }

        .fondo-personalizado {
            background-color: #eaf6fb;
            /* Azul claro elegante */
            min-height: 100vh;
            padding: 20px;
        }

        #global-loader {
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #B3E5FC;
            /* azul completo */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-weight: bold;
            font-size: 18px;
            transition: opacity 0.3s ease;
        }

        /* Animación de punticos */
        .dots-loader {
            display: flex;
            gap: 12px;
            margin-bottom: 10px;
        }

        .dots-loader span {
            width: 15px;
            height: 15px;
            background-color: #01579B;
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

            0%,
            80%,
            100% {
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

        .fondo-personalizado {
            padding-top: 0 !important;
        }
    </style>

</head>

<body class="hold-transition sidebar-open layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Loader // carga entre modulos -->
    <div id="global-loader">
        <div class="dots-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="text-loader">Cargando...</div>
    </div>


    <div class="wrapper">
        <style>
            .nav-link {
                border-radius: 30px;
                /* Hace la animación redonda */
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.2);
                /* Color claro con transparencia */
                color: #e0f7fa !important;
                /* Cambia color del texto en hover, sutilmente */
            }

            .nav-link i:hover {
                color: #e0f7fa !important;
            }
        </style>

        <nav class="main-header navbar navbar-expand" style="background-color: #058799">
            <ul class="navbar-nav">
                <!-- Botón del menú lateral -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="color: white"></i>
                    </a>
                </li>

                <!-- Enlace a Home -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route ('cefa.acuaponico.index')}}" class="nav-link text-white">Inicio</a>
                </li>
            </ul>
            <!-- Botones alineados a la derecha -->
            <ul class="navbar-nav ml-auto">
                <!-- Botón de pantalla completa -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- Botón de logout -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="color: white;">
                            <i class="fas fa-sign-out-alt" style="color: white"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar elevation-4" style="background-color: #3eacbb; color: white; padding-top: 42px;">
            <a href="" class="brand-link d-flex flex-column align-items-center py-3" style="text-decoration: none;">
                <img src="{{ asset('AdminLTE/dist/img/Logo_Acuaponico.png') }}"
                    alt="Logo Acuapónico"
                    class="img-circle elevation-3"
                    style="width: 90px; height: 90px; object-fit: cover;">

                <span class="brand-text mt-2"
                    style="font-size: 18px; color: white; font-weight: bold; text-align: center;">
                    Acuapónico
                </span>
            </a>

            <!-- Sidebar (SIEMPRE visible) -->
            <div class="sidebar">

                <nav class="mt-6">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.welcomepas') }}" class="nav-link" id="gestionLotes">
                                <i class="fas fa-th-large"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.acuaponicoindex') }}" class="nav-link" id="gestionLotes">
                                <i class="fas fa-th-large"></i>
                                <p>sistemas Acuaponicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.index') }}" class="nav-link" id="gestionLotes">
                                <i class="fas fa-th-large"></i>
                                <p>Gestión de Lotes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.categoria') }}" class="nav-link" id="gestionCategorias">
                                <i class="fas fa-tags"></i>
                                <p>Gestión de Categorias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.indexspecies') }}" class="nav-link" id="gestionCategorias">
                                <i class="fas fa-dna"></i>
                                <p>Gestión de Especies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.crops') }}" class="nav-link" id="gestionCategorias">
                                <i class="fas fa-seedling"></i>
                                <p>Gestión de Cultivos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#submenuSeguimiento" role="button" aria-expanded="false" aria-controls="submenuSeguimiento">
                                <i class="fas fa-eye"></i>
                                <p>Control Seguimientos</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <div class="collapse" id="submenuSeguimiento">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a href="{{ route('acuaponico.pasante.pasante.indextracking') }}" class="nav-link">
                                            <i class="fas fa-chart-line"></i>
                                            <p>Seguimientos Generales</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('acuaponico.pasante.pasante.indextrakingfish') }}" class="nav-link">
                                            <i class="fas fa-fish"></i>
                                            <p>Seguimientos Peces</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('acuaponico.pasante.pasante.indextrackingplant') }}" class="nav-link">
                                            <i class="fas fa-leaf"></i>
                                            <p>Seguimientos Plantas</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route ('acuaponico.pasante.pasante.indexharvest')}}" class="nav-link" id="gestionCategorias">
                                <i class="fas fa-tractor"></i>
                                <p>Gestion de Cosechas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('acuaponico.pasante.pasante.indexactivity') }}" class="nav-link" id="gestionCategorias">
                                <i class="fas fa-clipboard-list"></i>
                                <p> Control de Avtividades</p>
                            </a>
                        </li>
                    </ul>
                </nav>


            </div>

        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper fondo-personalizado">
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
            <!-- Contenido principal -->
            @yield('content2')
        </div>


        <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Bootstrap 4 -->

        <!-- Bootstrap (local) -->
        <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- AdminLTE (local) -->
        <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

        <!-- OverlayScrollbars -->
        <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

        <!-- DataTables -->
        <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- JS Botones DataTables -->
        <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <!-- Mapael + Raphael -->
        <script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

        <!-- ChartJS -->
        <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

        <!-- Scripts de AdminLTE demo -->
        <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
        <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
        <script>
            window.addEventListener('load', function() {
                const loader = document.getElementById('global-loader');
                if (loader) {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.display = 'none', 300);
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentUrl = window.location.href;

                // Si la URL contiene alguno de los módulos de seguimiento
                if (currentUrl.includes('indextracking') || currentUrl.includes('indextrakingfish') || currentUrl.includes('indextrackingplant')) {
                    const submenu = document.getElementById('submenuSeguimiento');
                    const toggleBtn = document.querySelector('[data-bs-toggle="collapse"][href="#submenuSeguimiento"]');

                    // Abrir el submenu manualmente
                    submenu.classList.add('show');

                    if (toggleBtn) {
                        toggleBtn.classList.remove('collapsed');
                        toggleBtn.setAttribute('aria-expanded', 'true');
                    }
                }
            });
        </script>
        @yield('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentUrl = window.location.href;

                // Selecciona todos los enlaces del sidebar
                document.querySelectorAll('.nav-link').forEach(function(link) {
                    const linkHref = link.href;

                    // Si la URL actual contiene el href del link (y no es el "#")
                    if (linkHref !== "#" && currentUrl.includes(linkHref)) {
                        link.classList.add('active');
                    }
                });
            });
        </script>

</body>


</html>