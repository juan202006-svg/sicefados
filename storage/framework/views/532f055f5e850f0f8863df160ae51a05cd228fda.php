

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Especies</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content6'); ?>
<div class="container-fluid px-4" style="width: 80%; margin-top: 5%;">
    <!-- Header mejorado con gradiente y sombra -->
    <div class="container mt-5">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-leaf me-3"></i>Gestión de Especies
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con diseño moderno -->
    <div class="card shadow-lg border-0 mt-5 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 text-primary fw-semibold">
                <i class="fas fa-list me-2"></i>Lista de Especies
            </h5>
            <div class="spinner-border text-primary" role="status" id="tableSpinner" style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <small class="text-muted">Total de especies: <?php echo e(count($especies)); ?></small>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#agregar"
                    style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%); border: none; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Nueva Especie
                </button>
            </div>
            
            <div class="table-responsive rounded-3 shadow-sm">
                <table id="especiesTable" class="table table-hover align-middle mb-0" style="border: 1px solid #e3e6f0;">
                    <thead class="thead-dark" style="background: linear-gradient(to right, #71ccef, #71ccef); color: white;">
                        <tr>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">#</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Categoría</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Nombre Científico</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Nombre Común</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Imagen</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Descripción</th>
                            <th class="text-center py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: <?php echo e($n * 0.03); ?>s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($n++); ?></td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($especie->category->name ?? 'Sin categoría'); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($especie->scientific_name); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($especie->name); ?></td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($especie->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/especies/' . $especie->image)); ?>" 
                                     alt="Imagen de la especie" 
                                     class="img-thumbnail rounded-circle img-hover-zoom" 
                                     style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #e3e6f0;"
                                     data-toggle="modal" data-target="#imageModal" data-image="<?php echo e(asset('modules/acuaponico/images/especies/' . $especie->image)); ?>">
                                <?php else: ?>
                                <span class="badge bg-light p-2 rounded-circle">
                                    <i class="fas fa-image text-muted"></i>
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($especie->description): ?>
                                <span class="text-muted" data-toggle="tooltip" title="<?php echo e($especie->description); ?>"><?php echo e(Str::limit($especie->description, 40)); ?></span>
                                <?php else: ?>
                                <span class="text-muted font-italic">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="<?php echo e($especie->id); ?>"
                                        data-category_id="<?php echo e($especie->category_id); ?>"
                                        data-scientific_name="<?php echo e($especie->scientific_name); ?>"
                                        data-name="<?php echo e($especie->name); ?>"
                                        data-image="<?php echo e($especie->image); ?>"
                                        data-description="<?php echo e($especie->description); ?>"
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="<?php echo e($especie->id); ?>">
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

<!-- Modal para visualización de imagen -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title"><i class="fas fa-image me-2"></i>Imagen de la Especie</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="modalImage" src="" alt="Imagen ampliada" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="editarLabel">
                    <i class="fas fa-edit me-2"></i>
                    Editar Especie
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updatespecies', 0)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="form-group mb-3">
                        <label for="edit-category_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-tag me-1"></i>Categoría:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-category_id" name="category_id" required>
                            <option value="">Seleccione una categoría</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-scientific_name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-microscope me-1"></i>Nombre Científico:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="edit-scientific_name" name="scientific_name" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-leaf me-1"></i>Nombre Común:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="edit-name" name="name" required>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="text-center border rounded p-2 h-100 d-flex flex-column justify-content-center">
                                <label class="form-label small fw-bold text-primary mb-1 d-block">
                                    <i class="fas fa-image me-1"></i>Imagen actual:
                                </label>
                                <div class="mt-1 image-preview-container">
                                    <img id="edit-preview-image" src="" alt="Imagen de la especie" 
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
                    
                    <div class="form-group mb-3">
                        <label for="edit-description" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción (Opcional):
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="edit-description" name="description" rows="2" style="resize: none;"></textarea>
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

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">        
    <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-danger text-white py-3">
            <h5 class="modal-title" id="eliminarLabel">
                <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
            </h5>
            <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <p class="mb-0">¿Estás seguro de que deseas eliminar esta especie? Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer bg-light py-3">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times me-2"></i>Cancelar
            </button>
            <button type="button" class="btn btn-danger" id="confirmarEliminacion">
                <i class="fas fa-trash me-2"></i>Eliminar
            </button>
        </div>
        <form id="formEliminar" method="POST" action="">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
        </form>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nueva Especie
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storespecies')); ?>" method="POST" enctype="multipart/form-data" id="formAgregar">
                <?php echo csrf_field(); ?>
                
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="add-category_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-tag me-1"></i>Categoría:
                        </label>
                        <select class="form-control form-control-sm rounded" id="add-category_id" name="category_id" required>
                            <option value="">Seleccione una categoría</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="add-scientific_name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-microscope me-1"></i>Nombre Científico:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="add-scientific_name" name="scientific_name" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="add-name" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-leaf me-1"></i>Nombre Común:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="add-name" name="name" required>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="text-center border rounded p-2 h-100 d-flex flex-column justify-content-center">
                                <label class="form-label small fw-bold text-primary mb-1 d-block">
                                    <i class="fas fa-image me-1"></i>Vista previa:
                                </label>
                                <div class="mt-1 image-preview-container">
                                    <img id="add-preview-image" src="" alt="Vista previa de imagen" 
                                         class="img-fluid rounded modal-image-preview" style="max-height: 80px; display: none;">
                                    <div class="no-image-placeholder" id="add-no-image-placeholder">
                                        <i class="fas fa-image text-muted" style="font-size: 1.5rem;"></i>
                                        <p class="text-muted mt-1 small">Sin imagen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group h-100 d-flex flex-column justify-content-center">
                                <label for="add-image" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-camera me-1"></i>Seleccionar imagen:
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom-file-input-sm" id="add-image" name="image" accept="image/*">
                                    <label class="custom-file-label small rounded" for="add-image" id="add-image-label">
                                        <i class="fas fa-upload me-1"></i>Seleccionar
                                    </label>
                                </div>
                                <small class="form-text text-muted mt-1 small">
                                    Formatos: JPG, PNG, GIF. Máx: 2MB
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="add-description" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción (Opcional):
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="add-description" name="description" rows="2" style="resize: none;"></textarea>
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
#especiesTable {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#especiesTable.loaded {
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
#especiesTable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

#especiesTable th,
#especiesTable td {
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
}

#especiesTable th:last-child,
#especiesTable td:last-child {
    border-right: none;
}

#especiesTable tr:last-child td {
    border-bottom: none;
}

#especiesTable thead th {
    background: linear-gradient(to right, #71ccef, #71ccef);
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
    background-color: #858796;
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
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('especiesTable').classList.add('loaded');
        }, 800);
        
        // Script para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/especie/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-category_id').value = this.getAttribute('data-category_id');
                document.getElementById('edit-scientific_name').value = this.getAttribute('data-scientific_name');
                document.getElementById('edit-name').value = this.getAttribute('data-name');

                const image = this.getAttribute('data-image');
                const previewImage = document.getElementById('edit-preview-image');
                const noImagePlaceholder = document.getElementById('no-image-placeholder');
                
                if (image) {
                    previewImage.src = `/modules/acuaponico/images/especies/${image}`;
                    previewImage.style.display = 'block';
                    noImagePlaceholder.style.display = 'none';
                } else {
                    previewImage.style.display = 'none';
                    noImagePlaceholder.style.display = 'block';
                }

                document.getElementById('edit-description').value = this.getAttribute('data-description');
            });
        });

        // Preview de imagen seleccionada en el modal de agregar
        $('#add-image').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#add-preview-image').attr('src', e.target.result).show();
                    $('#add-no-image-placeholder').hide();
                }
                reader.readAsDataURL(file);
                $('#add-image-label').text(file.name);
            } else {
                $('#add-preview-image').hide();
                $('#add-no-image-placeholder').show();
                $('#add-image-label').html('<i class="fas fa-upload me-1"></i>Seleccionar');
            }
        });

        // Reemplazar el código existente del evento click de btnEliminar con este nuevo estilo
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
                    title: '<i class="fas fa-exclamation-triangle me-2"></i>¿Eliminar Especie?',
                    html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y la especie será eliminada permanentemente.</div>',
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
                        const formEliminar = document.createElement('form');
                        formEliminar.method = 'POST';
                        formEliminar.action = `/pasante/especie/destroy/${id}`;
                        
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '<?php echo e(csrf_token()); ?>';
                        
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        
                        formEliminar.appendChild(csrfToken);
                        formEliminar.appendChild(methodField);
                        
                        document.body.appendChild(formEliminar);
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

        // DataTable initialization
        $('#especiesTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            },
            columnDefs: [
                { orderable: false, targets: [4, 6] } // Deshabilitar ordenamiento en columnas de imagen y acciones
            ],
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#especiesTable tbody tr').addClass('animate__animated animate__fadeInRight');
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
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registroespecie.blade.php ENDPATH**/ ?>