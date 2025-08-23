<!-- ======= Header ======= -->
<link rel="stylesheet" href="<?php echo e(asset('css/navbar.css')); ?>">
<header id="header" class="fixed-top"style="background-color: rgb(249, 89, 40, 0.7); ">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="<?php echo e(route('cefa.welcome')); ?>">SICEFA</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    <nav id="navbar-top" class="navbar" style="margin-right: 20px">
      <div class="navbar-nav">
          <div class="dropdown d-lg-none">
            <a class="nav-link scrollto" data-toggle="dropdown" href="#">
                Menu
            </a>
            <div class="dropdown-menu">
                <a class="nav-link scrollto" href="<?php echo e(route('cefa.welcome')); ?>">Inicio</a>
                <a class="nav-link scrollto" href="<?php echo e(route('cefa.developers')); ?>">Desarrolladores</a>
            </div>
        </div>
          <div class="dropdown d-lg-none">
              <?php if(auth()->guard()->check()): ?>
              <a href="<?php echo e(route('cefa.home')); ?>"><?php echo e(Auth::user()->nickname); ?></a>
              <div class="dropdown-menu">
                  <a href="<?php echo e(route('cefa.password.change.index')); ?>">Cambiar contraseña</a>
                  <a href="<?php echo e(route('logout')); ?>" class="d-block" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Salir</a>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                      <?php echo csrf_field(); ?>
                  </form>
              </div>
              <?php else: ?>
              <a href="<?php echo e(route('login', ['redirect' => url()->current()])); ?>">Log in</a>
              <?php endif; ?>
          </div>
          <div class="dropdown lang d-lg-none">
              <a class="nav-link scrollto" data-toggle="dropdown" href="#">
                  <?php echo e(session('lang')); ?> <i class="fas fa-globe"></i>
              </a>
              <div class="dropdown-menu">
                  <a href="<?php echo e(url('lang',['es'])); ?>" class="dropdown-item scrollto">Español</a>
                  <a href="<?php echo e(url('lang',['en'])); ?>" class="dropdown-item scrollto">English</a>
              </div>
          </div>
      </div>
  </nav>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="<?php echo e(route('cefa.welcome')); ?>">Inicio</a></li>
        <li><a class="nav-link scrollto" href="<?php echo e(route('cefa.developers')); ?>">Desarrolladores</a></li>
        <li class="dropdown">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('cefa.home')); ?>"><?php echo e(Auth::user()->nickname); ?></a>
              <ul>
                <li><a href="<?php echo e(route('cefa.password.change.index')); ?>">Cambiar contraseña</a></li>
                <li>
                  
              <a href="<?php echo e(route('logout')); ?>" class="d-block" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Salir</a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
              </form>

                </li>
              </ul>              
            <?php else: ?>
                <a href="<?php echo e(route('login', ['redirect' => url()->current()])); ?>">Log in</a>
            <?php endif; ?>            

        </li>
        <li class="dropdown">
          <a class="nav-link scrollto" data-toggle="dropdown" href="#">
            <?php echo e(session('lang')); ?> <i class="fas fa-globe"></i>
          </a>
          <ul>
            <li><a href="<?php echo e(url('lang',['es'])); ?>" class="dropdown-item scrollto">Español</a></li>
            <li><a href="<?php echo e(url('lang',['en'])); ?>" class="dropdown-item scrollto">English</a></li>
          </ul>
        </li>
      </ul>

    </nav><!-- .navbar -->

  </div>

</header><!-- End Header --><?php /**PATH C:\laragon\www\sicefados\resources\views/layouts/partials/HeaderDesing.blade.php ENDPATH**/ ?>