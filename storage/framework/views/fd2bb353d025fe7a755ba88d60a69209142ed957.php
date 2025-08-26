

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Control de Actividades</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid mt-4">
    <h2 class="fw-bold mb-4 text-primary text-center">Actividades Recibidas</h2>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Actividades</h5>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="actividades" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Actividad</th>
                            <th>Aprendiz</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Evidencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($activity->activity_name); ?></td>
                            <td><?php echo e($activity->user->first_name); ?> <?php echo e($activity->user->last_name); ?></td>
                            <td><?php echo e($activity->date); ?></td>
                            <td><?php echo e($activity->description); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#agregar<?php echo e($activity->id); ?>">
                                    <i class="fas fa-plus-circle mr-2"></i> + Evidencia
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Agregar Evidencia -->
                        <div class="modal fade" id="agregar<?php echo e($activity->id); ?>" tabindex="-1" aria-labelledby="agregarLabel<?php echo e($activity->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="<?php echo e(route('acuaponico.pasante.pasante.storecontrolactivity')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="activity_id" value="<?php echo e($activity->id); ?>">
                                    <div class="modal-content border-0 rounded-lg shadow-lg">
                                        <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                                            <h5 class="modal-title font-weight-bold" id="agregarLabel<?php echo e($activity->id); ?>">Agregar Evidencia</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-5 bg-white rounded-bottom">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-info-circle mr-2"></i> Actividad
                                                </label>
                                                <input type="text" class="form-control form-control-lg custom-input" value="<?php echo e($activity->activity_name); ?>" readonly>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-calendar-alt mr-2"></i> Fecha
                                                </label>
                                                <input type="date" name="date" class="form-control form-control-lg custom-input date-input" readonly>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-sticky-note mr-2"></i> Novedades
                                                </label>
                                                <textarea name="news" class="form-control form-control-lg custom-textarea"></textarea>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-file-pdf mr-2"></i> Subir Evidencia (PDF)
                                                </label>
                                                <input type="file" name="evidence" class="form-control form-control-lg custom-input" accept="application/pdf">
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <h3 class="fw-bold mb-4 text-primary text-center">Evidencias Registradas</h3>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Evidencias</h5>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="control" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Novedades</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $evidencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evidencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($evidencia->activity->activity_name); ?></td>
                            <td><?php echo e($evidencia->date); ?></td>
                            <td><?php echo e($evidencia->news); ?></td>
                            <td>
                                <?php if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)): ?>
                                <span class="text-success">Evidencia cargada</span>
                                <?php else: ?>
                                <span class="text-danger">Sin evidencia</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)): ?>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#verPdfModal<?php echo e($evidencia->id); ?>">
                                    <i class="fas fa-eye mr-2"></i> Ver PDF
                                </button>
                                <?php endif; ?>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editarModal<?php echo e($evidencia->id); ?>">
                                    <i class="fas fa-pencil-alt mr-2"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-danger btnEliminar" data-url="<?php echo e(route('acuaponico.pasante.pasante.destroycontrolactivity', $evidencia->id)); ?>">
                                    <i class="fas fa-trash mr-2"></i> Eliminar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Ver PDF -->
                        <div class="modal fade" id="verPdfModal<?php echo e($evidencia->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content border-0 rounded-lg shadow-lg">
                                    <div class="modal-header bg-primary text-white rounded-top p-4">
                                        <h5 class="modal-title font-weight-bold">Evidencia PDF</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-5 bg-white">
                                        <iframe src="<?php echo e(route('evidencia.ver', $evidencia->id)); ?>" width="100%" height="600px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editarModal<?php echo e($evidencia->id); ?>" tabindex="-1" aria-labelledby="editarLabel<?php echo e($evidencia->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="<?php echo e(route('acuaponico.pasante.pasante.updatecontrolactivity', $evidencia->id)); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-content border-0 rounded-lg shadow-lg">
                                        <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                                            <h5 class="modal-title font-weight-bold" id="editarLabel<?php echo e($evidencia->id); ?>">Editar Evidencia</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-5 bg-white rounded-bottom">
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-calendar-alt mr-2"></i> Fecha
                                                </label>
                                                <input type="date" name="date" class="form-control form-control-lg custom-input" value="<?php echo e($evidencia->date); ?>">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-sticky-note mr-2"></i> Novedades
                                                </label>
                                                <textarea name="news" class="form-control form-control-lg custom-textarea"><?php echo e($evidencia->news); ?></textarea>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label text-dark font-weight-bold custom-form-label">
                                                    <i class="fas fa-file-pdf mr-2"></i> Actualizar PDF (Opcional)
                                                </label>
                                                <input type="file" name="evidence" class="form-control form-control-lg custom-input" accept="application/pdf">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light p-4 rounded-bottom">
                                            <button type="button" class="btn btn-secondary btn-lg rounded-pill px-4" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="formEliminar" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>

<link rel="stylesheet" href="<?php echo e(asset('css/custom-styles.css')); ?>">

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.date-input');
        const today = new Date().toISOString().slice(0, 10);
        inputs.forEach(input => input.value = today);
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

<script>
    document.querySelectorAll('.btnEliminar').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción eliminará la evidencia!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('formEliminar');
                    form.action = url;
                    form.submit();
                }
            });
        });
    });
</script>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#actividades').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#control').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/controlactividad.blade.php ENDPATH**/ ?>