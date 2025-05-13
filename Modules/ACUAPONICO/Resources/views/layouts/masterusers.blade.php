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

        @guest              
            <a href="{{ route('login') }}" class="btn text-white btn-lg" 
               style="font-size: 20px; position: relative;">
                Iniciar Sesión
            </a>
        @endguest
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
     display: flex; align-items: center; justify-content: center; flex-direction: column;">

<div class="w-100">
    <!-- Primer Contenedor Blanco -->
    <div class="bg-white p-5 rounded shadow" style="opacity: 1; height: auto; width: 100%;">
        <!-- Contenedor en fila para imagen y contenido -->
        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap;">
            <!-- Imagen -->
            <div style="flex: 1; display: flex; justify-content: center;">
                <img src="/AdminLTE/dist/img/tubosaco.jpg" alt="tubosaco" style="height: 450px; width: auto; object-fit: cover; border-radius: 20%;">
            </div>
            
            <!-- Contenido textual -->
            <div style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                <!-- Título -->
                <h1 style="font-family: Broadway; font-size: 45px; margin-bottom: 20px; color: #237424;">
                    <strong>Unidad de Cultivos Acuapónica</strong>
                </h1>
                
                <!-- Párrafo -->
                <p style="font-size: 18px; text-align: justify; color: #555; margin-bottom: 20px;">
                    La acuaponía es una técnica revolucionaria que integra acuicultura (cría de peces) y hidroponía (cultivo de plantas sin suelo) en un sistema cerrado y autosostenible. Este tipo de unidad permite producir alimentos frescos de manera ecológica, eficiente y respetuosa con el medio ambiente.
                </p>

                <!-- Viñetas con el símbolo ➢ -->
                <ul style="list-style: none; padding-left: 0; margin-top: 10px;">
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="bullet-icon" style="margin-right: 10px;">➢</span>
                        Los peces producen desechos ricos en nutrientes.
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="bullet-icon" style="margin-right: 10px;">➢</span>
                        Estos desechos sirven de fertilizante natural para las plantas.
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <span class="bullet-icon" style="margin-right: 10px;">➢</span>
                        Las plantas, a su vez, purifican el agua, devolviéndola limpia a los peces.
                    </li>
                    <li style="display: flex; align-items: center;">
                        <span class="bullet-icon" style="margin-right: 10px;">➢</span>
                        El resultado es un ciclo natural y autosuficiente, que optimiza recursos y minimiza desperdicios.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.bullet-icon {
    background: linear-gradient(to right, #28a745, #6abf69); /* Gradiente de verde oscuro a verde claro */
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-size: 18px;
    display: inline-block;
    vertical-align: middle;
}
</style>



        <!-- Nuevo Contenedor Blanco debajo -->
        <div class="w-100" style="margin-top: 20%; padding-bottom: 20%;">
            <div class="bg-white p-5 rounded shadow" style="opacity: 1; min-height: 300px; width: 100%;">
                <h2 style="font-family: Broadway; font-size: 60px; margin-left: 10%; color: #159617; margin-top: 4%;">
                    <strong>
                        Ventajas
                    </strong>
                </h2>
<!-- Viñetas con el símbolo ➱ -->
<ul style="list-style: none; padding-left: 0; margin-top: 10px;">
    <li style="display: flex; align-items: center; margin-bottom: 10px; font-size: 25px;">
        <span class="bullet-icon" style="margin-right: 10px; font-size: 35px;">➱</span>
        Los peces producen desechos ricos en nutrientes.
    </li>
</ul>

<style>
.bullet-icon {
    background: linear-gradient(to right, #28a745, #6abf69); /* Gradiente de verde oscuro a verde claro */
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent; /* Hace que el texto use el gradiente */
    display: inline-block;
    vertical-align: middle;
}
</style>

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