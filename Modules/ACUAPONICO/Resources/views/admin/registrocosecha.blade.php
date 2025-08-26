@extends('acuaponico::layouts.master')
@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Cosechas</li>
@endpush

@section('content11')
<style>
    body {
        background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
        min-height: 100vh;
    }
    
    .main-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 30px;
    }
    
    .page-header {
        background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
        color: white;
        padding: 40px 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .page-header h2 {
        font-size: 3.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
    }
    
    .form-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(79, 70, 229, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-color);
        transition: height 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        border-color: var(--card-color);
    }
    
    .stats-card:hover::before {
        height: 100%;
        opacity: 0.1;
    }
    
    .stats-card.total { --card-color: #06b6d4; }
    .stats-card.harvests { --card-color: #10b981; }
    .stats-card.systems { --card-color: #f59e0b; }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--card-color);
        margin-bottom: 10px;
        display: block;
    }
    
    .stats-label {
        font-size: 1rem;
        font-weight: 600;
        color: #374151;
        margin: 0;
    }
    
    .stats-icon {
        font-size: 2rem;
        color: var(--card-color);
        opacity: 0.8;
    }
    
    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #71ccef;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        background: white;
        transform: translateY(-2px);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgb(64, 188, 216);
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(64, 188, 216);
    }
    
    .table-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .search-container {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid #e2e8f0;
    }
    
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .table thead th {
        background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
        color: white;
        font-weight: 600;
        padding: 15px;
        border: none;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:nth-child(even) {
        background-color: #f8fafc;
    }
    
    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    
    .table tbody tr:hover {
        background-color: #e0e7ff !important;
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: #e2e8f0;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        margin: 0 3px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .action-btn.edit {
        background: #f0f9ff;
        color: #0369a1;
    }
    
    .action-btn.edit:hover {
        background: #0369a1;
        color: white;
        transform: translateY(-2px);
    }
    
    .action-btn.delete {
        background: #fef2f2;
        color: #dc2626;
    }
    
    .action-btn.delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }
    
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px 30px;
    }
    
    .modal-body {
        padding: 30px;
    }
    
    .section-divider {
        height: 4px;
        background: linear-gradient(90deg, #71ccef, #71ccef, #06b6d4);
        border-radius: 2px;
        margin: 40px 0;
        opacity: 0.3;
    }
    
    .footer-modern {
        background: linear-gradient(135deg, #71ccef 0%, #374151 100%);
        color: white;
        border-radius: 15px;
        margin-top: 50px;
        padding: 40px 30px;
        box-shadow: 0 -10px 30px rgba(46, 148, 185);
    }
    
    .footer-modern a {
        color: #d1d5db;
        transition: color 0.3s ease;
    }
    
    .footer-modern a:hover {
        color: #71ccef;
    }
    
    .pagination {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgb(46, 148, 185);
    }
    
    .page-link {
        border: none;
        padding: 12px 16px;
        color: #71ccef;
        background: white;
        transition: all 0.3s ease;
    }
    
    .page-link:hover {
        background: #71ccef;
        color: white;
        transform: translateY(-2px);
    }
    
    .page-item.active .page-link {
        background: #71ccef;
        border-color: #71ccef;
    }

    /* Estilos para el backdrop del modal */
    .modal-backdrop {
        z-index: 1040 !important;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .modal {
        z-index: 1050 !important;
    }
    
    .badge-custom {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
</style>

<div class="main-container">
    <!-- Modern header with gradient background -->
    <div class="page-header">
        <h2>Gestión de Cosechas</h2>
        <p class="mb-0 mt-3" style="font-size: 1.2rem; opacity: 0.9;">Sistema integral de administración de cosechas</p>
    </div>

    <div class="row">
        <!-- Enhanced form section with better styling -->
        <div class="col-lg-8">
            <div class="form-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                        <i class="fas fa-seedling text-white fa-lg"></i>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Registrar Nueva Cosecha</h4>
                </div>

                <form action="{{ route('acuaponico.pasante.pasante.storeharvest') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold text-dark">
                                <i class="fas fa-calendar me-2 text-primary"></i>Fecha
                            </label>
                            <input type="date" name="date" class="form-control form-control-lg" id="date" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="aquaponic_system_id" class="form-label fw-semibold text-dark">
                                <i class="fas fa-water me-2 text-primary"></i>Sistema Acuapónico
                            </label>
                            <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-select form-select-lg" required>
                                <option value="">Seleccione un sistema</option>
                                @foreach ($systems as $system)
                                <option value="{{ $system->id }}">{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="harvestable" class="form-label fw-semibold text-dark">
                                <i class="fas fa-seedling me-2 text-primary"></i>Cultivo o Resiembre
                            </label>
                            <select name="harvestable" id="harvestable" class="form-select form-select-lg" required>
                                <option value="">Primero seleccione un sistema</option>
                            </select>
                            <input type="hidden" name="harvestable_id" id="harvestable_id">
                            <input type="hidden" name="harvestable_type" id="harvestable_type">
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="form-label fw-semibold text-dark">
                                <i class="fas fa-weight me-2 text-primary"></i>Cantidad
                            </label>
                            <input type="number" name="quantity" class="form-control form-control-lg" id="quantity" step="0.01" required>
                            <div class="invalid-feedback" id="error-peces" style="display:none;"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="unit" class="form-label fw-semibold text-dark">
                                <i class="fas fa-balance-scale me-2 text-primary"></i>Unidad de medida
                            </label>
                            <select name="unit" id="unit" class="form-select form-select-lg" required>
                                <option value="Gramos">Gramos</option>
                                <option value="Kilogramos">Kilogramos</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="destination" class="form-label fw-semibold text-dark">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Destino
                            </label>
                            <input type="text" name="destination" class="form-control form-control-lg" id="destination" required>
                        </div>

                        <div class="col-md-6">
                            <label for="mortality" class="form-label fw-semibold text-dark">
                                <i class="fas fa-exclamation-triangle me-2 text-primary"></i>Mortandad
                            </label>
                            <input type="number" name="mortality" class="form-control form-control-lg" id="mortality" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="notes" class="form-label fw-semibold text-dark">
                                <i class="fas fa-sticky-note me-2 text-primary"></i>Novedad
                            </label>
                            <textarea name="notes" class="form-control form-control-lg" id="notes" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            <i class="fas fa-plus me-2"></i>Registrar Cosecha
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modern stats cards with hover effects -->
        <div class="col-lg-4">
            <div class="stats-card total" onclick="scrollToTable()">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ count($cosechas) }}</span>
                        <h6 class="stats-label">Cosechas Registradas</h6>
                    </div>
                    <i class="fas fa-database stats-icon"></i>
                </div>
            </div>

            <div class="stats-card harvests" onclick="scrollToTable()">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $systems->count() }}</span>
                        <h6 class="stats-label">Sistemas Activos</h6>
                    </div>
                    <i class="fas fa-water stats-icon"></i>
                </div>
            </div>

            <div class="stats-card systems" onclick="scrollToTable()">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $cosechas->sum('quantity') }}</span>
                        <h6 class="stats-label">Total Producido</h6>
                    </div>
                    <i class="fas fa-seedling stats-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="section-divider"></div>

    <!-- Enhanced table section with modern design -->
    <div class="table-section">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                <i class="fas fa-list text-white fa-lg"></i>
            </div>
            <h3 class="mb-0 fw-bold text-dark">Lista de Cosechas</h3>
        </div>

        <div class="search-container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="mb-0 text-muted">
                        <i class="fas fa-search me-2"></i>Buscar en la tabla
                    </h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" id="busqueda" class="form-control border-start-0" placeholder="Buscar por sistema, cultivo o destino..." onkeyup="filtrarTabla()">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="tabla-cosechas">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>N°</th>
                        <th><i class="fas fa-water me-2"></i>Sistema Acuapónico</th>
                        <th><i class="fas fa-seedling me-2"></i>Cultivo/Resiembra</th>
                        <th><i class="fas fa-calendar me-2"></i>Fecha</th>
                        <th><i class="fas fa-weight me-2"></i>Cantidad</th>
                        <th><i class="fas fa-balance-scale me-2"></i>Unidad</th>
                        <th><i class="fas fa-map-marker-alt me-2"></i>Destino</th>
                        <th><i class="fas fa-exclamation-triangle me-2"></i>Mortandad</th>
                        <th><i class="fas fa-sticky-note me-2"></i>Novedades</th>
                        <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach ($cosechas as $ch)
                    <tr>
                        <td><span class="badge bg-light text-dark">{{ $n++ }}</span></td>
                        <td class="fw-semibold">{{ $ch->aquaponicSystem->name ?? 'N/A' }}</td>
                        <td>
                            @if ($ch->harvestable instanceof \Modules\AGROCEFA\Entities\Crop)
                            <span class="badge bg-info badge-custom">{{ $ch->harvestable->species->name }} (Cultivo)</span>
                            @elseif ($ch->harvestable instanceof \Modules\ACUAPONICO\Entities\Resowing)
                            <span class="badge bg-warning badge-custom">{{ $ch->harvestable->crops->species->name ?? 'N/A' }} (Resiembra)</span>
                            @else
                            <span class="badge bg-secondary badge-custom">N/A</span>
                            @endif
                        </td>
                        <td>{{ $ch->date }}</td>
                        <td class="fw-bold">{{ $ch->quantity }}</td>
                        <td>{{ $ch->unit }}</td>
                        <td>{{ $ch->destination }}</td>
                        <td>{{ $ch->mortality }}</td>
                        <td>{{ $ch->notes }}</td>
                        <td>
                            <a href="#" class="action-btn edit" data-toggle="modal" data-target="#editar"
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
                                title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('acuaponico.pasante.pasante.destroyharvest', $ch->id) }}" 
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn delete btnEliminar" title="Eliminar" data-id="{{ $ch->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modern footer design -->
    <footer class="footer-modern">
        <div class="row gy-4 text-center text-md-start">
            <div class="col-md-4">
                <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fas fa-leaf me-2"></i>Sistema ACUAPONICO
                </h6>
                <p class="mb-1">Administra cosechas, sistemas acuapónicos y producción de manera eficiente.</p>
                <p class="mb-0 text-muted">Construido con Laravel & Bootstrap 5.</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fas fa-code me-2"></i>Desarrollado por
                </h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-user me-2"></i>Juan Sebastian Guzman Hernandez
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:guzmanhernandezj603@gmail.com" class="text-decoration-none">
                            guzmanhernandezj603@gmail.com
                        </a>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:‪+573005954563‬" class="text-decoration-none">
                            ‪+57 300 595 4563‬
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fas fa-link me-2"></i>Enlaces
                </h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-shield-alt me-2"></i>
                        <a href="#" class="text-decoration-none">Política de privacidad</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-file-contract me-2"></i>
                        <a href="#" class="text-decoration-none">Términos de uso</a>
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-headset me-2"></i>
                        <a href="#" class="text-decoration-none">Soporte técnico</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 opacity-25">

        <div class="text-center">
            <p class="mb-0">
                <i class="fas fa-copyright me-2"></i>
                {{ date('Y') }} ACUAPONICO. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateharvest', 0) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="editarLabel">
                        <i class="fas fa-edit me-2"></i>Editar Cosecha
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit-date" class="form-label fw-semibold">
                                <i class="fas fa-calendar me-2 text-primary"></i>Fecha
                            </label>
                            <input type="date" class="form-control form-control-lg" id="edit-date" name="date" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-aquaponic_system_id" class="form-label fw-semibold">
                                <i class="fas fa-water me-2 text-primary"></i>Sistema Acuapónico
                            </label>
                            <select name="aquaponic_system_id" id="edit-aquaponic_system_id" class="form-control form-select-lg" required>
                                <option value="">Seleccione un sistema</option>
                                @foreach ($systems as $system)
                                <option value="{{ $system->id }}">{{ $system->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-harvestable" class="form-label fw-semibold">
                                <i class="fas fa-seedling me-2 text-primary"></i>Cultivo o Resiembre
                            </label>
                            <select name="harvestable" id="edit-harvestable" class="form-control form-select-lg" required>
                                <option value="">Primero seleccione un sistema</option>
                            </select>
                            <input type="hidden" name="harvestable_id" id="edit-harvestable_id">
                            <input type="hidden" name="harvestable_type" id="edit-harvestable_type">
                        </div>
                        <div class="col-md-6">
                            <label for="edit-quantity" class="form-label fw-semibold">
                                <i class="fas fa-weight me-2 text-primary"></i>Cantidad
                            </label>
                            <input type="number" class="form-control form-control-lg" id="edit-quantity" name="quantity" step="0.01" required>
                            <div class="invalid-feedback" id="edit-error-peces" style="display:none;"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-unit" class="form-label fw-semibold">
                                <i class="fas fa-balance-scale me-2 text-primary"></i>Unidad de medida
                            </label>
                            <select name="unit" id="edit-unit" class="form-control form-select-lg" required>
                                <option value="Gramos">Gramos</option>
                                <option value="Kilogramos">Kilogramos</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-destination" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Destino
                            </label>
                            <input type="text" class="form-control form-control-lg" id="edit-destination" name="destination" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-mortality" class="form-label fw-semibold">
                                <i class="fas fa-exclamation-triangle me-2 text-primary"></i>Mortandad
                            </label>
                            <input type="number" class="form-control form-control-lg" id="edit-mortality" name="mortality" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-notes" class="form-label fw-semibold">
                                <i class="fas fa-sticky-note me-2 text-primary"></i>Novedad
                            </label>
                            <textarea class="form-control form-control-lg" name="notes" id="edit-notes" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Inicializar los modales correctamente
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar todos los modales
        $('.modal').modal({
            backdrop: true,
            keyboard: true,
            show: false
        });

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
        document.querySelectorAll('.edit').forEach(button => {
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
                        const form = this.closest('form');
                        form.submit();
                    }
                });
            });
        });
    });

    function filtrarTabla() {
        const input = document.getElementById("busqueda");
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll("#tabla-cosechas tbody tr");

        rows.forEach(row => {
            const sistema = row.cells[1].textContent.toLowerCase();
            const cultivo = row.cells[2].textContent.toLowerCase();
            const destino = row.cells[6].textContent.toLowerCase();

            if (sistema.includes(filter) || cultivo.includes(filter) || destino.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Scroll to table
    function scrollToTable() {
        const tabla = document.getElementById("tabla-cosechas");
        if (tabla) {
            tabla.scrollIntoView({ behavior: "smooth" });
        }
    }
</script>

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
@endsection