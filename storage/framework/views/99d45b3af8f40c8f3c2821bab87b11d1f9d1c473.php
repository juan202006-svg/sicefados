

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Lotes</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
<div class="container-fluid px-4" style="width: 80%; margin-top: 5%;">
    <div class="container mt-5">
        <div class="card shadow">
            <!-- Header con animación dentro de la tarjeta -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h3 mb-0 text-gray-800 fw-bold" style="font-size: 300%; margin-left: 8%; margin-top: 3%;">
                        Gestión de Lotes
=======
<div class="container-fluid px-4" style="width: 95%; margin-top: 3%;">
    <!-- Header mejorado con gradiente y sombra -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center mb-3 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-seedling me-3"></i>Gestión de Lotes
>>>>>>> cad849286dfca37aaa02f449787abfe08a1c3622
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con diseño moderno -->
    <div class="card shadow-lg border-0 mt-4 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 text-primary fw-semibold">
                <i class="fas fa-list me-2"></i>Lista de Lotes
            </h5>
            <div class="spinner-border text-primary" role="status" id="tableSpinner" style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <small class="text-muted">Total de lotes: <?php echo e(count($lots)); ?></small>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#createLot"
                    style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%); border: none; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Lote
                </button>
            </div>
            
            <div class="table-responsive rounded-3 shadow-sm" style="overflow-x: auto;">
                <table id="lotesTable" class="table table-hover align-middle mb-0" style="border: 1px solid #e3e6f0; min-width: 1200px;">
                    <thead>
                        <tr>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 50px; background-color: #71ccef; color: white;">#</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 150px; background-color: #71ccef; color: white;">S/Acuapónico</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 120px; background-color: #71ccef; color: white;">Fecha</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 150px; background-color: #71ccef; color: white;">Nombre</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 100px; background-color: #71ccef; color: white;">Capacidad</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 100px; background-color: #71ccef; color: white;">Imagen</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 200px; background-color: #71ccef; color: white;">Descripción</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 100px; background-color: #71ccef; color: white;">Ocupado</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 120px; background-color: #71ccef; color: white;">Disponible</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.3); min-width: 130px; background-color: #71ccef; color: white;">Estado</th>
                            <th class="text-center py-3" style="min-width: 130px; background-color: #71ccef; color: white;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: <?php echo e($n * 0.03); ?>s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($n++); ?></td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($lot->aquaponicSystem->name ?? 'Sin sistema'); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($lot->date); ?></td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($lot->name); ?></td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-info rounded-pill px-3 py-2 shadow-sm"><?php echo e($lot->capacity); ?></span>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($lot->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/lotes/' . $lot->image)); ?>" 
                                     alt="Imagen del lote" 
                                     class="img-thumbnail rounded-circle img-hover-zoom" 
                                     style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #e3e6f0;"
                                     data-toggle="modal" data-target="#imageModal" data-image="<?php echo e(asset('modules/acuaponico/images/lotes/' . $lot->image)); ?>">
                                <?php else: ?>
                                <span class="badge bg-light p-2 rounded-circle">
                                    <i class="fas fa-image text-muted"></i>
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($lot->description): ?>
                                <span class="text-muted" data-toggle="tooltip" title="<?php echo e($lot->description); ?>"><?php echo e(Str::limit($lot->description, 40)); ?></span>
                                <?php else: ?>
                                <span class="text-muted font-italic">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-warning rounded-pill px-3 py-2 shadow-sm"><?php echo e($lot->ocupado); ?></span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($lot->disponible > 0): ?>
                                <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm"><?php echo e($lot->disponible); ?></span>
                                <?php else: ?>
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">0</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($lot->state === 'disponible'): ?>
                                <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm pulse-active">Disponible</span>
                                <?php else: ?>
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">No Disponible</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="<?php echo e($lot->id); ?>"
                                        data-aquaponic_system_id="<?php echo e($lot->aquaponic_system_id); ?>"
                                        data-date="<?php echo e($lot->date); ?>"
                                        data-name="<?php echo e($lot->name); ?>"
                                        data-capacity="<?php echo e($lot->capacity); ?>"
                                        data-image="<?php echo e($lot->image); ?>"
                                        data-description="<?php echo e($lot->description); ?>"
                                        data-state="<?php echo e($lot->state); ?>"
                                        data-ocupado="<?php echo e($lot->ocupado); ?>"
                                        data-toggle="modal"
                                        data-target="#updateLot">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="<?php echo e($lot->id); ?>">
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
            
            <!-- Indicador de scroll -->
            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>Desliza horizontalmente para ver más columnas
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Modal para visualización de imagen -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title"><i class="fas fa-image me-2"></i>Imagen del Lote</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="modalImage" src="" alt="Imagen ampliada" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="createLotLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Lote
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storeLot')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="date" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-calendar me-1"></i>Fecha:
                        </label>
                        <input type="date" name="date" class="form-control form-control-sm rounded" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                        </label>
                        <select name="aquaponic_system_id" class="form-control form-control-sm rounded" required>
                            <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                            <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
<<<<<<< HEAD
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tag mr-1"></i>Nombre:
=======
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-tag me-1"></i>Nombre:
>>>>>>> cad849286dfca37aaa02f449787abfe08a1c3622
                        </label>
                        <input type="text" name="name" class="form-control form-control-sm rounded" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-boxes me-1"></i>Capacidad:
                        </label>
                        <input type="number" name="capacity" class="form-control form-control-sm rounded" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-camera me-1"></i>Imagen:
                        </label>
                        <input type="file" name="image" class="form-control form-control-sm rounded" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción:
                        </label>
                        <textarea name="description" class="form-control form-control-sm rounded" rows="3" style="resize: none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-power-off me-1"></i>Estado:
                        </label>
                        <select name="state" class="form-control form-control-sm rounded" required>
                            <option value="disponible">Disponible</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-2 shadow">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de edición -->
<div class="modal fade" id="updateLot" tabindex="-1" aria-labelledby="updateLotLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateLot', 0)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                <div class="modal-header bg-gradient-primary text-white py-3">
                    <h5 class="modal-title fw-bold mb-0" id="updateLotLabel">
                        <i class="fas fa-edit me-2"></i>
                        Editar Lote
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                            <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-tag me-1"></i>Nombre:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="edit-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-capacity" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-boxes me-1"></i>Capacidad:
                        </label>
                        <input type="number" class="form-control form-control-sm rounded" id="edit-capacity" name="capacity">
                        <div class="invalid-feedback" id="error-capacidad-lote"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="text-center border rounded p-2 h-100 d-flex flex-column justify-content-center">
                                <label class="form-label small fw-bold text-primary mb-1 d-block">
                                    <i class="fas fa-image me-1"></i>Imagen actual:
                                </label>
                                <div class="mt-1 image-preview-container">
                                    <img id="edit-preview-image" src="" alt="Imagen del lote" 
                                         class="img-fluid rounded modal-image-preview" style="max-height: 80px;">
                                    <div class="no-image-placeholder" id="no-image-placeholder" style="display: none;">
                                        <i class="fas fa-image text-muted" style="font-size: 1.5rem;"></i>
                                        <p class="text-muted mt-1 small">Sin imagen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group h-100 d-flex flex-column justify-content-center">
                                <label for="edit-image" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-camera me-1"></i>Cambiar imagen:
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom-file-input-sm" id="edit-image" name="image" accept="image/*">
                                    <label class="custom-file-label small rounded" for="edit-image" id="edit-image-label">
                                        <i class="fas fa-upload me-1"></i>Seleccionar
                                    </label>
                                </div>
                                <small class="form-text text-muted mt-1 small">
                                    Formatos: JPG, PNG, GIF. Máx: 2MB
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción:
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="edit-description" name="description" rows="3" style="resize: none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-state" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-power-off me-1"></i>Estado:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-state" name="state" required>
                            <option value="disponible">Disponible</option>
                            <option value="no disponible">No Disponible</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-2 shadow">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer Sencillo -->
<footer class="footer mt-5 py-4 bg-light border-top">
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

/* Estilos mejorados para un aspecto más profesional */
.card {
    border: none;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
    background-color: rgba(78, 115, 223, 0.05);
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);
}

.badge {
    font-weight: 500;
}

/* Animaciones personalizadas */
@keyframes  fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes  pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    to { transform: scale(1); }
}

@keyframes  bounce {
    0%, 20%, 50%, 80%, to { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

@keyframes  shake {
    0%, to { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes  iconPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    to { transform: scale(1); }
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
    width: 40px;
    height: 40px;
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

.img-hover-zoom {
    transition: transform 0.3s ease;
    cursor: pointer;
}

.img-hover-zoom:hover {
    transform: scale(1.8);
    z-index: 100;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
#lotesTable {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#lotesTable.loaded {
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
#lotesTable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

#lotesTable th,
#lotesTable td {
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
}

#lotesTable th:last-child,
#lotesTable td:last-child {
    border-right: none;
}

#lotesTable tr:last-child td {
    border-bottom: none;
}

#lotesTable thead th {
    background-color: #71ccef;
    border-top: 1px solid #e3e6f0;
    border-bottom: 2px solid #e3e6f0;
    font-weight: 600;
    color: white;
}

/* ESTILOS ESPECÍFICOS PARA EL MODAL DE EDICIÓN MEJORADO */
.bg-gradient-primary {
    background: linear-gradient(87deg, #71ccef 0, #71ccef 100%) !important;
}

.modal-image-preview {
    max-height: 80px;
    object-fit: cover;
    transition: all 0.3s ease;
    border: 2px solid #e3e6f0;
    border-radius: 8px;
}

.modal-image-preview:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.image-preview-container {
    position: relative;
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-modal-save {
    background: linear-gradient(135deg, #71ccef, #71ccef);
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
    background: #858796;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.custom-file-label {
    transition: all 0.3s ease;
    border-radius: 6px;
}

.custom-file-input:focus ~ .custom-file-label {
    border-color: #71ccef;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

/* Animación para el modal completo */
@keyframes  modalEntry {
    0% {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
    }
    to {
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
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 6px;
    border: 1px solid #d1d3e2;
}

.form-control-sm:focus {
    border-color: #71ccef;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.custom-file-input-sm {
    height: calc(1.5em + 1rem + 2px);
}

.custom-file-input-sm ~ .custom-file-label {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    height: calc(1.5em + 1rem + 2px);
    border-radius: 6px;
    border: 1px solid #d1d3e2;
}

/* Mejoras visuales para los modales */
.modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-footer {
    border-top: 1px solid #e3e6f0;
}

/* Responsividad mejorada */
@media (max-width: 768px) {
    .container-fluid {
        width: 95% !important;
        margin-top: 2% !important;
    }
    
    .card-header h1 {
        font-size: 1.8rem !important;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 8px;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
}

/* Scroll personalizado para la tabla */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('lotesTable').classList.add('loaded');
        }, 800);
        
        // Script para el modal de edición
        const formEdit = document.getElementById('formEditar');
        const inputCapacity = document.getElementById('edit-capacity');
        const errorDiv = document.getElementById('error-capacidad-lote');

        let capacidadOcupada = 0;

        // Validación en vivo
        inputCapacity.addEventListener('input', function() {
            const nuevaCapacidad = Number(inputCapacity.value);

            if (nuevaCapacidad < capacidadOcupada) {
                inputCapacity.classList.add('is-invalid');
                errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
            } else {
                inputCapacity.classList.remove('is-invalid');
                errorDiv.innerText = '';
            }
        });

        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const aquaponicSystemId = this.getAttribute('data-aquaponic_system_id');
                const date = this.getAttribute('data-date');
                const name = this.getAttribute('data-name');
                const capacity = this.getAttribute('data-capacity');
                const image = this.getAttribute('data-image');
                const description = this.getAttribute('data-description');
                const state = this.getAttribute('data-state');
                capacidadOcupada = Number(this.getAttribute('data-ocupado')) || 0;

                const estadoSelect = document.getElementById('edit-state');

                // Rellenar formulario
                formEdit.action = `/pasante/lote/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-aquaponic_system_id').value = aquaponicSystemId;
                document.getElementById('edit-name').value = name;
                inputCapacity.value = capacity;

                // Validación de capacidad ocupada
                if (Number(capacity) < capacidadOcupada) {
                    inputCapacity.classList.add('is-invalid');
                    errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
                } else {
                    inputCapacity.classList.remove('is-invalid');
                    errorDiv.innerText = '';
                }

                // Imagen
                const previewImage = document.getElementById('edit-preview-image');
                const noImagePlaceholder = document.getElementById('no-image-placeholder');
                
                if (image) {
                    previewImage.src = `/modules/acuaponico/images/lotes/${image}`;
                    previewImage.style.display = 'block';
                    noImagePlaceholder.style.display = 'none';
                } else {
                    previewImage.style.display = 'none';
                    noImagePlaceholder.style.display = 'block';
                }

                // Descripción
                document.getElementById('edit-description').value = description;

                // Estado
                estadoSelect.removeAttribute('disabled');
                if (state.toLowerCase() === "ocupado" || (state.toLowerCase() === "disponible" && capacidadOcupada > 0)) {
                    estadoSelect.innerHTML = `<option value="${state}" selected>${state.charAt(0).toUpperCase() + state.slice(1)}</option>`;
                    estadoSelect.setAttribute('disabled', 'disabled');
                } else {
                    estadoSelect.innerHTML = `<option value="disponible" ${state === 'disponible' ? 'selected' : ''}>Disponible</option>
                    <option value="no disponible" ${state === 'no disponible' ? 'selected' : ''}>No Disponible</option>`;
                }
            });
        });

        // Validación al enviar
        formEdit.addEventListener('submit', function(e) {
            const nuevaCapacidad = Number(inputCapacity.value);
            if (nuevaCapacidad < capacidadOcupada) {
                e.preventDefault();
                inputCapacity.classList.add('is-invalid');
                errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
            }
        });

        // Custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            animation: true
        });
        
        // Modal para visualización de imagen
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var imageUrl = button.data('image');
            var modal = $(this);
            modal.find('#modalImage').attr('src', imageUrl);
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
        
        // Preview de imagen seleccionada en el modal de edición
        $('#edit-image').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit-preview-image').attr('src', e.target.result).show();
                    $('#no-image-placeholder').hide();
                }
                reader.readAsDataURL(file);
                $('#edit-image-label').text(file.name);
            }
        });

        // DataTable initialization
        $('#lotesTable').DataTable({
            responsive: false,
            autoWidth: false,
            scrollX: true,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            },
            columnDefs: [
                { orderable: false, targets: [5, 10] } // Deshabilitar ordenamiento en columnas de imagen y acciones
            ],
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#lotesTable tbody tr').addClass('animate__animated animate__fadeInRight');
            }
        });

        // Establecer fecha actual
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });

    // Script para eliminar lotes
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
                title: '<i class="fas fa-exclamation-triangle me-2"></i>¿Eliminar Lote?',
                html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y el lote será eliminado permanentemente.</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'transparent',
                cancelButtonColor: 'transparent',
                confirmButtonText: '<i class="fas fa-trash text-white me-2"></i>Eliminar',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Cancelar',
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
                    // Crear formulario de eliminación dinámico
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/pasante/lote/destroy/${id}`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '<?php echo e(csrf_token()); ?>';
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
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
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registrolote.blade.php ENDPATH**/ ?>