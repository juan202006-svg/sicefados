<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- update existing v5 CSS to use v6 icons and assets -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
    <script src="https://kit.fontawesome.com/dcb1bbced2.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('AdminLTE/dist/css/adminlte.min.css')); ?>" rel="stylesheet">
    
    <link href="<?php echo e(asset('general/assets/css/style.css')); ?>" rel="stylesheet">


</head>
<body>
    <div id="app">
        
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\sicefados\resources\views/layouts/app.blade.php ENDPATH**/ ?>