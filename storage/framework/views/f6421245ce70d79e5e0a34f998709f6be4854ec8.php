<!-- ======= Services Section ======= -->
    <section id="modules" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Aplicaciones</h2>
          <p>Soluciones de software para nuestro centro</p>
        </div>

        

        <div class="row">

          <?php $__currentLoopData = $apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <style type="text/css">
              .services .icon-box:hover .colorapp<?php echo e($app->id); ?> {
                color: <?php echo e($app->color); ?> !important;
              }

          </style>
          <div class="col-xl-3 col-md-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100" style="padding: 1%;">
            <div class="icon-box">
              <div class="icon">
              <h4><a class="colorapp<?php echo e($app->id); ?>" href="<?php echo e(url($app->url)); ?>"><i class="colorapp<?php echo e($app->id); ?> <?php echo e($app->icon); ?>"></i> <?php echo e($app->name); ?></a></h4></div>
              <p>
                <?php if(session('lang')=='en'): ?>
                  <?php echo e($app->description_english); ?>

                <?php else: ?>
                  <?php echo e($app->description); ?>                
                <?php endif; ?>
              </p>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>          

        </div>

      </div>
    </section><!-- End Services Section --><?php /**PATH C:\laragon\www\sicefados\resources\views/layouts/partials/modules.blade.php ENDPATH**/ ?>