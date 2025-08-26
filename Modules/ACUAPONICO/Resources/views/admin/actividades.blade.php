@extends('acuaponico::layouts.master')

@section('content3')
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
        font-family: 'Savate', sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
    }
    
    .form-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(79, 70, 229, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
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
    .stats-card.pending { --card-color: #f59e0b; }
    .stats-card.completed { --card-color: #10b981; }
    .stats-card.evidence { --card-color: #8b5cf6; }
    
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
    
    .action-btn.send {
        background: #f0fdf4;
        color: #059669;
    }
    
    .action-btn.send:hover {
        background: #059669;
        color: white;
        transform: translateY(-2px);
    }
    
    .action-btn.view {
        background: #f0f9ff;
        color: #0284c7;
    }
    
    .action-btn.view:hover {
        background: #0284c7;
        color: white;
        transform: translateY(-2px);
    }
    
    .action-btn.download {
        background: #f0fdf4;
        color: #059669;
    }
    
    .action-btn.download:hover {
        background: #059669;
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
    
    .badge {
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .badge.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    }
    
    .badge.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    }
    
    .badge.bg-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
    }
    
    .badge.bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
    }
    
    .badge.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    }
</style>

<div class="main-container">
    <!-- Modern header with gradient background -->
    <div class="page-header">
        <h2>Gestión de Actividades</h2>
        <p class="mb-0 mt-3" style="font-size: 1.2rem; opacity: 0.9;">Sistema integral de administración de actividades</p>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card total" onclick="scrollToTable('tabla-actividad')">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $activities->count() }}</span>
                        <h6 class="stats-label">Total Actividades</h6>
                    </div>
                    <i class="fas fa-tasks stats-icon"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card pending" onclick="scrollToTable('tabla-actividad')">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $activities->where('activity_status', 'Pendiente')->count() }}</span>
                        <h6 class="stats-label">Actividades Pendientes</h6>
                    </div>
                    <i class="fas fa-clock stats-icon"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card completed" onclick="scrollToTable('tabla-actividad')">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $activities->where('activity_status', 'Completada')->count() }}</span>
                        <h6 class="stats-label">Actividades Completadas</h6>
                    </div>
                    <i class="fas fa-check-circle stats-icon"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card evidence" onclick="scrollToTable('tabla-evidencia')">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $evidenciasAdmin->count() }}</span>
                        <h6 class="stats-label">Evidencias Registradas</h6>
                    </div>
                    <i class="fas fa-file-pdf stats-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULARIO DE CREACIÓN -->
    <div class="form-section">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                <i class="fas fa-plus text-white fa-lg"></i>
            </div>
            <h4 class="mb-0 fw-bold text-dark">Crear Nueva Actividad</h4>
        </div>

        <form action="{{ route('acuaponico.admin.admin.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-4">
                    <label for="activity_name" class="form-label fw-semibold text-dark">
                        <i class="fas fa-tasks me-2 text-primary"></i>Nombre de la Actividad
                    </label>
                    <input type="text" name="activity_name" id="activity_name" class="form-control form-control-lg" placeholder="Ingresa el nombre" required>
                </div>
                
                <div class="col-md-4">
                    <label for="user_id" class="form-label fw-semibold text-dark">
                        <i class="fas fa-user-graduate me-2 text-primary"></i>Aprendiz
                    </label>
                    <select name="user_id" id="user_id" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Seleccione un aprendiz</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="date" class="form-label fw-semibold text-dark">
                        <i class="fas fa-calendar-day me-2 text-primary"></i>Fecha
                    </label>
                    <input type="date" name="date" id="date" class="form-control form-control-lg" readonly>
                </div>
                
                <div class="col-md-4">
                    <label for="start_date" class="form-label fw-semibold text-dark">
                        <i class="fas fa-calendar-plus me-2 text-primary"></i>Fecha de Inicio
                    </label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-lg" required>
                </div>
                
                <div class="col-md-4">
                    <label for="end_date" class="form-label fw-semibold text-dark">
                        <i class="fas fa-calendar-minus me-2 text-primary"></i>Fecha de Fin
                    </label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-lg" required>
                </div>
                
                <div class="col-md-4">
                    <label for="description" class="form-label fw-semibold text-dark">
                        <i class="fas fa-align-left me-2 text-primary"></i>Descripción
                    </label>
                    <input type="text" name="description" id="description" class="form-control form-control-lg" placeholder="Ingresa la descripción" required>
                </div>
                
                <div class="col-md-4">
                    <label for="activity_status" class="form-label fw-semibold text-dark">
                        <i class="fas fa-toggle-on me-2 text-primary"></i>Estado
                    </label>
                    <select name="activity_status" id="activity_status" class="form-select form-select-lg">
                        <option value="Pendiente">Pendiente</option>
                    </select>
                </div>
                
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                        <i class="fas fa-plus me-2"></i>Crear Actividad
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="section-divider"></div>

    <!-- TABLA DE ACTIVIDADES -->
    <div class="table-section">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                <i class="fas fa-list text-white fa-lg"></i>
            </div>
            <h3 class="mb-0 fw-bold text-dark">Lista de Actividades</h3>
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
                        <input type="text" id="busqueda-actividad" class="form-control border-start-0" placeholder="Buscar por nombre, aprendiz o estado..." onkeyup="filtrarTablaActividades()">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="tabla-actividad">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>#</th>
                        <th><i class="fas fa-tasks me-2"></i>Nombre Actividad</th>
                        <th><i class="fas fa-user-graduate me-2"></i>Aprendiz</th>
                        <th><i class="fas fa-calendar-day me-2"></i>Fecha</th>
                        <th><i class="fas fa-calendar-plus me-2"></i>Fecha Inicio</th>
                        <th><i class="fas fa-calendar-minus me-2"></i>Fecha Fin</th>
                        <th><i class="fas fa-align-left me-2"></i>Descripción</th>
                        <th><i class="fas fa-toggle-on me-2"></i>Estado</th>
                        <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @forelse ($activities as $activity)
                        <tr>
                            <td><span class="badge bg-light text-dark">{{ $n++ }}</span></td>
                            <td class="fw-semibold">{{ $activity->activity_name }}</td>
                            <td class="fw-semibold">{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
                            <td>{{ $activity->date }}</td>
                            <td>{{ $activity->start_date }}</td>
                            <td>{{ $activity->end_date }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>
                                <span class="badge 
                                    @if($activity->activity_status == 'Pendiente') bg-danger
                                    @elseif($activity->activity_status == 'Completada') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $activity->activity_status)) }}
                                </span>
                            </td>
                            <td>
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $activity->id }}" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                
                                <form action="{{ route('acuaponico.admin.admin.destroy', $activity->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="action-btn delete btn-delete" data-activity-id="{{ $activity->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('acuaponico.admin.admin.send', $activity->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="action-btn send" title="Enviar">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- EDIT MODAL -->
                        <div class="modal fade" id="editModal{{ $activity->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $activity->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('acuaponico.admin.admin.update', $activity->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title w-100 text-center">
                                                <i class="fas fa-edit me-2"></i>Editar Actividad
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="activity_name_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-tasks me-2 text-primary"></i>Nombre de la Actividad
                                                    </label>
                                                    <input type="text" name="activity_name" id="activity_name_{{ $activity->id }}" class="form-control form-control-lg" value="{{ $activity->activity_name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="user_id_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-user-graduate me-2 text-primary"></i>Aprendiz
                                                    </label>
                                                    <select name="user_id" id="user_id_{{ $activity->id }}" class="form-select form-select-lg">
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ $activity->user_id == $user->id ? 'selected' : '' }}>
                                                                {{ $user->first_name }} {{ $user->last_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="date_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-calendar-day me-2 text-primary"></i>Fecha
                                                    </label>
                                                    <input type="date" name="date" id="date_{{ $activity->id }}" class="form-control form-control-lg" value="{{ $activity->date }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="start_date_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-calendar-plus me-2 text-primary"></i>Fecha de Inicio
                                                    </label>
                                                    <input type="date" name="start_date" id="start_date_{{ $activity->id }}" class="form-control form-control-lg" value="{{ $activity->start_date }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="end_date_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-calendar-minus me-2 text-primary"></i>Fecha de Fin
                                                    </label>
                                                    <input type="date" name="end_date" id="end_date_{{ $activity->id }}" class="form-control form-control-lg" value="{{ $activity->end_date }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="description_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-align-left me-2 text-primary"></i>Descripción
                                                    </label>
                                                    <input type="text" name="description" id="description_{{ $activity->id }}" class="form-control form-control-lg" value="{{ $activity->description }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="activity_status_{{ $activity->id }}" class="form-label fw-semibold">
                                                        <i class="fas fa-toggle-on me-2 text-primary"></i>Estado
                                                    </label>
                                                    <select name="activity_status" id="activity_status_{{ $activity->id }}" class="form-select form-select-lg">
                                                        <option value="Pendiente" {{ $activity->activity_status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                        <option value="Completada" {{ $activity->activity_status == 'Completada' ? 'selected' : '' }}>Completada</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success px-4">
                                                <i class="fas fa-save me-2"></i>Guardar cambios
                                            </button>
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No se encontraron actividades.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="section-divider"></div>

    <!-- TABLA DE EVIDENCIAS -->
    <div class="table-section">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                <i class="fas fa-file-pdf text-white fa-lg"></i>
            </div>
            <h3 class="mb-0 fw-bold text-dark">Actividades Completadas</h3>
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
                        <input type="text" id="busqueda-evidencia" class="form-control border-start-0" placeholder="Buscar por actividad, fecha o novedades..." onkeyup="filtrarTablaEvidencias()">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="tabla-evidencia" class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>#</th>
                        <th><i class="fas fa-tasks me-2"></i>Actividad</th>
                        <th><i class="fas fa-calendar-day me-2"></i>Fecha</th>
                        <th><i class="fas fa-newspaper me-2"></i>Novedades</th>
                        <th><i class="fas fa-file me-2"></i>Archivo</th>
                        <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach($evidenciasAdmin as $evidencia)
                        <tr>
                            <td><span class="badge bg-light text-dark">{{ $n++ }}</span></td>
                            <td class="fw-semibold">{{ $evidencia->activity->activity_name }}</td>
                            <td>{{ $evidencia->date }}</td>
                            <td>{{ $evidencia->news }}</td>
                            <td>
                                @if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence))
                                    <span class="badge bg-success">PDF Subido</span>
                                @else
                                    <span class="badge bg-danger">No disponible</span>
                                @endif
                            </td>
                            <td>
                                @if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence))
                                    <button class="action-btn view" data-bs-toggle="modal" data-bs-target="#verPdfModal{{ $evidencia->id }}" title="Ver PDF">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('evidencia.descargar', $evidencia->id) }}" class="action-btn download" title="Descargar PDF">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- PDF VIEW MODAL -->
                        <div class="modal fade" id="verPdfModal{{ $evidencia->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fas fa-file-pdf me-2"></i>Evidencia PDF
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe src="{{ route('evidencia.ver', $evidencia->id) }}" width="100%" height="600px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <p class="mb-1">Administra actividades, evidencias y usuarios de manera eficiente.</p>
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
    
    // Scroll to table function
    function scrollToTable(tableId) {
        const tabla = document.getElementById(tableId);
        if (tabla) {
            tabla.scrollIntoView({ behavior: "smooth" });
        }
    }
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 2500,
        position: 'center'
    });
</script>
@endif

@if ($errors->any())
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
@endif
@endsection