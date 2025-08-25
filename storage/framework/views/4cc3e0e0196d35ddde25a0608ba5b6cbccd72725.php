

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Seguimientos generales</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content8'); ?>
<div class="container-fluid px-4" style="width: 80%; margin-top: 5%;">
    <div class="container mt-5">
        <div class="card shadow">
            <!-- Header con animación dentro de la tarjeta -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h3 mb-0 text-gray-800 fw-bold" style="font-size: 300%; margin-left: 8%; margin-top: 3%;">
                        Gestión de Seguimientos
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con animación -->
    <div class="card shadow border-0 animate__animated animate__fadeInUp" style="margin-top: 10%;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary fw-semibold" style="margin-left: 3%;">
                <i class="fas fa-list mr-2"></i>Lista de Seguimientos
            </h5>
            <div class="spinner-grow text-primary spinner-grow-sm" role="status" id="tableSpinner">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-0" style="margin-top: 2%; width: 90%; margin-left: 5%; margin-bottom: 5%;">
            <button type="button" class="btn btn-success shadow-sm rounded-pill px-4 py-2 btn-hover-scale" data-toggle="modal" data-target="#agregar"
            style="margin-left: 78%;">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Seguimiento
            </button>
            <div class="table-responsive" style="margin-top: 3%; max-height: 500px; overflow-y: auto;">
                <table id="seguimientosTable" class="table table-hover align-middle mb-0" style="border: 1px solid #dee2e6;">
                    <thead class="thead-light" style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">#</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Sistema Acuapónico</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Fecha</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Cultivo</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Tiempo (días)</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Novedades</th>
                            <th class="text-center" style="padding: 12px 8px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeInRight" style="animation-delay: <?php echo e($n * 0.05); ?>s; border-bottom: 1px solid #dee2e6;">
                            <td class="text-center fw-bold" style="border-right: 1px solid #dee2e6; padding: 12px 8px;"><?php echo e($n++); ?></td>
                            <td class="fw-medium" style="border-right: 1px solid #dee2e6; padding: 12px 8px;"><?php echo e($seguimiento->crops->aquaponicSystem->name ?? 'Sin sistema'); ?></td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;"><?php echo e($seguimiento->date); ?></td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;"><?php echo e($seguimiento->crops->species->name ?? 'Sin cultivo'); ?></td>
                            <td class="text-center fw-bold" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                <span class="badge bg-info rounded-pill px-3 py-2"><?php echo e($seguimiento->days_elapsed); ?></span>
                            </td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                <?php if($seguimiento->notes): ?>
                                <span class="text-muted" data-toggle="tooltip" title="<?php echo e($seguimiento->notes); ?>"><?php echo e(Str::limit($seguimiento->notes, 40)); ?></span>
                                <?php else: ?>
                                <span class="text-muted font-italic">Sin novedades</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center" style="padding: 12px 8px;">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar Mejorado - SOLO ICONO AMARILLO -->
                                    <button type="button" class="btn btn-action btn-edit editbtn"
                                        data-id="<?php echo e($seguimiento->id); ?>"
                                        date-aquaponic_system_id="<?php echo e($seguimiento->aquaponic_system_id); ?>"
                                        data-date="<?php echo e($seguimiento->date); ?>"
                                        data-crop_id="<?php echo e($seguimiento->crop_id); ?>"
                                        data-days_elapsed="<?php echo e($seguimiento->days_elapsed); ?>"
                                        data-notes="<?php echo e($seguimiento->notes); ?>"
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar Mejorado -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar" data-id="<?php echo e($seguimiento->id); ?>">
                                        <div class="btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <span class="btn-tooltip">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar - Versión Compacta -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0" id="editarLabel">
                    <i class="fas fa-edit mr-2"></i>
                    Editar Seguimiento
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="formEditar" action="<?php echo e(route ('acuaponico.pasante.pasante.updatetracking',0)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="form-group mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tag mr-1"></i>Sistema Acuapónico:
                        </label>
                        <select id="edit-aquaponic_system_id" name="aquaponic_system_id" class="form-control form-control-sm rounded" required>
                            <option value="">Seleccione un sistema acuapónico</option>
                            <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-crop_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-seedling mr-1"></i>Cultivo:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-crop_id" name="crop_id" required>
                            <option value="">Seleccione un cultivo</option>
                            <?php $__currentLoopData = $cultivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cultivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cultivo->id); ?>" data-date="<?php echo e($cultivo->date); ?>"
                                data-system="<?php echo e($cultivo->aquaponic_system_id); ?>"><?php echo e($cultivo->species->name ?? 'no hay cultivos'); ?> - <?php echo e($cultivo->status); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-days_elapsed" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-clock mr-1"></i>Tiempo en días:
                        </label>
                        <input type="number" class="form-control form-control-sm rounded" id="edit-days_elapsed" name="days_elapsed" readonly>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-notes" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-sticky-note mr-1"></i>Novedades:
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="edit-notes" name="notes" rows="2" style="resize: none;"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-1" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-1 shadow">
                        <i class="fas fa-save mr-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar - Versión Compacta (Nuevo estilo) -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nuevo Seguimiento
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?php echo e(route ('acuaponico.pasante.pasante.storetracking')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="date" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-calendar mr-1"></i>Fecha:
                        </label>
                        <input type="date" name="date" class="form-control form-control-sm rounded" id="date" readonly>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="aquaponic_system_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tag mr-1"></i>Sistema Acuapónico:
                        </label>
                        <select id="aquaponic_system_id" name="aquaponic_system_id" class="form-control form-control-sm rounded" required>
                            <option value="">Seleccione un sistema acuapónico</option>
                            <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="crop_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-seedling mr-1"></i>Cultivo:
                        </label>
                        <select name="crop_id" id="crop_id" class="form-control form-control-sm rounded" required>
                            <option value="">Seleccione un cultivo</option>
                            <?php $__currentLoopData = $cultivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cultivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($cultivo->id); ?>"
                                data-date="<?php echo e($cultivo->date); ?>"
                                data-system="<?php echo e($cultivo->aquaponic_system_id); ?>">
                                <?php echo e($cultivo->species->name?? 'no hay cultivos'); ?> - <?php echo e($cultivo->status); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="days_elapsed" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-clock mr-1"></i>Tiempo en días:
                        </label>
                        <input type="number" name="days_elapsed" class="form-control form-control-sm rounded" id="days_elapsed" readonly>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="notes" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-sticky-note mr-1"></i>Novedades:
                        </label>
                        <textarea name="notes" class="form-control form-control-sm rounded" id="notes" rows="2" style="resize: none;" required></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-1" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-1 shadow">
                        <i class="fas fa-save mr-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Formulario oculto para eliminación -->
<form id="formEliminar" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('delete'); ?>
</form>

<!-- Footer Sencillo -->
<footer class="footer mt-5 py-3 bg-light border-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="text-muted small">
                    &copy; <?php echo e(date('Y')); ?> Sistema Acuapónico. Todos los derechos reservados.
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    margin-top: auto;
    background-color: #f8f9fa !important;
    border-top: 1px solid #e9ecef !important;
}

/* Estilos para la tabla con scroll */
.table-responsive {
    max-height: 500px;
    overflow-y: auto;
}

.thead-light {
    position: sticky;
    top: 0;
    z-index: 1;
}
</style>

<!-- Estilos adicionales para animaciones y botones mejorados -->
<style>
    /* Animaciones personalizadas */
    @keyframes  fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes  pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes  bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    @keyframes  shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    @keyframes  iconPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    @keyframes  borderFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .animate__animated {
        animation-duration: 0.5s;
        animation-fill-mode: both;
    }
    
    .animate__fadeInDown {
        animation-name: fadeInDown;
    }
    
    .animate__fadeInUp {
        animation-name: fadeInUp;
    }
    
    .animate__fadeInRight {
        animation-name: fadeInRight;
    }
    
    /* Contenedor de botones de acción */
    .action-buttons {
        gap: 12px;
    }
    
    /* Botones de acción mejorados */
    .btn-action {
        position: relative;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Botón de editar - SOLO ICONO AMARILLO SIN FONDO */
    .btn-edit {
        background: transparent !important;
        box-shadow: none !important;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #e74a3b, #be2617);
    }
    
    .btn-action:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    
    .btn-action:active {
        transform: translateY(0) scale(0.98);
    }
    
    /* Botón de editar hover - SOLO ICONO AMARILLO */
    .btn-edit:hover {
        background: transparent !important;
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #be2617, #e74a3b);
        animation: shake 0.5s ease;
    }
    
    /* Iconos dentro de los botones */
    .btn-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    /* Icono de editar - COLOR AMARILLO */
    .btn-edit .btn-icon {
        color: #ffc107 !important; /* Color amarillo */
    }
    
    .btn-delete .btn-icon {
        color: white;
    }
    
    .btn-action:hover .btn-icon {
        animation: iconPulse 0.5s ease;
    }
    
    /* Tooltips para botones */
    .btn-tooltip {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 3px 6px rgba(0,0,0,0.16);
    }
    
    .btn-action:hover .btn-tooltip {
        opacity: 1;
        visibility: visible;
        bottom: -35px;
    }
    
    /* Efectos de hover */
    .btn-hover-scale {
        transition: all 0.3s ease;
    }
    
    .btn-hover-scale:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Estado activo con pulso */
    .pulse-active {
        animation: pulse 2s infinite;
    }
    
    /* Spinner personalizado */
    .spinner-grow {
        animation-duration: 0.8s;
    }
    
    /* Efecto de carga para la tabla */
    #seguimientosTable {
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    
    #seguimientosTable.loaded {
        opacity: 1;
    }
    
    /* Tooltip personalizado */
    .tooltip-inner {
        background-color: #333;
        color: #fff;
        border-radius: 4px;
        padding: 5px 10px;
    }
    
    .bs-tooltip-top .arrow::before {
        border-top-color: #333;
    }
    
    /* Estilos para tabla con líneas */
    #seguimientosTable {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    
    #seguimientosTable th,
    #seguimientosTable td {
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }
    
    #seguimientosTable th:last-child,
    #seguimientosTable td:last-child {
        border-right: none;
    }
    
    #seguimientosTable tr:last-child td {
        border-bottom: none;
    }
    
    #seguimientosTable thead th {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }
    
    /* ESTILOS ESPECÍFICOS PARA LOS MODALES MEJORADOS */
    .bg-gradient-primary {
        background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
    }
    
    .border-top-animation {
        height: 4px;
        background: linear-gradient(90deg, #4e73df, #224abe, #4e73df);
        background-size: 200% 100%;
        animation: borderFlow 3s ease infinite;
        width: 100%;
    }
    
    .btn-modal-save {
        background: linear-gradient(135deg, #4e73df, #224abe);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-modal-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4) !important;
    }
    
    .btn-modal-save:active {
        transform: translateY(0);
    }
    
    .btn-modal-cancel {
        transition: all 0.3s ease;
    }
    
    .btn-modal-cancel:hover {
        background-color: #858796;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .custom-file-label {
        transition: all 0.3s ease;
    }
    
    .custom-file-input:focus ~ .custom-file-label {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    /* Animación para el modal completo */
    @keyframes  modalEntry {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        transform: translate(0, -50px);
        opacity: 0;
    }
    
    .modal.show .modal-dialog {
        transform: translate(0, 0);
        opacity: 1;
        animation: modalEntry 0.4s ease;
    }
    
    /* Estilos para inputs más pequeños */
    .form-control-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('seguimientosTable').classList.add('loaded');
        }, 800);
        
        // Script para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/seguimiento/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-aquaponic_system_id').value = this.getAttribute('date-aquaponic_system_id');
                document.getElementById('edit-crop_id').value = this.getAttribute('data-crop_id');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');
            });
        });

        // Script para establecer la fecha actual en el campo de fecha
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;

        // Script para mostrar los tiempos en dias en el campo al selecionar otro cultivo a la hora de editar
        document.getElementById('edit-crop_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaCultivo = selectedOption.getAttribute('data-date');

            if (fechaCultivo) {
                const fechaInicio = new Date(fechaCultivo);
                const fechaHoy = new Date();
                const diffTiempo = fechaHoy - fechaInicio;
                const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

                document.getElementById('edit-days_elapsed').value = diffDias;
            } else {
                document.getElementById('edit-days_elapsed').value = '';
            }
        });

        // Script para SweetAlert de eliminación - CORREGIDO
        document.querySelectorAll('.btnEliminar').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Crear un estilo dinámico para SweetAlert que coincida con tu tema
                const dynamicStyle = `
                    <style>
                        .swal2-popup.custom-delete-style {
                            background: #fff;
                            border-radius: 12px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                            border: 1px solid #e3e6f0;
                            overflow: hidden;
                            padding: 2rem;
                            max-width: 450px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-title {
                            color: #e74a3b;
                            font-weight: 600;
                            font-size: 1.5rem;
                            margin-bottom: 15px;
                            padding-bottom: 15px;
                            border-bottom: 1px solid #e3e6f0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-html-container {
                            color: #5a5c69;
                            font-size: 1rem;
                            line-height: 1.5;
                            margin: 1.5rem 0;
                            text-align: center;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-icon {
                            width: 60px;
                            height: 60px;
                            border: 4px solid #f8d7da;
                            color: #e74a3b;
                            margin: 10px auto 5px;
                            position: relative;
                            box-sizing: content-box;
                            border-radius: 50%;
                            animation: pulse-icon 2s infinite;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-icon .swal2-icon-content {
                            font-size: 2.5rem;
                            font-weight: bold;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-actions {
                            margin: 1.5rem 0 0.5rem;
                            gap: 15px;
                            width: 100%;
                            display: flex;
                            justify-content: center;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-confirm {
                            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
                            border: none;
                            border-radius: 50px;
                            padding: 10px 25px;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(231, 74, 59, 0.3);
                            transition: all 0.3s ease;
                            min-width: 120px;
                            color: white;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-confirm:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 6px 15px rgba(231, 74, 59, 0.4);
                        }
                        
                        /* ESTILOS ESPECÍFICOS PARA EL BOTÓN DE CANCELAR */
                        .swal2-popup.custom-delete-style .swal2-cancel {
                            background: #fff;
                            color: #5a5c69;
                            border: 1px solid #e3e6f0;
                            border-radius: 50px;
                            padding: 10px 25px;
                            font-weight: 600;
                            transition: all 0.3s ease;
                            min-width: 120px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-cancel:hover {
                            background: #f8f9fc;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                            color: #4e73df;
                            border-color: #4e73df;
                        }
                        
                        /* Mejorar el contraste del texto en el botón de cancelar */
                        .swal2-popup.custom-delete-style .swal2-cancel:focus {
                            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.25);
                        }
                        
                        @keyframes  pulse-icon {
                            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0.4); }
                            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(231, 74, 59, 0); }
                            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0); }
                        }
                        
                        /* Animación de entrada personalizada */
                        @keyframes  custom-modal-in {
                            0% { 
                                transform: scale(0.96) translateY(10px);
                                opacity: 0;
                            }
                            100% { 
                                transform: scale(1) translateY(0);
                                opacity: 1;
                            }
                        }
                        
                        .swal2-show.custom-delete-style {
                            animation: custom-modal-in 0.3s ease-out;
                        }
                        
                        /* Efecto de brillo en el borde superior */
                        .swal2-popup.custom-delete-style::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            height: 4px;
                            background: linear-gradient(90deg, #ff9d9d, #e74a3b, #be2617);
                            border-radius: 4px 4px 0 0;
                        }
                    </style>
                `;
                
                // Agregar el estilo dinámico al documento
                document.head.insertAdjacentHTML('beforeend', dynamicStyle);
                
                Swal.fire({
                    title: '<i class="fas fa-exclamation-triangle mr-2"></i>¿Eliminar Seguimiento?',
                    html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y el seguimiento será eliminado permanentemente.</div>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'transparent',
                    cancelButtonColor: 'transparent',
                    confirmButtonText: '<i class="fas fa-trash text-white mr-2"></i>Eliminar',
                    cancelButtonText: '<i class="fas fa-times mr-2"></i>Cancelar',
                    reverseButtons: true,
                    customClass: {
                        popup: 'custom-delete-style',
                        title: 'custom-title',
                        htmlContainer: 'custom-html',
                        confirmButton: 'custom-confirm',
                        cancelButton: 'custom-cancel',
                        icon: 'custom-icon'
                    },
                    buttonsStyling: false,
                    showClass: {
                        popup: 'swal2-show custom-delete-style'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Usar el formulario existente en lugar de crear uno nuevo
                        const formEliminar = document.getElementById('formEliminar');
                        formEliminar.action = `/pasante/seguimiento/destroy/${id}`;
                        formEliminar.submit();
                    }
                    
                    // Eliminar el estilo dinámico después de usar
                    const dynamicStyles = document.querySelectorAll('style');
                    dynamicStyles.forEach(style => {
                        if (style.textContent.includes('custom-delete-style')) {
                            style.remove();
                        }
                    });
                });
            });
        });

        // Script para calcular días transcurridos al cambiar cultivo
        document.getElementById('crop_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaCultivo = selectedOption.getAttribute('data-date');

            if (fechaCultivo) {
                const fechaInicio = new Date(fechaCultivo);
                const fechaHoy = new Date();

                const diffTiempo = fechaHoy - fechaInicio;
                const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

                // Asignar al campo
                document.getElementById('days_elapsed').value = diffDias;
            } else {
                document.getElementById('days_elapsed').value = '';
            }
        });

        // Configurar dependencia entre sistema y cultivo
        function setupSystemCropDependency(systemSelectId, cropSelectId, daysInputId = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const cropSelect = document.getElementById(cropSelectId);
            if (!systemSelect || !cropSelect) return;

            // Guardar todas las opciones al iniciar
            const allOptions = Array.from(cropSelect.options).slice(1); // Omitir "Seleccione un cultivo"

            systemSelect.addEventListener('change', function() {
                const selectedSystemId = this.value;

                cropSelect.innerHTML = '<option value="">Seleccione un cultivo</option>';

                allOptions.forEach(option => {
                    if (option.getAttribute('data-system') === selectedSystemId) {
                        cropSelect.appendChild(option.cloneNode(true)); // importante: clonar para evitar remover de otros selects
                    }
                });

                if (daysInputId) {
                    const daysInput = document.getElementById(daysInputId);
                    if (daysInput) daysInput.value = '';
                }
            });
        }

        // Agregar (modal nuevo)
        setupSystemCropDependency('aquaponic_system_id', 'crop_id', 'days_elapsed');

        // Editar (modal editar)
        setupSystemCropDependency('edit-aquaponic_system_id', 'edit-crop_id', 'edit-days_elapsed');

        // DataTable initialization
        $('#seguimientosTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            },
            columnDefs: [
                { orderable: false, targets: [6] } // Deshabilitar ordenamiento en columna de acciones
            ],
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#seguimientosTable tbody tr').addClass('animate__animated animate__fadeInRight');
            }
        });
        
        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            animation: true
        });
        
        // Efecto de hover en botones de acción
        $('.btn-action').hover(
            function() {
                $(this).css('transform', 'translateY(-3px) scale(1.05)');
            },
            function() {
                $(this).css('transform', 'translateY(0) scale(1)');
            }
        );
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
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            }
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
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/seguimientogeneral.blade.php ENDPATH**/ ?>