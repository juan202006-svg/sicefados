<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SICEFA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swaphttps://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <?php echo $__env->make('layouts/partials/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</head>
<body class="antialiased">

    
        
    <?php echo $__env->make('layouts/partials/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts/partials/hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main id="main">

    <?php echo $__env->make('layouts/partials/clients', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->make('layouts/partials/ptoventa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('layouts/partials/modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    

    <!--include('layouts/partials/skins')--->
    
    <?php echo $__env->make('layouts/partials/cefa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts/partials/senaempresa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts/partials/About-Us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    

    

    

   

    <?php echo $__env->make('layouts/partials/contact', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</main>

    <?php echo $__env->make('layouts/partials/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts/partials/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    </body>
</html><?php /**PATH C:\laragon\www\sicefados\resources\views/welcome.blade.php ENDPATH**/ ?>