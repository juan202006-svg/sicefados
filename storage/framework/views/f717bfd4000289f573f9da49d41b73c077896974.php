

<?php $__env->startSection('content3'); ?>
<style>
    table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-size: 54px; font-family: 'Savate', sans-serif; font-optical-sizing: auto; font-weight: 400; font-style: normal;">
        Gestión de Actividades
    </h2>
    <div class="border-bottom mb-4"></div>

    
    <div class="shadow p-4 rounded bg-light mb-5">
        <h4 class="text-center mb-4">Crear Nueva Actividad</h4>
        <form action="<?php echo e(route('acuaponico.admin.admin.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="activity_name" class="form-label">Nombre de la Actividad</label>
                    <input type="text" name="activity_name" id="activity_name" class="form-control form-control-lg" placeholder="Ingresa el nombre" required>
                </div>
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Aprendiz</label>
                    <select name="user_id" id="user_id" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Seleccione un aprendiz</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control form-control-lg" readonly>
                </div>
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-4">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" name="description" id="description" class="form-control form-control-lg" placeholder="Ingresa la descripción" required>
                </div>
                <div class="col-md-4">
                    <label for="activity_status" class="form-label">Estado</label>
                    <select name="activity_status" id="activity_status" class="form-select form-select-lg">
                        <option value="Pendiente">Pendiente</option>
                    </select>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">Crear Actividad</button>
                </div>
            </div>
        </form>
    </div>

    
    <h3 class="text-center text-secondary border-bottom pb-2 mb-4">Lista de Actividades</h3>
    <div class="d-flex justify-content-end align-items-center mb-3">
        <label for="busqueda-actividad" class="me-2 fw-semibold text-secondary">Buscar:</label>
        <input type="text" id="busqueda-actividad" class="form-control w-25" placeholder="Búsqueda..." onkeyup="filtrarTablaActividades()">
    </div>
    <div class="table-responsive">
        <table id="tabla-actividad" class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nombre Actividad</th>
                    <th>Aprendiz</th>
                    <th>Fecha</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1; ?>
                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($n++); ?></td>
                        <td><?php echo e($activity->activity_name); ?></td>
                        <td><?php echo e($activity->user->first_name); ?> <?php echo e($activity->user->last_name); ?></td>
                        <td><?php echo e($activity->date); ?></td>
                        <td><?php echo e($activity->start_date); ?></td>
                        <td><?php echo e($activity->end_date); ?></td>
                        <td><?php echo e($activity->description); ?></td>
                        <td>
                            <span class="badge 
                                <?php if($activity->activity_status == 'Pendiente'): ?> bg-danger
                                <?php elseif($activity->activity_status == 'Completada'): ?> bg-success
                                <?php else: ?> bg-secondary <?php endif; ?>">
                                <?php echo e(ucfirst(str_replace('_', ' ', $activity->activity_status))); ?>

                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($activity->id); ?>" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <form action="<?php echo e(route('acuaponico.admin.admin.destroy', $activity->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-sm btn-danger btn-delete me-1" data-activity-id="<?php echo e($activity->id); ?>" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <form action="<?php echo e(route('acuaponico.admin.admin.send', $activity->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <button type="submit" class="btn btn-sm btn-success" title="Enviar">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    
                    <div class="modal fade" id="editModal<?php echo e($activity->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($activity->id); ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="<?php echo e(route('acuaponico.admin.admin.update', $activity->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title w-100 text-center">Editar Actividad</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="activity_name_<?php echo e($activity->id); ?>" class="form-label">Nombre de la Actividad</label>
                                                <input type="text" name="activity_name" id="activity_name_<?php echo e($activity->id); ?>" class="form-control form-control-lg" value="<?php echo e($activity->activity_name); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="user_id_<?php echo e($activity->id); ?>" class="form-label">Aprendiz</label>
                                                <select name="user_id" id="user_id_<?php echo e($activity->id); ?>" class="form-select form-select-lg">
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($user->id); ?>" <?php echo e($activity->user_id == $user->id ? 'selected' : ''); ?>>
                                                            <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="date_<?php echo e($activity->id); ?>" class="form-label">Fecha</label>
                                                <input type="date" name="date" id="date_<?php echo e($activity->id); ?>" class="form-control form-control-lg" value="<?php echo e($activity->date); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="start_date_<?php echo e($activity->id); ?>" class="form-label">Fecha de Inicio</label>
                                                <input type="date" name="start_date" id="start_date_<?php echo e($activity->id); ?>" class="form-control form-control-lg" value="<?php echo e($activity->start_date); ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="end_date_<?php echo e($activity->id); ?>" class="form-label">Fecha de Fin</label>
                                                <input type="date" name="end_date" id="end_date_<?php echo e($activity->id); ?>" class="form-control form-control-lg" value="<?php echo e($activity->end_date); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="description_<?php echo e($activity->id); ?>" class="form-label">Descripción</label>
                                                <input type="text" name="description" id="description_<?php echo e($activity->id); ?>" class="form-control form-control-lg" value="<?php echo e($activity->description); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="activity_status_<?php echo e($activity->id); ?>" class="form-label">Estado</label>
                                                <select name="activity_status" id="activity_status_<?php echo e($activity->id); ?>" class="form-select form-select-lg">
                                                    <option value="Pendiente" <?php echo e($activity->activity_status == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                                                    <option value="Completada" <?php echo e($activity->activity_status == 'Completada' ? 'selected' : ''); ?>>Completada</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center">No se encontraron actividades.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-5">
        <h3 class="text-center text-secondary border-bottom pb-2 mb-4">Actividades Completadas</h3>
        <div class="d-flex justify-content-end align-items-center mb-3">
            <label for="busqueda-evidencia" class="me-2 fw-semibold text-secondary">Buscar:</label>
            <input type="text" id="busqueda-evidencia" class="form-control w-25" placeholder="Búsqueda..." onkeyup="filtrarTablaEvidencias()">
        </div>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table id="tabla-evidencia" class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Actividad</th>
                            <th>Fecha</th>
                            <th>Novedades</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $evidenciasAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evidencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#verPdfModal<?php echo e($evidencia->id); ?>" title="Ver PDF">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="<?php echo e(route('evidencia.descargar', $evidencia->id)); ?>" class="btn btn-sm btn-success" title="Descargar PDF">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <div class="modal fade" id="verPdfModal<?php echo e($evidencia->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Evidencia PDF</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="<?php echo e(route('evidencia.ver', $evidencia->id)); ?>" width="100%" height="600px"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="bg-white text-dark border-top mt-5 pt-4">
        <div class="container small">
            <div class="row gy-4 text-center text-md-start">
                <div class="col-md-4">
                    <h6 class="fw-bold text-uppercase">Sistema de Gestión ACUAPONICO</h6>
                    <p class="mb-1">Administra actividades, evidencias y usuariosслав

System: usuarios.</p>
                    <p class="mb-0 text-muted">Construido con Laravel & Bootstrap 5.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-uppercase">Desarrollado por</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1">Juan Sebastian Guzman Hernandez</li>
                        <li class="mb-1">
                            <a href="mailto:guzmanhernandezj603@gmail.com" class="text-decoration-none text-dark">
                                guzmanhernandezj603@gmail.com
                            </a>
                        </li>
                        <li class="mb-0">
                            <a href="tel:‪+573005954563‬" class="text-decoration-none text-dark">
                                ‪+57 300 595 4563‬
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-uppercase">Más información</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-decoration-none text-dark">Política de privacidad</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Términos de uso</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Soporte técnico</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted pb-2">
                © <?php echo e(date('Y')); ?> ACUAPONICO. Todos los derechos reservados.
            </div>
        </div>
    </footer>
</div>

<!-- Script para establecer la fecha actual -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;
    });
</script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inicializar DataTable y filtros -->
<script>
    $(document).ready(function() {
        const actividadTable = $('#tabla-actividad').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        const evidenciaTable = $('#tabla-evidencia').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        // Filtro para tabla de actividades
        window.filtrarTablaActividades = function() {
            const filter = $('#busqueda-actividad').val().toLowerCase();
            actividadTable.search(filter).draw();
        };

        // Filtro para tabla de evidencias
        window.filtrarTablaEvidencias = function() {
            const filter = $('#busqueda-evidencia').val().toLowerCase();
            evidenciaTable.search(filter).draw();
        };

        // Modal de confirmación de eliminación
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const activityId = this.getAttribute('data-activity-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción eliminará la actividad permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '<?php echo e(session("success")); ?>',
        showConfirmButton: false,
        timer: 2500,
        position: 'center'
    });
</script>
<?php endif; ?>

<?php if($errors->any()): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Caracteres no válidos o campos incompletos.',
        showConfirmButton: true,
        confirmButtonText: 'Cerrar',
        position: 'center'
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/actividades.blade.php ENDPATH**/ ?>