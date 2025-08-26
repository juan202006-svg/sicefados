

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white rounded-lg shadow-lg">
                <div class="card-body text-center py-5">
                    <h2 class="mb-2 display-4 font-weight-bold"><i class="fas fa-water mr-3"></i>Sistema de Gestión Acuapónica</h2>
                    <p class="mb-0 lead text-light">Monitoreo y Control de Sistemas de Producción</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards principales de conteos -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-2">
                                Sistemas Acuapónicos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($systems->count()); ?></div>
                            <div class="text-xs text-muted mt-2">Total registrados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-water fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-2">
                                Lotes Disponibles
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($availableLotsCount); ?></div>
                            <div class="text-xs text-muted mt-2">Disponibles para uso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success text-uppercase mb-2">
                                Cultivos Activos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($cropsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En seguimiento</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-2">
                                Resiembras Activas
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($resowingsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En proceso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-recycle fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/welcomepas.blade.php ENDPATH**/ ?>