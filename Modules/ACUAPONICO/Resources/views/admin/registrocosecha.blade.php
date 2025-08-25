@extends('acuaponico::layouts.master')
@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Cosechas</li>
@endpush

@section('content11')
<style>
    :root {
        --primary-color: #7cd0e5;
        --secondary-color: #64748b;
        --success-color: #059669;
        --warning-color: #d97706;
        --danger-color: #dc2626;
        --light-bg: #f8fafc;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #7cd0e5 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 2rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .table-container {
        background: white;
        border-radius: 1rem;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #7cd0e5 100%);
        color: white;
        padding: 1.5rem;
    }

    .search-container {
        background: var(--light-bg);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .custom-table {
        margin: 0;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border: none;
        font-weight: 600;
        color: var(--secondary-color);
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .custom-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc !important;
        transform: scale(1.01);
    }

    .custom-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border: none;
    }

    .btn-modern {
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
        color: white;
    }

    .btn-success-modern {
        background: linear-gradient(135deg, var(--success-color) 0%, #047857 100%);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
    }

    .action-btn {
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        color: white;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        width: auto;
        height: auto;
    }

    .action-btn.edit {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .action-btn.delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .action-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .modal-modern .modal-content {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-modern .modal-header {
        background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
        border-bottom: 1px solid #e2e8f0;
        border-radius: 1rem 1rem 0 0;
    }

    .form-control-modern, .form-select-modern {
        border: 2px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
        background: white;
    }

    .form-control-modern:focus, .form-select-modern:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .stats-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #dcfce7;
        color: #166534;
    }
</style>

<!-- Agregando sección hero moderna -->
<div class="hero-section">
    <div class="container hero-content">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-seedling me-3"></i>Gestión de Cosechas
            </h1>
            <p class="lead mb-0">Administra y monitorea todas las cosechas de tus sistemas acuapónicos</p>
        </div>
    </div>
</div>

<div class="container animate-fade-in">
    <!-- Aplicando nuevo diseño de contenedor de tabla -->
    <div class="table-container">
        <div class="table-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">
                    <i class="fas fa-list me-2"></i>Lista de Cosechas
                </h3>
                <button type="button" class="btn btn-light btn-modern" data-toggle="modal" data-target="#agregar">
                    <i class="bi bi-plus-circle me-2"></i>Nueva Cosecha
                </button>
            </div>
        </div>

        <div class="search-container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="text-secondary mb-0">
                        <i class="fas fa-chart-line me-2 text-primary"></i>
                        Gestiona todas las cosechas de tus sistemas
                    </h6>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-md-end">
                        <span class="stats-badge">
                            <i class="fas fa-database me-1"></i>
                            {{ count($cosechas) }} registros
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aplicando estilos modernos a la tabla -->
        <div class="table-responsive">
            <table id="cosecha" class="table custom-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Sistema Acuapónico</th>
                        <th>Cultivo/Resiembra</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Unidad medida</th>
                        <th>Destino</th>
                        <th>Mortandad</th>
                        <th>Novedades</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach ($cosechas as $ch)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $ch->aquaponicSystem->name ?? 'N/A' }}</td>
                        <td>
                            @if ($ch->harvestable instanceof \Modules\AGROCEFA\Entities\Crop)
                            {{ $ch->harvestable->species->name }} (Cultivo)
                            @elseif ($ch->harvestable instanceof \Modules\ACUAPONICO\Entities\Resowing)
                            {{ $ch->harvestable->crops->species->name ?? 'N/A' }} (Resiembra)
                            @else
                            N/A
                            @endif
                        </td>
                        <td>{{ $ch->date }}</td>
                        <td>{{ $ch->quantity }}</td>
                        <td>{{ $ch->unit }}</td>
                        <td>{{ $ch->destination }}</td>
                        <td>{{ $ch->mortality }}</td>
                        <td>{{ $ch->notes }}</td>
                        <td>
                            <!-- Aplicando nuevos estilos a los botones de acción -->
                            <div class="action-buttons">
                                <button type="button" class="action-btn edit editbtn"
                                    data-id="{{ $ch->id }}"
                                    data-aquaponic_system_id="{{ $ch->aquaponic_system_id }}"
                                    data-harvestable_id="{{ $ch->harvestable_id }}"
                                    data-harvestable_type="{{ $ch->harvestable_type }}"
                                    data-date="{{ $ch->date }}"
                                    data-quantity="{{ $ch->quantity }}"
                                    data-unit="{{ $ch->unit }}"
                                    data-destination="{{ $ch->destination }}"
                                    data-mortality="{{ $ch->mortality }}"
                                    data-notes="{{ $ch->notes }}"
                                    data-toggle="modal"
                                    data-target="#editar">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                                <button type="button" class="action-btn delete btnEliminar" data-id="{{ $ch->id }}">
                                    <i class="fas fa-trash me-1"></i>Eliminar
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

<!-- Aplicando estilos modernos a los modales -->
<!-- Modal Agregar -->
<div class="modal fade modal-modern" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('acuaponico.pasante.pasante.storeharvest') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-secondary" id="agregarLabel">
                        <i class="fas fa-plus-circle me-2 text-primary"></i>Nueva Cosecha
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-calendar me-1"></i>Fecha:
                        </label>
                        <input type="date" name="date" class="form-control form-control-modern" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                        </label>
                        <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-select-modern" required>
                            <option value="">Seleccione un sistema</option>
                            @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harvestable" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-seedling me-1"></i>Cultivo o Resiembre:
                        </label>
                        <select name="harvestable" id="harvestable" class="form-control form-select-modern" required>
                            <option value="">Primero seleccione un sistema</option>
                        </select>
                        <input type="hidden" name="harvestable_id" id="harvestable_id">
                        <input type="hidden" name="harvestable_type" id="harvestable_type">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-weight me-1"></i>Cantidad:
                        </label>
                        <input type="number" name="quantity" class="form-control form-control-modern" id="quantity" step="0.01" required>
                        <div class="invalid-feedback" id="error-peces" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-balance-scale me-1"></i>Unidad de medida:
                        </label>
                        <select name="unit" id="unit" class="form-control form-select-modern" required>
                            <option value="Gramos">Gramos</option>
                            <option value="Kilogramos">Kilogramos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-map-marker-alt me-1"></i>Destino:
                        </label>
                        <input type="text" name="destination" class="form-control form-control-modern" id="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="mortality" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-exclamation-triangle me-1"></i>Mortandad:
                        </label>
                        <input type="number" name="mortality" class="form-control form-control-modern" id="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-sticky-note me-1"></i>Novedad:
                        </label>
                        <textarea name="notes" class="form-control form-control-modern" id="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade modal-modern" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateharvest', 0) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-secondary" id="editarLabel">
                        <i class="fas fa-edit me-2 text-primary"></i>Editar Cosecha
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-date" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-calendar me-1"></i>Fecha:
                        </label>
                        <input type="date" class="form-control form-control-modern" id="edit-date" name="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                        </label>
                        <select name="aquaponic_system_id" id="edit-aquaponic_system_id" class="form-control form-select-modern" required>
                            <option value="">Seleccione un sistema</option>
                            @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-harvestable" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-seedling me-1"></i>Cultivo o Resiembre:
                        </label>
                        <select name="harvestable" id="edit-harvestable" class="form-control form-select-modern" required>
                            <option value="">Primero seleccione un sistema</option>
                        </select>
                        <input type="hidden" name="harvestable_id" id="edit-harvestable_id">
                        <input type="hidden" name="harvestable_type" id="edit-harvestable_type">
                    </div>
                    <div class="mb-3">
                        <label for="edit-quantity" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-weight me-1"></i>Cantidad:
                        </label>
                        <input type="number" class="form-control form-control-modern" id="edit-quantity" name="quantity" step="0.01" required>
                        <div class="invalid-feedback" id="edit-error-peces" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-unit" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-balance-scale me-1"></i>Unidad de medida:
                        </label>
                        <select name="unit" id="edit-unit" class="form-control form-select-modern" required>
                            <option value="Gramos">Gramos</option>
                            <option value="Kilogramos">Kilogramos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-destination" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-map-marker-alt me-1"></i>Destino:
                        </label>
                        <input type="text" class="form-control form-control-modern" id="edit-destination" name="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-mortality" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-exclamation-triangle me-1"></i>Mortandad:
                        </label>
                        <input type="number" class="form-control form-control-modern" id="edit-mortality" name="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-notes" class="form-label fw-semibold text-secondary">
                            <i class="fas fa-sticky-note me-1"></i>Novedad:
                        </label>
                        <textarea class="form-control form-control-modern" name="notes" id="edit-notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade modal-modern" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-secondary" id="eliminarLabel">
                        <i class="fas fa-trash me-2 text-danger"></i>Eliminar Cosecha
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        <p class="mt-3">¿Estás seguro de que deseas eliminar esta cosecha? Esta acción no se puede deshacer.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-modern">
                        <i class="fas fa-trash me-1"></i>Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fecha actual para el modal agregar
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Función para cargar cultivos/resiembras
        function loadHarvestables(systemSelectId, harvestableSelectId, harvestableIdInputId, harvestableTypeInputId, initialSystemId = null, initialHarvestableId = null, initialHarvestableType = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const harvestableIdInput = document.getElementById(harvestableIdInputId);
            const harvestableTypeInput = document.getElementById(harvestableTypeInputId);

            systemSelect.addEventListener('change', function() {
                const systemId = this.value;
                harvestableSelect.innerHTML = '<option value="">Cargando...</option>';
                if (systemId) {
                    fetch(`{{ route('acuaponico.pasante.pasante.harvests.harvestables-by-system', '') }}/${systemId}?harvestable_id=${initialHarvestableId || ''}&harvestable_type=${encodeURIComponent(initialHarvestableType || '')}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            harvestableSelect.innerHTML = '<option value="">Seleccione un cultivo o resiembra</option>';
                            data.forEach(item => {
                                harvestableSelect.innerHTML += `<option value="${item.type}|${item.id}" data-quantity="${item.quantity}">${item.name}</option>`;
                            });
                            if (initialHarvestableId && initialHarvestableType && systemId === initialSystemId) {
                                const initialValue = `${initialHarvestableType}|${initialHarvestableId}`;
                                harvestableSelect.value = initialValue;
                                harvestableSelect.dispatchEvent(new Event('change'));
                                initialHarvestableId = null;
                                initialHarvestableType = null;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching harvestables:', error);
                            harvestableSelect.innerHTML = '<option value="">Error al cargar los datos</option>';
                        });
                } else {
                    harvestableSelect.innerHTML = '<option value="">Primero seleccione un sistema</option>';
                }
            });

            harvestableSelect.addEventListener('change', function() {
                const value = this.value;
                const mortalityInput = document.getElementById(systemSelectId.replace('aquaponic_system_id', 'mortality') || 'mortality');
                const quantityInput = document.getElementById(systemSelectId.replace('aquaponic_system_id', 'quantity') || 'quantity');
                if (value) {
                    const [type, id] = value.split('|');
                    harvestableTypeInput.value = type;
                    harvestableIdInput.value = id;
                    const quantity = parseFloat(this.selectedOptions[0].getAttribute('data-quantity')) || 0;
                    const inputQuantity = parseFloat(quantityInput.value) || 0;
                    mortalityInput.value = quantity - inputQuantity >= 0 ? quantity - inputQuantity : '';
                } else {
                    harvestableTypeInput.value = '';
                    harvestableIdInput.value = '';
                    mortalityInput.value = '';
                }
            });

            if (initialSystemId) {
                systemSelect.value = initialSystemId;
                systemSelect.dispatchEvent(new Event('change'));
            }
        }

        // Inicializar para el modal de agregar
        loadHarvestables('aquaponic_system_id', 'harvestable', 'harvestable_id', 'harvestable_type');

        // Cargar datos para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/cosecha/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-quantity').value = this.getAttribute('data-quantity');
                document.getElementById('edit-unit').value = this.getAttribute('data-unit');
                document.getElementById('edit-destination').value = this.getAttribute('data-destination');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');

                loadHarvestables(
                    'edit-aquaponic_system_id',
                    'edit-harvestable',
                    'edit-harvestable_id',
                    'edit-harvestable_type',
                    this.getAttribute('data-aquaponic_system_id'),
                    this.getAttribute('data-harvestable_id'),
                    this.getAttribute('data-harvestable_type')
                );

                setTimeout(() => {
                    document.getElementById('edit-harvestable').dispatchEvent(new Event('change'));
                }, 500);
            });
        });

        // Validar cantidad y calcular mortalidad
        function validateQuantity(inputId, errorId, harvestableSelectId, mortalityId) {
            const input = document.getElementById(inputId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const errorDiv = document.getElementById(errorId);
            const mortality = document.getElementById(mortalityId);

            function calculate() {
                const quantity = parseFloat(harvestableSelect.options[harvestableSelect.selectedIndex]?.getAttribute('data-quantity') || 0);
                const cantidad = parseFloat(input.value) || 0;

                if (cantidad < 0 || isNaN(cantidad)) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = 'La cantidad debe ser un número válido mayor o igual a 0.';
                    mortality.value = '';
                } else if (cantidad > quantity) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = `No puedes ingresar más de ${quantity}.`;
                    mortality.value = '';
                } else {
                    input.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    mortality.value = quantity - cantidad >= 0 ? quantity - cantidad : '';
                }
            }

            harvestableSelect.addEventListener('change', calculate);
            input.addEventListener('input', calculate);
            calculate();
        }

        validateQuantity('quantity', 'error-peces', 'harvestable', 'mortality');
        validateQuantity('edit-quantity', 'edit-error-peces', 'edit-harvestable', 'edit-mortality');

        // Eliminar con SweetAlert
        document.querySelectorAll('.btnEliminar').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formEliminar = document.getElementById('formEliminar');
                        formEliminar.action = `/pasante/cosecha/destroy/${id}`;
                        formEliminar.submit();
                    }
                });
            });
        });
    });
</script>

<!-- Scripts para notificaciones -->
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
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
        });
    });
</script>
@endif
@section('scripts')
<script>
    $(document).ready(function() {
        $('#cosecha').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            }
        });
    });
</script>
@endsection
@endsection
