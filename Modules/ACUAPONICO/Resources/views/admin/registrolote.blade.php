@extends('acuaponico::layouts.master')

@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Lotes</li>
@endpush

@section('content')
<div class="container-fluid px-4" style="width: 80%; margin-top: 5%;">
    <div class="container mt-5">
        <div class="card shadow">
            <!-- Header con animación dentro de la tarjeta -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h3 mb-0 text-gray-800 fw-bold" style="font-size: 300%; margin-left: 8%; margin-top: 3%;">
                        Gestión de Lotes
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con animación -->
    <div class="card shadow border-0 animate__animated animate__fadeInUp" style="margin-top: 10%;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary fw-semibold" style="margin-left: 3%;">
                <i class="fas fa-list mr-2"></i>Lista de Lotes
            </h5>
            <div class="spinner-grow text-primary spinner-grow-sm" role="status" id="tableSpinner">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-0" style="margin-top: 2%; width: 90%; margin-left: 5%; margin-bottom: 5%;">
            <button type="button" class="btn btn-success shadow-sm rounded-pill px-4 py-2 btn-hover-scale" data-toggle="modal" data-target="#createLot"
            style="margin-left: 78%;">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Lote
            </button>
            <div class="table-responsive" style="margin-top: 3%; max-height: 500px; overflow-y: auto;">
                <table id="lotesTable" class="table table-hover align-middle mb-0" style="border: 1px solid #dee2e6;">
                    <thead class="thead-light sticky-top" style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <tr>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">#</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">S/Acuapónico</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Fecha</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Nombre</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Capacidad</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Imagen</th>
                            <th style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Descripción</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Ocupado</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Disponible</th>
                            <th class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">Estado</th>
                            <th class="text-center" style="padding: 12px 8px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($lots as $lot)
                        <tr class="animate__animated animate__fadeInRight" style="animation-delay: {{ $n * 0.05 }}s; border-bottom: 1px solid #dee2e6;">
                            <td class="text-center fw-bold" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">{{ $n++ }}</td>
                            <td class="fw-medium" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">{{ $lot->aquaponicSystem->name ?? 'sin lote' }}</td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;">{{ $lot->date }}</td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;">{{ $lot->name }}</td>
                            <td class="text-center fw-bold" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                <span class="badge bg-info rounded-pill px-3 py-2">{{ $lot->capacity }}</span>
                            </td>
                            <td class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                @if ($lot->image)
                                <img src="{{ asset('modules/acuaponico/images/lotes/' . $lot->image) }}" 
                                     alt="Imagen del lote" 
                                     class="img-thumbnail rounded img-hover-zoom" 
                                     style="width: 70px; height: 70px; object-fit: cover;"
                                     data-toggle="modal" data-target="#imageModal" data-image="{{ asset('modules/acuaponico/images/lotes/' . $lot->image) }}">
                                @else
                                <span class="badge badge-light p-2">
                                    <i class="fas fa-image text-muted"></i>
                                </span>
                                @endif
                            </td>
                            <td style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                @if ($lot->description)
                                <span class="text-muted" data-toggle="tooltip" title="{{ $lot->description }}">{{ Str::limit($lot->description, 40) }}</span>
                                @else
                                <span class="text-muted font-italic">Sin descripción</span>
                                @endif
                            </td>
                            <td class="text-center fw-bold" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                <span class="badge bg-warning rounded-pill px-3 py-2">{{ $lot->ocupado }}</span>
                            </td>
                            <td class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                @if($lot->disponible > 0)
                                <span class="badge badge-success rounded-pill px-3 py-2 pulse-active">{{ $lot->disponible }}</span>
                                @else
                                <span class="badge badge-danger rounded-pill px-3 py-2">0</span>
                                @endif
                            </td>
                            <td class="text-center" style="border-right: 1px solid #dee2e6; padding: 12px 8px;">
                                @if($lot->state === 'disponible')
                                <span class="badge badge-success rounded-pill px-3 py-2 pulse-active">Disponible</span>
                                @else
                                <span class="badge badge-danger rounded-pill px-3 py-2">No Disponible</span>
                                @endif
                            </td>
                            <td class="text-center" style="padding: 12px 8px;">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar Mejorado - SOLO ICONO AMARILLO -->
                                    <button type="button" class="btn btn-action btn-edit editbtn"
                                        data-id="{{ $lot->id }}"
                                        data-aquaponic_system_id="{{ $lot->aquaponic_system_id }}"
                                        data-date="{{ $lot->date }}"
                                        data-name="{{ $lot->name }}"
                                        data-capacity="{{ $lot->capacity }}"
                                        data-image="{{ $lot->image }}"
                                        data-description="{{ $lot->description }}"
                                        data-state="{{ $lot->state }}"
                                        data-ocupado="{{ $lot->ocupado }}"
                                        data-toggle="modal"
                                        data-target="#updateLot">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar Mejorado -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar" data-id="{{ $lot->id }}">
                                        <div class="btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <span class="btn-tooltip">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para visualización de imagen -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Imagen del Lote</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Imagen ampliada" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación - Versión Compacta -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0" id="createLotLabel">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nuevo Lote
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('acuaponico.pasante.pasante.storeLot') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="date" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-calendar-alt mr-1"></i>Fecha:
                        </label>
                        <input type="date" name="date" class="form-control form-control-sm rounded" id="date" readonly>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="aquaponic_system_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tint mr-1"></i>Sistema Acuapónico:
                        </label>
                        <select name="aquaponic_system_id" class="form-control form-control-sm rounded" required>
                            <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                            @foreach ($acuaponico as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tag mr-1"></i>Nombre:
                        </label>
                        <input type="text" name="name" class="form-control form-control-sm rounded" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="capacity" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-boxes mr-1"></i>Capacidad:
                        </label>
                        <input type="number" name="capacity" class="form-control form-control-sm rounded" required>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="text-center border rounded p-2 h-100 d-flex flex-column justify-content-center">
                                <label class="form-label small font-weight-bold text-primary mb-1 d-block">
                                    <i class="fas fa-image mr-1"></i>Vista previa:
                                </label>
                                <div class="mt-1 image-preview-container">
                                    <img id="create-preview-image" src="" alt="Vista previa de imagen" 
                                         class="img-fluid rounded modal-image-preview" style="max-height: 80px; display: none;">
                                    <div class="no-image-placeholder" id="create-no-image-placeholder">
                                        <i class="fas fa-image text-muted" style="font-size: 1.5rem;"></i>
                                        <p class="text-muted mt-1 small">Sin imagen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group h-100 d-flex flex-column justify-content-center">
                                <label for="create-image" class="form-label small font-weight-bold text-primary mb-1">
                                    <i class="fas fa-camera mr-1"></i>Seleccionar imagen:
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom-file-input-sm" id="create-image" name="image" accept="image/*">
                                    <label class="custom-file-label small rounded" for="create-image" id="create-image-label">
                                        <i class="fas fa-upload mr-1"></i>Seleccionar
                                    </label>
                                </div>
                                <small class="form-text text-muted mt-1 small">
                                    Formatos: JPG, PNG, GIF. Máx: 2MB
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="description" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-align-left mr-1"></i>Descripción:
                        </label>
                        <textarea name="description" class="form-control form-control-sm rounded" rows="2" style="resize: none;"></textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="state" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-power-off mr-1"></i>Estado:
                        </label>
                        <select name="state" class="form-control form-control-sm rounded" required>
                            <option value="disponible">Disponible</option>
                        </select>
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

<!-- Modal de edición - Versión Compacta -->
<div class="modal fade" id="updateLot" tabindex="-1" aria-labelledby="updateLotLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title font-weight-bold mb-0" id="updateLotLabel">
                    <i class="fas fa-edit mr-2"></i>
                    Editar Lote
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateLot', 0) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="form-group mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tint mr-1"></i>Sistema Acuapónico:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                            @foreach ($acuaponico as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-name" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-tag mr-1"></i>Nombre:
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="edit-name" name="name">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-capacity" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-boxes mr-1"></i>Capacidad:
                        </label>
                        <input type="number" class="form-control form-control-sm rounded" id="edit-capacity" name="capacity">
                        <div class="invalid-feedback" id="error-capacidad-lote"></div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="text-center border rounded p-2 h-100 d-flex flex-column justify-content-center">
                                <label class="form-label small font-weight-bold text-primary mb-1 d-block">
                                    <i class="fas fa-image mr-1"></i>Imagen actual:
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
                                <label for="edit-image" class="form-label small font-weight-bold text-primary mb-1">
                                    <i class="fas fa-camera mr-1"></i>Cambiar imagen:
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom-file-input-sm" id="edit-image" name="image" accept="image/*">
                                    <label class="custom-file-label small rounded" for="edit-image" id="edit-image-label">
                                        <i class="fas fa-upload mr-1"></i>Seleccionar
                                    </label>
                                </div>
                                <small class="form-text text-muted mt-1 small">
                                    Formatos: JPG, PNG, GIF. Máx: 2MB
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-description" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-align-left mr-1"></i>Descripción:
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="edit-description" name="description" rows="2" style="resize: none;"></textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-state" class="form-label small font-weight-bold text-primary mb-1">
                            <i class="fas fa-power-off mr-1"></i>Estado:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-state" name="state" required>
                            <option value="disponible">Disponible</option>
                            <option value="no disponible">No Disponible</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-1" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-1 shadow">
                        <i class="fas fa-save mr-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer Sencillo -->
<footer class="footer mt-5 py-3 bg-light border-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="text-muted small">
                    &copy; {{ date('Y') }} Sistema Acuapónico. Todos los derechos reservados.
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

/* Estilos para tabla con scroll */
.table-responsive {
    max-height: 500px;
    overflow-y: auto;
}

.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}
</style>

<!-- Estilos adicionales para animaciones y botones mejorados -->
<style>
    /* Animaciones personalizadas */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    @keyframes iconPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    @keyframes borderFlow {
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
        border-right: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }
    
    #lotesTable th:last-child,
    #lotesTable td:last-child {
        border-right: none;
    }
    
    #lotesTable tr:last-child td {
        border-bottom: none;
    }
    
    #lotesTable thead th {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }
    
    /* ESTILOS ESPECÍFICOS PARA EL MODAL DE EDICIÓN MEJORADO */
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
    
    .modal-image-preview {
        max-height: 80px;
        object-fit: cover;
        transition: all 0.3s ease;
        border: 2px solid #e3e6f0;
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
    @keyframes modalEntry {
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
    
    .custom-file-input-sm {
        height: calc(1.5em + 0.5rem + 2px);
    }
    
    .custom-file-input-sm ~ .custom-file-label {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        height: calc(1.5em + 0.5rem + 2px);
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

                document.getElementById('edit-description').value = description;

                // Validación de capacidad ocupada
                if (Number(capacity) < capacidadOcupada) {
                    inputCapacity.classList.add('is-invalid');
                    errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
                } else {
                    inputCapacity.classList.remove('is-invalid');
                    errorDiv.innerText = '';
                }

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
        
        // Preview de imagen seleccionada en el modal de creación
        $('#create-image').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#create-preview-image').attr('src', e.target.result).show();
                    $('#create-no-image-placeholder').hide();
                }
                reader.readAsDataURL(file);
                $('#create-image-label').text(file.name);
            } else {
                $('#create-preview-image').hide();
                $('#create-no-image-placeholder').show();
                $('#create-image-label').html('<i class="fas fa-upload mr-1"></i>Seleccionar');
            }
        });
        
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
        
        // Establecer fecha actual en el campo de fecha
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });

    // DataTable initialization
    $(document).ready(function() {
        $('#lotesTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            },
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#lotesTable tbody tr').addClass('animate__animated animate__fadeInRight');
            }
        });
    });
</script>

<!-- Script para SweetAlert de eliminación -->
<script>
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
                    
                    @keyframes pulse-icon {
                        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0.4); }
                        70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(231, 74, 59, 0); }
                        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0); }
                    }
                    
                    /* Animación de entrada personalizada */
                    @keyframes custom-modal-in {
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
                title: '<i class="fas fa-exclamation-triangle mr-2"></i>¿Eliminar Lote?',
                html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y el lote será eliminado permanentemente.</div>',
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
                    const formEliminar = document.createElement('form');
                    formEliminar.method = 'POST';
                    formEliminar.action = `/pasante/lote/destroy/${id}`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    formEliminar.appendChild(csrfToken);
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    formEliminar.appendChild(methodInput);
                    
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
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session("error") }}',
            confirmButtonColor: '#d33',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    });
</script>
@endif

@endsection