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

    <style>
        /* Estilos para la animación */
        .nav-link {
            position: relative;
            color: white;
            font-size: 20px;
        }

        .nav-link::after,
        .btn::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: white;
            bottom: 0;
            left: 50%;
            transition: width 0.3s, left 0.3s;
        }

        .nav-link:hover::after,
        .btn:hover::after {
            width: 100%;
            left: 0;
        }

        /* fin de estilos de animacion */

        /* Contenido principal */
        .bullet-icon {
            background: linear-gradient(to right, #28a745, #6abf69);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 18px;
            display: inline-block;
            vertical-align: middle;
        }

        /* Complemento de la imagen del body */
        /* para que la imagen de fondo no se distorcione */
        body.modal-open {
            padding-right: 0 !important;
            overflow-y: scroll !important;
        }

        /* fin del Contenido principal */


        /* tarjetas animadas */

        @keyframes flotacion {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .tarjeta-redonda {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border-top: 5px solid #159617;
            cursor: pointer;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: flotacion 3s ease-in-out infinite;
        }

        .tarjeta-redonda:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(21, 150, 23, 0.3);
        }

        .imagen-central {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            animation: flotacion 4s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <!--Inicio del navbar -->
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

        <!-- CONTENEDOR PRINCIPAL -->
        <div class="w-100" style="margin-top: 20%; padding-bottom: 20%;">
            <div class="bg-white p-5 rounded shadow" style="min-height: 300px; width: 100%;">
                <!-- TÍTULO -->
                <h2 style="font-family: Broadway; font-size: 60px; color: #159617; margin-left: 17%;">
                    <strong>Ventajas</strong>
                </h2>

                <!-- TARJETAS -->
                <div class="d-flex flex-wrap gap-4 mt-5 position-relative">

                    <!-- Tarjeta 1 -->
                    <div class="card shadow text-center d-flex flex-column justify-content-center align-items-center tarjeta-redonda"
                        style="margin-left: 5%; margin-top: -1%;"
                        data-toggle="modal" data-target="#modal1">
                        <i class="fas fa-spa fa-2x text-success mb-2"></i>
                        <p class="card-text" style="color: #159617; font-size: 18px; margin: 0;"><strong>Nutrientes</strong></p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="card shadow text-center d-flex flex-column justify-content-center align-items-center tarjeta-redonda"
                        style="margin-left: 18%; margin-top: -1%;"
                        data-toggle="modal" data-target="#modal2">
                        <i class="fas fa-hand-holding-water fa-2x text-success mb-2"></i>
                        <p class="card-text" style="color: #159617; font-size: 18px; margin: 0;"><strong>Fertilizante</strong></p>
                    </div>

                    <!-- Imagen central -->
                    <div class="w-100 text-center my-4" >
                        <img src="{{ asset('AdminLTE/dist/img/acoun.png') }}" class="imagen-central"
                            style="margin-left: -50%; margin-top: -10%;">
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="card shadow text-center d-flex flex-column justify-content-center align-items-center tarjeta-redonda"
                        style="margin-left: 5%; margin-top: -9%;"
                        data-toggle="modal" data-target="#modal3">
                        <i class="fas fa-recycle fa-2x text-success mb-2"></i>
                        <p class="card-text" style="color: #159617; font-size: 18px; margin: 0;"><strong>Purificación</strong></p>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="card shadow text-center d-flex flex-column justify-content-center align-items-center tarjeta-redonda"
                        style="margin-left: 18%; margin-top: -9%;"
                        data-toggle="modal" data-target="#modal4">
                        <i class="fas fa-circle-notch fa-2x text-success mb-2"></i>
                        <p class="card-text" style="color: #159617; font-size: 18px; margin: 0;"><strong>Ciclo</strong></p>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODALES -->

        <!-- Modal 1 -->
        <div class="modal fade" id="modal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" data-dismiss="modal" data-toggle="modal" data-target="#modal2">
                    <div class="modal-body text-center p-5">
                        <div>
                            <h1 class="text-success"><strong>Produccion de alimentos</strong></h1>
                            <p class="text-muted mt-3 text-justify">
                                Las plantas absorben los nutrientes, creciendo rápidamente sin necesidad de tierra.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 -->
        <div class="modal fade" id="modal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" data-dismiss="modal" data-toggle="modal" data-target="#modal3">
                    <div class="modal-body text-center p-5">
                        <h5 class="modal-title mb-3">Fertilizante</h5>
                        Estos desechos sirven de fertilizante natural para las plantas.
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 3 -->
        <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" data-dismiss="modal" data-toggle="modal" data-target="#modal4">
                    <div class="modal-body text-center p-5">
                        <h5 class="modal-title mb-3">Purificación</h5>
                        Las plantas purifican el agua devolviéndola limpia a los peces.
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 4 -->
        <div class="modal fade" id="modal4" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" data-dismiss="modal" data-toggle="modal" data-target="#modal1">
                    <div class="modal-body text-center p-5">
                        <h5 class="modal-title mb-3">Ciclo</h5>
                        El resultado es un ciclo natural y autosuficiente.
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white text-white pt-4 pb-2" style="width: 100%; margin-top: -19.8%;">
            <div class="container">
                <div class="row">

                    <!-- Columna 1 -->
                    <div class="col-md-4">
                        <h5>Acerca de</h5>
                        <p>Este es un sistema acuapónico educativo con información sobre nutrientes, purificación y más.</p>
                    </div>

                    <!-- Columna 2 -->
                    <div class="col-md-4">
                        <h5>Enlaces rápidos</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Inicio</a></li>
                            <li><a href="#" class="text-white">Módulos</a></li>
                            <li><a href="#" class="text-white">Contacto</a></li>
                        </ul>
                    </div>

                    <!-- Columna 3 con minimapa -->
                    <div class="col-md-4">
                        <h5>Ubicación</h5>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2369.8935559915844!2d-75.36367140555551!3d2.6129752296121285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1ssena!5e0!3m2!1ses-419!2sco!4v1747956188479!5m2!1ses-419!2sco"
                            width="100%"
                            height="200"
                            style="border:0; border-radius: 8px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <p class="mt-2">La Angostura SENA</p>
                    </div>
                </div>

                <hr class="bg-white">
                <div class="text-center">
                    <p class="mb-0">&copy; 2025 Sistema Acuapónico. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
        <!-- Scripts -->
        <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</body>

</html>