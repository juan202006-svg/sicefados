<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestion de Unidad de Cultivos</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <script src="{{ asset('jscriptjs') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <!-- Cambios en CSS al final del <head> -->
    <style>
        .content-section {
            display: none;
        }

        body {
            background-color: #eafaf1;
            /* Fondo general claro */
        }

        .main-header {
            background-color: #5bc0de !important;
            /* Navbar azul claro */
        }

        .main-sidebar {
            background-color: #3eacbb !important;
            /* Sidebar verde azulado */
            color: white;
        }

        .nav-link,
        .nav-link i {
            color: white !important;
        }

        .nav-link:hover {
            background-color: #6fcb9f !important;
            /* Hover verde suave */
            color: white !important;
        }

        .brand-link {
            background-color: #3eacbb !important;
            color: white !important;
        }

        .main-footer {
            background-color: #2f4f4f !important;
            /* Gris oscuro elegante */
            color: white;
        }

        .main-footer a {
            color: #a3d9a5;
        }
    </style>

</head>

<body class="hold-transition sidebar-open layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
        </div>
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
                    <a href="" class="nav-link text-white">Home</a>
                </li>
            </ul>

            <!-- Botones alineados a la derecha -->
            <ul class="navbar-nav ml-auto">
                <!-- Icono de notificaciones -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">3 Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 1 nuevo mensaje
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 2 nuevas solicitudes
                            <span class="float-right text-muted text-sm">12 horas</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                    </div>
                </li>

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
        <script>
            // Desactiva el comportamiento de abrir el sidebar al hacer hover en modo mini
            $(document).ready(function() {
                // Evita que se expanda con el mouse al estar en mini
                $('[data-widget="pushmenu"]').PushMenu({
                    autoCollapseSize: false
                });
            });
        </script>

        <aside class="main-sidebar elevation-4" style="background-color: #3eacbb; color: white; padding-top: 10px;">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link" style="display: flex; align-items: center; padding: 10px;">
                <img src="{{ asset('AdminLTE/dist/img/logoaco.png') }}" alt="AdminLTE Logo" class="img"
                    style="width: 100px; height: 80px; border-radius: 50%; margin-right: 10px;">
                <span class="brand-text"
                    style="font-size: 20px; color: white; font-weight: bold; margin-top: -55px;">Acuaponia</span>
            </a>



            <!-- Sidebar (SIEMPRE visible) -->
            <div class="sidebar">

    <nav class="mt-5">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('acuaponico.pasante.pasante.index') }}" class="nav-link" id="gestionLotes">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gestión de Lotes</p>
                </a>
            </li>   
            <li class="nav-item">
                <a href="{{ route('acuaponico.pasante.pasante.categoria') }}" class="nav-link" id="gestionCategorias">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gestión de Categorias</p>
                </a>
            </li> 
             <li class="nav-item">
                <a href="{{ route('acuaponico.pasante.pasante.indexspecies') }}" class="nav-link" id="gestionCategorias">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gestión de Especies</p>
                </a>
            </li> 
             <li class="nav-item">
                <a href="{{ route('acuaponico.pasante.pasante.crops') }}" class="nav-link" id="gestionCategorias">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gestión de Cultivos</p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{ route('acuaponico.pasante.pasante.indextracking') }}" class="nav-link" id="gestionCategorias">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Seguimientos</p>
                </a>
            </li> 
        </ul>
    </nav>


            </div>

        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
            @yield('content2')
        </div>
        <script src="{{ asset('AdminLTE-/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
        <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
</body>

</html>
