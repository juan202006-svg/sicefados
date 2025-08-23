<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('AdminLTE/dist/img/IconoAcuaponico.png')); ?>" type="image/x-icon">
    <title>Gestión de Unidad de Cultivos</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('modules/acuaponico/css/styles.css')); ?>">
    <link rel="stylesheet" href="http://localhost:8000/css/app.css">

    <!-- Scripts cargados de forma diferida -->

    <link rel="icon" href="<?php echo e(secure_asset('favicon.ico')); ?>" type="image/x-icon">

    <style>


    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <!--Inicio del navbar -->
    <nav class="navbar navbar-expand" style="background-color: #00af1d;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item d-none d-sm-inline-block me-4">
                    <a href="<?php echo e(route('cefa.home')); ?>"
                        class="nav-link text-white"
                        style="font-size: 20px; position: relative;">
                        Inicio
                    </a>
                </li>
                <?php if(auth()->guard()->check()): ?>
                <?php if(checkRol('acuaponico.admin')): ?>
                <li class="nav-item d-none d-sm-inline-block me-4">
                    <a href="<?php echo e(route('acuaponico.admin.welcome')); ?>"
                        class="nav-link <?php if(Route::is('acuaponico.admin.*')): ?> active <?php endif; ?>"
                        style="color: white; font-size: 20px; position: relative;">
                        Administrador
                    </a>
                </li>
                <?php endif; ?>
                <?php if(checkRol('acuaponico.pasante')): ?>
                <li class="nav-item d-none d-sm-inline-block me-4">
                    <a href="<?php echo e(route('acuaponico.pasante.welcomepas')); ?>"
                        class="nav-link <?php if(Route::is('acuaponico.pasante.*')): ?> active <?php endif; ?>"
                        style="color: white; font-size: 20px; position: relative;">
                        Pasante
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
            </ul>

            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('login')); ?>" class="btn text-white btn-lg"
                style="font-size: 20px; position: relative;">
                Iniciar Sesión
            </a>
            <?php else: ?>
            <!-- Botón de cerrar sesión -->
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-link nav-link" style="color: white;">
                    <i class="fas fa-sign-out-alt" style="color: white"></i>
                </button>
            </form>
            <?php endif; ?>

        </div>
    </nav>


    <!-- Contenido principal -->
    <div class="container-fluid" style="background-image: url('<?php echo e(asset('AdminLTE/dist/img/fondoaco.jpg')); ?>'); 
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
                            <strong>GSA - Gestion de Sistemas Acuaponicos</strong>
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

                <!-- CONTENEDOR TARJETAS + CARD-BODY AL LADO -->
                <div class="d-flex justify-content-center align-items-start mt-5">

                    <!-- TARJETAS + IMAGEN -->
                    <div class="d-flex flex-wrap gap-4 position-relative" style="width: 60%;">

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
                        <div class="w-100 text-center my-4" style="margin-left: 9.5%;">
                            <img src="<?php echo e(asset('AdminLTE/dist/img/acoun.png')); ?>" class="imagen-central"
                                style="max-width: 100%; margin-left: -50%; margin-top: -10%;">
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

                    <!-- CARD-BODY AL LADO DERECHO - VERSIÓN DINÁMICA -->
                    <div class="card-body" style="width: 40%; margin-left: -3%;">
                        <div class="card-title text-center mb-4">
                            <h3 style="color: #159617; font-weight: bold; border-bottom: 2px solid #159617; display: inline-block; padding-bottom: 5px;">
                                Ciclo Acuapónico
                            </h3>
                        </div>
                        <br>
                        <br>
                        <br>
                        <!-- Timeline interactivo -->
                        <div class="acuaponic-timeline">
                            <div class="timeline-step">
                                <div class="step-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; margin-left: -38.2%;">
                                    <i class="fas fa-fish"></i>
                                </div>
                                <div class="step-content ml-3">
                                    <h5 class="font-weight-bold" style="color: #159617;">1. Peces</h5>
                                    <p class="text-muted">Los peces producen desechos ricos en nutrientes</p>
                                </div>
                            </div>

                            <div class="timeline-arrow text-center my-2">
                                <i class="fas fa-arrow-down text-success"></i>
                            </div>

                            <div class="timeline-step">
                                <div class="step-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-bacteria"></i>
                                </div>
                                <div class="step-content ml-3">
                                    <h5 class="font-weight-bold" style="color: #159617;">2. Bacterias</h5>
                                    <p class="text-muted">Transforman amonio en nitratos aprovechables</p>
                                </div>
                            </div>

                            <div class="timeline-arrow text-center my-2">
                                <i class="fas fa-arrow-down text-success"></i>
                            </div>

                            <div class="timeline-step">
                                <div class="step-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="step-content ml-3">
                                    <h5 class="font-weight-bold" style="color: #159617;">3. Plantas</h5>
                                    <p class="text-muted">Filtran y oxigenan el agua naturalmente</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contador dinámico -->
                        <div class="stats-container mt-4 p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #159617;">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="counter" data-target="90">0</div>
                                    <small class="text-muted">% menos agua</small>
                                </div>
                                <div class="col-4">
                                    <div class="counter" data-target="2">0</div>
                                    <small class="text-muted">productos simultáneos</small>
                                </div>
                                <div class="col-4">
                                    <div class="counter" data-target="100">0</div>
                                    <small class="text-muted">% orgánico</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script para animación -->
        <script>
            // Animación para los contadores
            function animateCounters() {
                const counters = document.querySelectorAll('.counter');
                const speed = 200;

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(animateCounters, 1);
                    } else {
                        counter.innerText = target;
                    }
                });
            }

            // Ejecutar cuando el documento esté listo
            document.addEventListener('DOMContentLoaded', animateCounters);
        </script>


        <!-- MODALES -->

        <!-- Modal 1 -->
        <div class="modal fade" id="modal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="height: 100vh;">
                    <div class="modal-body p-4 d-flex flex-column align-items-center justify-content-center">
                        <h2 class="fw-bold text-success mb-4"><strong>Ciclo de Nutrientes en Acuaponía</strong></h2>
                        <div class="card bg-light shadow-sm rounded-3 p-4 w-100" style="max-width: 600px;">
                            <!-- Nutrient Cycle Diagram -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <!-- Peces -->
                                <div class="text-center" style="width: 25%;">
                                    <div class="fs-1">🐟</div>
                                    <div class="fw-bold mt-2">Peces</div>
                                    <div class="text-muted small">Producen NH₃</div>
                                </div>
                                <!-- Arrow -->
                                <div class="text-center" style="width: 10%;">
                                    <div class="fs-3">→</div>
                                </div>
                                <!-- Nitrosomonas -->
                                <div class="text-center" style="width: 25%;">
                                    <div class="fs-1">🦠</div>
                                    <div class="fw-bold mt-2">Nitrosomonas</div>
                                    <div class="text-muted small">NH₃ → NO₂</div>
                                </div>
                                <!-- Arrow -->
                                <div class="text-center" style="width: 10%;">
                                    <div class="fs-3">→</div>
                                </div>
                                <!-- Nitrobacter -->
                                <div class="text-center" style="width: 25%;">
                                    <div class="fs-1">🦠</div>
                                    <div class="fw-bold mt-2">Nitrobacter</div>
                                    <div class="text-muted small">NO₂ → NO₃</div>
                                </div>
                            </div>
                            <!-- Down Arrow -->
                            <div class="text-center mb-4">
                                <div class="fs-3">↓</div>
                            </div>
                            <!-- Plantas -->
                            <div class="text-center mb-4">
                                <div class="fs-1 d-inline-block">🌱</div>
                                <div class="fw-bold mt-2">Plantas</div>
                                <div class="text-muted small">Absorben NO₃</div>
                            </div>
                            <!-- Process Description -->
                            <!-- Proceso Completo -->
                            <div class="bg-opacity-10 p-3 rounded-3" style="background-color: #bcf8c6">
                                <h4 class="text-success text-center fw-bold mb-3">¿Cómo funciona este proceso?</h4>
                                <p class="mb-2">Los peces comen y producen desechos (popó y pipí) que tienen amoníaco.</p>
                                <p class="mb-2">Unas bacterias especiales convierten ese amoníaco en nutrientes para las plantas.</p>
                                <p class="mb-2">Las plantas usan estos nutrientes para crecer fuertes y saludables.</p>
                                <p class="mb-0">Así, el agua se mantiene limpia para los peces y las plantas se alimentan de forma natural.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal 2: Fertilizante Natural en Acuaponía -->
        <div class="modal fade" id="modal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="border-radius: 15px; overflow: hidden; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">

                    <h2 class="modal-title text-center text-success fw-bold m-0">Fertilizante Natural en Acuaponía</h2>

                    <!-- Cuerpo del modal -->
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <!-- Columna izquierda con imagen ampliada -->
                            <div class="col-md-7"> <!-- Cambiado de col-md-6 a col-md-7 -->
                                <img src="<?php echo e(asset('/AdminLTE/dist/img/fertilizanteacuapon.jpeg')); ?>"
                                    class="img-fluid h-100 w-100 object-fit-cover"
                                    alt="Sistema acuapónico"
                                    style="min-height: 400px; object-position: center;"> <!-- Aumentada altura mínima -->
                            </div>

                            <!-- Columna derecha con contenido ajustado -->
                            <div class="col-md-5 p-4 d-flex flex-column"> <!-- Cambiado de col-md-6 a col-md-5 -->
                                <!-- Proceso de fertilización -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h4 class="m-0 text-success">1. Desechos de peces</h4>
                                            <small class="text-muted">Fuente de amoníaco (NH₃)</small>
                                        </div>
                                    </div>
                                    <p class="ps-5">Los peces producen desechos ricos en amoníaco a través de su metabolismo.</p>
                                </div>

                                <!-- Transformación bacteriana -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h4 class="m-0 text-success">2. Transformación bacteriana</h4>
                                            <small class="text-muted">NH₃ → NO₂ → NO₃</small>
                                        </div>
                                    </div>
                                    <p class="ps-5">Bacterias beneficiosas convierten el amoníaco en nitritos y luego en nitratos.</p>
                                </div>

                                <!-- Absorción por plantas -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h4 class="m-0 text-success">3. Nutrición vegetal</h4>
                                            <small class="text-muted">Absorción de NO₃</small>
                                        </div>
                                    </div>
                                    <p class="ps-5">Las plantas absorben los nitratos como su principal fuente de nitrógeno.</p>
                                </div>

                                <!-- Comparación con fertilizantes tradicionales -->
                                <div class="bg-light p-3 rounded mt-auto">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-balance-scale text-success me-2 fs-4"></i>
                                        <h5 class="m-0 text-success">Ventajas vs. fertilizantes tradicionales</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"> <!-- Cambiado a col-12 para ocupar todo el ancho -->
                                            <div class="d-flex align-items-start mb-2">
                                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                                <div>
                                                    <strong>Orgánico</strong> - Sin químicos artificiales
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start mb-2">
                                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                                <div>
                                                    <strong>Continuo</strong> - Producción constante de nutrientes
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start mb-2">
                                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                                <div>
                                                    <strong>Seguro</strong> - Para peces y plantas
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                                <div>
                                                    <strong>Ecológico</strong> - Cero contaminación
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal 3: Purificación en Acuaponía (estructura diferente) -->
        <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">

                    <!-- Cabecera -->
                    <div class="bg-success text-white text-center p-4">
                        <i class="fas fa-tint fa-2x mb-2"></i>
                        <h3 class="fw-bold m-0">Purificación en Acuaponía</h3>
                        <small class="fst-italic">Manteniendo el agua limpia y equilibrada en el sistema</small>
                    </div>

                    <!-- Cuerpo -->
                    <div class="modal-body p-4">

                        <!-- Imagen destacada centrada -->
                        <div class="text-center mb-4">
                            <img src="<?php echo e(asset('/AdminLTE/dist/img/riegoacopon.jpg')); ?>"
                                alt="Purificación acuapónica"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 250px; object-fit: cover;">
                        </div>

                        <!-- Pasos de purificación en tarjetas -->
                        <div class="row g-3">

                            <!-- Paso 1 -->
                            <div class="col-md-4">
                                <div class="border rounded-3 p-3 h-100 text-center">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                        <span class="fw-bold fs-5">1</span>
                                    </div>
                                    <h5 class="fw-bold text-success">Filtro Mecánico</h5>
                                    <p class="small mb-0">Elimina sólidos como heces y restos de comida, manteniendo el agua clara.</p>
                                </div>
                            </div>

                            <!-- Paso 2 -->
                            <div class="col-md-4">
                                <div class="border rounded-3 p-3 h-100 text-center">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                        <span class="fw-bold fs-5">2</span>
                                    </div>
                                    <h5 class="fw-bold text-success">Biofiltro</h5>
                                    <p class="small mb-0">Bacterias nitrificantes convierten amoníaco en nitratos, eliminando toxinas.</p>
                                </div>
                            </div>

                            <!-- Paso 3 -->
                            <div class="col-md-4">
                                <div class="border rounded-3 p-3 h-100 text-center">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                                        <span class="fw-bold fs-5">3</span>
                                    </div>
                                    <h5 class="fw-bold text-success">Filtración Vegetal</h5>
                                    <p class="small mb-0">Las plantas absorben los nutrientes, devolviendo agua limpia a los peces.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Ventajas destacadas -->
                        <div class="mt-4 p-3 rounded-3" style="background: linear-gradient(135deg, #e3f2fd, #f1f8e9);">
                            <h5 class="text-success fw-bold mb-3 text-center">
                                <i class="fas fa-check-circle me-2"></i> Beneficios de la Purificación
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-leaf text-success me-2"></i>
                                            Agua saludable para peces y plantas.
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-recycle text-success me-2"></i>
                                            Reciclaje constante del agua.
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-shield-alt text-success me-2"></i>
                                            Previene toxicidad y enfermedades.
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-seedling text-success me-2"></i>
                                            Mantiene el ciclo natural del sistema.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal 4: Ciclo en Acuaponía -->
        <div class="modal fade" id="modal4" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 overflow-hidden" style="box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 2px solid #28a745;">

                    <!-- Cabecera con efecto de onda -->
                    <div class="bg-success text-white text-center p-4 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
                            <div class="water-wave" style="position: absolute; bottom: -10px; left: 0; width: 200%; height: 100%; background: rgba(255,255,255,0.1); border-radius: 40%; animation: wave 10s linear infinite;"></div>
                        </div>
                        <i class="fas fa-redo-alt fa-3x mb-3" style="animation: spin-slow 8s linear infinite;"></i>
                        <h3 class="fw-bold m-0 display-5">Ciclo Acuapónico Completo</h3>
                        <small class="fst-italic opacity-75">Naturaleza y tecnología en perfecta armonía</small>
                    </div>

                    <!-- Cuerpo del modal -->
                    <div class="modal-body p-4">

                        <!-- Imagen central con efecto flotante -->
                        <div class="text-center mb-4 position-relative" style="height: 250px;">
                            <img src="<?php echo e(asset('/AdminLTE/dist/img/cicloacuaponico.jpg')); ?>"
                                alt="Diagrama del ciclo acuapónico"
                                class="img-fluid rounded-4 shadow-lg border border-3 border-success"
                                style="max-height: 100%; width: auto; object-fit: contain; animation: float 6s ease-in-out infinite;">

                            <!-- Puntos interactivos -->
                            <div class="cycle-point" style="top: 20%; left: 30%;" data-step="1">
                                <div class="point-pulse"></div>
                                <div class="point-label bg-success text-white">Peces</div>
                            </div>
                            <div class="cycle-point" style="top: 30%; right: 20%;" data-step="2">
                                <div class="point-pulse"></div>
                                <div class="point-label bg-success text-white">Bacterias</div>
                            </div>
                            <div class="cycle-point" style="bottom: 20%; right: 25%;" data-step="3">
                                <div class="point-pulse"></div>
                                <div class="point-label bg-success text-white">Plantas</div>
                            </div>
                            <div class="cycle-point" style="bottom: 15%; left: 25%;" data-step="4">
                                <div class="point-pulse"></div>
                                <div class="point-label bg-success text-white">Agua Limpia</div>
                            </div>
                        </div>

                        <!-- Explicación del ciclo en pasos -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="step-card" data-step="1">
                                    <div class="step-number bg-success">1</div>
                                    <h5 class="text-success">Desechos de Peces</h5>
                                    <p class="small">Los peces producen amoníaco (NH₃) a través de sus excrementos y respiración.</p>
                                    <div class="step-arrow d-none d-lg-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="step-card" data-step="2">
                                    <div class="step-number bg-success">2</div>
                                    <h5 class="text-success">Transformación</h5>
                                    <p class="small">Bacterias convierten NH₃ en NO₂ y luego en NO₃, nutriente para plantas.</p>
                                    <div class="step-arrow d-none d-lg-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="step-card" data-step="3">
                                    <div class="step-number bg-success">3</div>
                                    <h5 class="text-success">Nutrición Vegetal</h5>
                                    <p class="small">Las plantas absorben los nitratos, filtrando el agua naturalmente.</p>
                                    <div class="step-arrow d-none d-lg-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="step-card" data-step="4">
                                    <div class="step-number bg-success">4</div>
                                    <h5 class="text-success">Agua Purificada</h5>
                                    <p class="small">El agua limpia retorna a los peces, completando el ciclo sostenible.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Beneficios destacados -->
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 mb-3">
                            <h5 class="text-center text-success mb-3"><i class="fas fa-star me-2"></i> Beneficios Clave</h5>
                            <div class="row text-center">
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="p-2 bg-white rounded-2 h-100">
                                        <i class="fas fa-recycle text-success fs-4 mb-2"></i>
                                        <div class="fw-bold small">Sistema Circular</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="p-2 bg-white rounded-2 h-100">
                                        <i class="fas fa-leaf text-success fs-4 mb-2"></i>
                                        <div class="fw-bold small">100% Orgánico</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="p-2 bg-white rounded-2 h-100">
                                        <i class="fas fa-tint text-success fs-4 mb-2"></i>
                                        <div class="fw-bold small">Ahorro de Agua</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-2">
                                    <div class="p-2 bg-white rounded-2 h-100">
                                        <i class="fas fa-fish text-success fs-4 mb-2"></i>
                                        <div class="fw-bold small">Doble Producción</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>


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
        <script src="<?php echo e(asset('AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/dist/js/adminlte.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/dist/js/adminlte.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</body>

</html><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/layouts/masterusers.blade.php ENDPATH**/ ?>