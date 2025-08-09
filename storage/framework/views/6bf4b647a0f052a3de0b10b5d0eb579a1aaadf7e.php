

<?php $__env->startPush('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<h1>
    Hola, <?php echo e(auth()->user()->name); ?>! Bienvenido al Dashboard de Acuaponico
</h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/welcomepas.blade.php ENDPATH**/ ?>