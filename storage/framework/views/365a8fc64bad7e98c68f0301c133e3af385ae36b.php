

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Lotes</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Gestión de Lotes</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Lotes</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#createLot">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Lote
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="lotesTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>S/Acuapónico</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Ocupado</th>
                            <th>Disponible</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($lot->aquaponicSystem->name); ?></td>
                            <td><?php echo e($lot->date); ?></td>
                            <td><?php echo e($lot->name); ?></td>
                            <td><?php echo e($lot->capacity); ?></td>
                            <td>
                                <?php if($lot->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/lotes/' . $lot->image)); ?>" alt="Imagen del lote" style="max-width: 100px; max-height: 100px;">
                                <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($lot->description): ?>
                                <span><?php echo e($lot->description); ?></span>
                                <?php else: ?>
                                <span class="text-muted">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($lot->ocupado); ?></td>
                            <td>
                                <?php if($lot->disponible > 0): ?>
                                <span class="badge bg-success"><?php echo e($lot->disponible); ?></span>
                                <?php else: ?>
                                <span class="badge bg-danger">0</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($lot->state); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de creación -->
    <div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storeLot')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="createLotLabel">Nuevo Lote</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row g-4">
                            <!-- Columna de datos básicos -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="date" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-calendar-alt mr-2"></i> Fecha
                                    </label>
                                    <input type="date" name="date" class="form-control form-control-lg custom-input" id="date" required readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="aquaponic_system_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-water mr-2"></i> Sistema Acuapónico
                                    </label>
                                    <select name="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                        <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                                        <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-tag mr-2"></i> Nombre
                                    </label>
                                    <input type="text" name="name" class="form-control form-control-lg custom-input" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="capacity" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sort-numeric-up mr-2"></i> Capacidad
                                    </label>
                                    <input type="number" name="capacity" class="form-control form-control-lg custom-input" required>
                                </div>
                            </div>
                            <!-- Columna de detalles adicionales -->
                            <div class="col-md-6">
                                 <div class="form-group mb-4">
                                    <label for="image" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-camera mr-2"></i> Imagen
                                    </label>
                                    <input type="file" name="image" class="form-control form-control-lg custom-input" accept="image/*" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-align-left mr-2"></i> Descripción
                                    </label>
                                    <textarea name="description" class="form-control form-control-lg custom-textarea" rows="3"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="state" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-toggle-on mr-2"></i> Estado
                                    </label>
                                    <select name="state" class="form-control form-control-lg custom-select" required>
                                        <option value="disponible">Disponible</option>
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

<!-- Script para establecer la fecha actual en el campo de fecha -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });
</script>

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
        $('#lotesTable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/index.blade.php ENDPATH**/ ?>