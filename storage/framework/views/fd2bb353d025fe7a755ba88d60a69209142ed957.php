
<?php $__env->startPush('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Control de Actividades</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<div class="container mt-4">
    <h2 class="text-center mb-4">Actividades Recibidas</h2>
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table id="tabla-actividad" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
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
                    <tr>
                        <td><?php echo e($n++); ?></td>
                        <td><?php echo e($activity->activity_name); ?></td>
                        <td><?php echo e($activity->user->first_name); ?> <?php echo e($activity->user->last_name); ?></td>
                        <td><?php echo e($activity->date); ?></td>
                        <td><?php echo e($activity->description); ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#agregar<?php echo e($activity->id); ?>">
                                <i class="bi bi-plus-circle"></i> + Evidencia
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Agregar Evidencia -->
                    <div class="modal fade" id="agregar<?php echo e($activity->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?php echo e(route('acuaponico.pasante.pasante.storecontrolactivity')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="activity_id" value="<?php echo e($activity->id); ?>">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Agregar Evidencia</h5>
                                        <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Actividad:</label>
                                            <input type="text" class="form-control" value="<?php echo e($activity->activity_name); ?>" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label>Fecha:</label>
                                            <input type="date" name="date" class="form-control date-input" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label>Novedades:</label>
                                            <textarea name="news" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Subir Evidencia (PDF):</label>
                                            <input type="file" name="evidence" class="form-control" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-primary" type="submit">Guardar</button>
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



<div class="container mt-5">
    <h3 class="text-center mb-4">Evidencias Registradas</h3>
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table id="tabla-evidencia" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
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
                    <tr>
                        <td><?php echo e($n++); ?></td>
                        <td><?php echo e($evidencia->activity->activity_name); ?></td>
                        <td><?php echo e($evidencia->date); ?></td>
                        <td><?php echo e($evidencia->news); ?></td>
                        <td>
                            <?php if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)): ?>
                            <span class="text-success">PDF Subido</span>
                            <?php else: ?>
                            <span class="text-danger">No disponible</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)): ?>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#verPdfModal<?php echo e($evidencia->id); ?>">
                                <i class="bi bi-eye"></i>
                                ver PDF
                            </button>
                            <?php endif; ?>

                            <!-- Botón editar -->
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editarModal<?php echo e($evidencia->id); ?>">
                                <i class="bi bi-pencil"></i> Editar
                            </button>

                            <!-- Botón eliminar -->
                            <button class="btn btn-sm btn-danger btnEliminar" data-url="<?php echo e(route('acuaponico.pasante.pasante.destroycontrolactivity', $evidencia->id)); ?>">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>


                        </td>
                    </tr>

                    <!-- Modal Ver PDF -->
                    <div class="modal fade" id="verPdfModal<?php echo e($evidencia->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Evidencia PDF</h5>
                                    <button class="btn-close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="<?php echo e(route('evidencia.ver', $evidencia->id)); ?>" width="100%" height="600px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar -->
                    <div class="modal fade" id="editarModal<?php echo e($evidencia->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?php echo e(route('acuaponico.pasante.pasante.updatecontrolactivity', $evidencia->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white">Editar Evidencia</h5>
                                        <button class="btn-close" data-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Fecha:</label>
                                            <input type="date" name="date" class="form-control" value="<?php echo e($evidencia->date); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Novedades:</label>
                                            <textarea name="news" class="form-control"><?php echo e($evidencia->news); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Actualizar PDF:</label>
                                            <input type="file" name="evidence" class="form-control" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Guardar Cambios</button>
                                        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
<!-- Modal Eliminar -->
<form id="formEliminar" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/controlactividad.blade.php ENDPATH**/ ?>