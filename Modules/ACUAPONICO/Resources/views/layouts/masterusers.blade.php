<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Gestión de Unidad de Cultivos</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    
    <!-- Scripts cargados de forma diferida -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Navbar -->
    <!-- Dentro del navbar -->
    <style>
        .nav-link:hover {
            transition: color 0.3s ease;
        }
    </style>
    
    <nav class="navbar navbar-expand" style="background-color: #00af1d;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item d-none d-sm-inline-block me-4">
                    <a href="{{ route('login') }}" 
                       class="nav-link text-white" 
                       style="font-size: 20px; position: relative;">
                        Inicio
                    </a>
                </li>
                @auth
                    @if(checkRol('acuaponico.admin'))
                        <li class="nav-item d-none d-sm-inline-block me-4">
                            <a href="{{ route('acuaponico.admin.welcome') }}" 
                               class="nav-link @if(Route::is('acuaponico.admin.*')) active @endif" 
                               style="color: white; font-size: 20px; position: relative;">
                                Administrador
                            </a>
                        </li>
                    @endif
                    @if(checkRol('acuaponico.pasante'))
                        <li class="nav-item d-none d-sm-inline-block me-4">
                            <a href="{{ route('acuaponico.pasante.welcomepas') }}" 
                               class="nav-link @if(Route::is('acuaponico.pasante.*')) active @endif" 
                               style="color: white; font-size: 20px; position: relative;">
                                Pasante
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
    
            @auth              
                <a href="{{ route('login') }}" class="btn text-white btn-lg" 
                   style="font-size: 20px; position: relative;">
                    Iniciar Sesión
                </a>
            @endauth
        </div>
    </nav>
    
    <!-- Estilos para la animación -->
    <style>
        .nav-link {
            position: relative;
            color: white;
            font-size: 20px;
        }
    
        .nav-link::after, .btn::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: white;
            bottom: 0;
            left: 50%;
            transition: width 0.3s, left 0.3s;
        }
    
        .nav-link:hover::after, .btn:hover::after {
            width: 100%;
            left: 0;
        }
    </style>
    
    
    
    

<!-- Contenido principal -->
<div class="container-fluid" style="background-image: url('{{ asset('AdminLTE/dist/img/fondoaco.jpg') }}'); 
     background-size: cover; background-attachment: fixed; background-position: center; min-height: 100vh; 
     display: flex; align-items: center; justify-content: center;">

    <div class="w-100" style="margin-top: -24%;">
        <!-- Columna para el texto y la imagen -->
        <div class="bg-white p-5 rounded shadow" style="opacity: 1; height: 80vh; width: 100%;">
            <!-- Contenedor en fila para imagen y título -->
            <div style="display: flex; align-items: center; gap: 20px; margin-top: 10%;">
                <!-- Imagen -->
                <img src="/AdminLTE/dist/img/tubosaco.jpg" alt="tubosaco" style="height: 350px; width: 400px; object-fit: 
                cover; border-radius: 40%; margin-left: 5%; margin-top: -2%;">
                <!-- Título -->
                <h1 style="font-family: Broadway; font-size: 40px; margin-top: -10%; margin-left: 10%;">
                    <strong>Unidad de Cultivos Acuapónica</strong>
                        <!-- Párrafo -->
                        <p class="text-justify" style="width: 90%; font-size: 20px; margin-top: 5%;">
                            Una unidad acuapónica es un sistema inteligente y sostenible que combina la cría de peces 
                            (acuicultura) con el cultivo de plantas sin suelo (hidroponía). Ambos sistemas se benefician 
                            entre sí: los desechos de los peces fertilizan a las plantas, y estas limpian el agua que 
                            vuelve a los peces. ¡Es un ciclo natural y eficiente!
                        </p>
                    </h1>
                </div>
            </div>
        </div>
    </div>





    
    

    <!-- Footer -->
    <footer style="width: 100%; position: fixed; bottom: 0; left: 0; background-color: #343a40; color: white; padding: 10px 20px;">
        <strong>Copyright &copy; 2023-2025 <a href="#" style="color: #3c8dbc;">GDF</a>.</strong> Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 3.2.0
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
</body>
</html>