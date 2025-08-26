<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Especies</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Gestión de Especies</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Especies</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nueva Especie
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="especiesTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Nombre Científico</th>
                            <th>Nombre Común</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($especie->category->name ?? 'Sin categoría'); ?></td>
                            <td><?php echo e($especie->scientific_name); ?></td>
                            <td><?php echo e($especie->name); ?></td>
                            <td>
                                <?php if($especie->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/especies/' . $especie->image)); ?>" alt="Imagen de la especie" style="max-width: 100px; max-height: 100px;">
                                <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($especie->description ?? 'Sin descripción'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storespecies')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Agregar Nueva Especie</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row g-4">
                            <!-- Columna de datos básicos -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="category_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-list mr-2"></i> Categoría
                                    </label>
                                    <select name="category_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione una categoría</option>
                                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="scientific_name" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-flask mr-2"></i> Nombre Científico
                                    </label>
                                    <input type="text" name="scientific_name" class="form-control form-control-lg custom-input" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-leaf mr-2"></i> Nombre Común
                                    </label>
                                    <input type="text" name="name" class="form-control form-control-lg custom-input" required>
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
                                        <i class="fas fa-align-left mr-2"></i> Descripción (Opcional)
                                    </label>
                                    <textarea name="description" class="form-control form-control-lg custom-textarea" rows="3"></textarea>
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
        $('#especiesTable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/especies.blade.php ENDPATH**/ ?>