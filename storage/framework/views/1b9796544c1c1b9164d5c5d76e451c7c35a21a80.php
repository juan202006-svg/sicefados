<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Sistemas Acuapónicos</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Registro de Sistemas Acuapónicos</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Sistemas Acuapónicos</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Sistema
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="acuaponicoTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Ubicación</th>
                            <th>Imagen</th>
                            <th>Capacidad de Lotes</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td>
                                <?php if($item->description): ?>
                                <?php echo e($item->description); ?>

                                <?php else: ?>
                                <span class="text-muted">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->location); ?></td>
                            <td>
                                <?php if($item->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/acuaponico/' . $item->image)); ?>"
                                    class="img-thumbnail rounded"
                                    style="max-width: 90px; max-height: 90px;">
                                <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->lot_capacity); ?></td>
                            <td>
                                <?php if($item->active): ?>
                                <span class="badge badge-success">Activo</span>
                                <?php else: ?>
                                <span class="badge badge-danger">Inactivo</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade  center" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="<?php echo e(route('acuaponico.pasante.pasante.acuaponicostore')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content border-0 rounded-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Agregar Nuevo Sistema</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-signature mr-2"></i> Nombre
                                    </label>
                                    <input type="text" name="name" class="form-control form-control-lg custom-input" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="location" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-map-marker-alt mr-2"></i> Ubicación
                                    </label>
                                    <input type="text" name="location" class="form-control form-control-lg custom-input" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="lot_capacity" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-layer-group mr-2"></i> Capacidad de Lotes
                                    </label>
                                    <input type="number" name="lot_capacity" class="form-control form-control-lg custom-input" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-align-left mr-2"></i> Descripción
                                    </label>
                                    <textarea class="form-control form-control-lg custom-textarea" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-camera mr-2"></i> Imagen
                                    </label>
                                    <input type="file" name="image" class="form-control form-control-lg custom-input" accept="image/*" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="active" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-toggle-on mr-2"></i> Estado
                                    </label>
                                    <select class="form-control form-control-lg custom-select" name="active" required>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light p-4 rounded-bottom">
                        <button type="button" class="btn btn-secondary btn-lg rounded-pill px-4" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo e(asset('css/custom-styles.css')); ?>">

<?php if(session('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '<?php echo e(session("success")); ?>',
            confirmButtonColor: '#3085d6',
        });
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo e(session("error")); ?>',
            confirmButtonColor: '#d33',
        });
    });
</script>
<?php endif; ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#acuaponicoTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/acuaponico.blade.php ENDPATH**/ ?>