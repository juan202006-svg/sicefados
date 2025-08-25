@extends('acuaponico::layouts.master')

@section('content')
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
    .stats-card.students { --card-color: #10b981; }
    .stats-card.instructors { --card-color: #f59e0b; }
    
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
</style>

<div class="main-container">
    <!-- Modern header with gradient background -->
    <div class="page-header">
        <h2>Gestión de Usuarios</h2>
        <p class="mb-0 mt-3" style="font-size: 1.2rem; opacity: 0.9;">Sistema integral de administración de usuarios</p>
    </div>

    <div class="row">
        <!-- Enhanced form section with better styling -->
        <div class="col-lg-8">
            <div class="form-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%) !important;">
                        <i class="fas fa-user-plus text-white fa-lg"></i>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Agregar Nuevo Usuario</h4>
                </div>

                <form action="{{ route('acuaponico.admin.admin.storeUsuarios') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label fw-semibold text-dark">
                                <i class="fas fa-user me-2 text-primary"></i>Nombre
                            </label>
                            <input type="text" name="first_name" class="form-control form-control-lg" placeholder="Ingresa el Nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label fw-semibold text-dark">
                                <i class="fas fa-user me-2 text-primary"></i>Apellidos
                            </label>
                            <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Ingresa los Apellidos" required>
                        </div>

                        <div class="col-md-6">
                            <label for="opciones" class="form-label fw-semibold text-dark">
                                <i class="fas fa-user-tag me-2 text-primary"></i>Rol
                            </label>
                            <select name="role" class="form-select form-select-lg" required id="opciones">
                                <option value="" disabled selected>Seleccione un rol</option>
                                <option value="pasante">Pasante</option>
                                <option value="instructor">Instructor</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="productive_unit_id" class="form-label fw-semibold text-dark">
                                <i class="fas fa-building me-2 text-primary"></i>Unidad Productiva
                            </label>
                            <select name="productive_unit_id" class="form-select form-select-lg">
                                <option value="">-- Seleccione --</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            <i class="fas fa-plus me-2"></i>Agregar Usuario
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
                        <span class="stats-number">{{ $totalCount }}</span>
                        <h6 class="stats-label">Usuarios Registrados</h6>
                    </div>
                    <i class="fas fa-users stats-icon"></i>
                </div>
            </div>

            <div class="stats-card students" onclick="scrollToTable()">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $pasantesCount }}</span>
                        <h6 class="stats-label">Pasantes</h6>
                    </div>
                    <i class="fas fa-user-graduate stats-icon"></i>
                </div>
            </div>

            <div class="stats-card instructors" onclick="scrollToTable()">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="stats-number">{{ $instructorCount }}</span>
                        <h6 class="stats-label">Instructores</h6>
                    </div>
                    <i class="fas fa-chalkboard-teacher stats-icon"></i>
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
            <h3 class="mb-0 fw-bold text-dark">Lista de Usuarios</h3>
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
                        <input type="text" id="busqueda" class="form-control border-start-0" placeholder="Buscar por nombre, apellido o rol..." onkeyup="filtrarTabla()">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" id="tabla-usuarios">
                <thead>
                    <tr> 
                        <th><i class="fas fa-hashtag me-2"></i>N°</th>
                        <th><i class="fas fa-user me-2"></i>Nombre</th>
                        <th><i class="fas fa-user me-2"></i>Apellidos</th>
                        <th><i class="fas fa-user-tag me-2"></i>Rol</th>
                        <th><i class="fas fa-building me-2"></i>Unidad Productiva</th>
                        <th><i class="fas fa-toggle-on me-2"></i>Estado</th>
                        <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $index => $usuario)
                    <tr>
                        <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                        <td class="fw-semibold">{{ $usuario->first_name }}</td>
                        <td class="fw-semibold">{{ $usuario->last_name }}</td>
                        <td>
                            <span class="badge {{ $usuario->role == 'instructor' ? 'bg-warning' : 'bg-info' }}">
                                {{ ucfirst($usuario->role) }}
                            </span>
                        </td>
                        <td>{{ $usuario->productiveUnit->name ?? 'No asignado' }}</td>
                        <td>
                            <span class="badge {{ $usuario->status == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($usuario->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="action-btn edit" data-toggle="modal" data-target="#editModal{{ $usuario->id }}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('acuaponico.admin.admin.destroyUsuarios', $usuario->id ) }}" 
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn delete btn-delete" title="Eliminar" data-user-id="{{ $usuario->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Enhanced pagination section -->
            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded">
                <div class="text-muted">
                    <i class="fas fa-info-circle me-2"></i>
                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios
                </div>
                <div>
                    {{ $usuarios->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modern footer design -->
    <footer class="footer-modern">
        <div class="row gy-4 text-center text-md-start">
            <div class="col-md-4">
                <h6 class="fw-bold text-uppercase mb-3">
                    <i class="fas fa-leaf me-2"></i>Sistema ACUAPONICO
                </h6>
                <p class="mb-1">Administra usuarios, unidades productivas y roles de manera eficiente.</p>
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

<!-- Modales fuera del bucle para evitar problemas -->
@foreach($usuarios as $usuario)
<div class="modal fade" id="editModal{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $usuario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('acuaponico.admin.admin.updateUsuarios', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="editModalLabel{{ $usuario->id }}">
                        <i class="fas fa-edit me-2"></i>Editar Usuario: <span class="user-name-display">{{ $usuario->first_name }} {{ $usuario->last_name }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Added user info summary section -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-user me-2"></i>Usuario Actual:</strong>
                                <span class="current-user-name">{{ $usuario->first_name }} {{ $usuario->last_name }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-user-tag me-2"></i>Rol Actual:</strong>
                                <span class="badge {{ $usuario->role == 'instructor' ? 'bg-warning' : 'bg-info' }} current-user-role">
                                    {{ ucfirst($usuario->role) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name_{{ $usuario->id }}" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-primary"></i>Nombre
                            </label>
                            <input type="text" name="first_name" id="first_name_{{ $usuario->id }}" class="form-control form-control-lg" value="{{ $usuario->first_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name_{{ $usuario->id }}" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-primary"></i>Apellidos
                            </label>
                            <input type="text" name="last_name" id="last_name_{{ $usuario->id }}" class="form-control form-control-lg" value="{{ $usuario->last_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role_{{ $usuario->id }}" class="form-label fw-semibold">
                                <i class="fas fa-user-tag me-2 text-primary"></i>Rol
                            </label>
                            <select name="role" id="role_{{ $usuario->id }}" class="form-select form-select-lg" required>
                                <option value="pasante" {{ $usuario->role == 'pasante' ? 'selected' : '' }}>Pasante</option>
                                <option value="instructor" {{ $usuario->role == 'instructor' ? 'selected' : '' }}>Instructor</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status_{{ $usuario->id }}" class="form-label fw-semibold">
                                <i class="fas fa-toggle-on me-2 text-primary"></i>Estado
                            </label>
                            <select name="status" id="status_{{ $usuario->id }}" class="form-select form-select-lg" required>
                                <option value="activo" {{ $usuario->status == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ $usuario->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="productive_unit_id_{{ $usuario->id }}" class="form-label fw-semibold">
                                <i class="fas fa-building me-2 text-primary"></i>Unidad Productiva
                            </label>
                            <select name="productive_unit_id" id="productive_unit_id_{{ $usuario->id }}" class="form-select form-select-lg" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id }}" {{ $usuario->productive_unit_id == $unidad->id ? 'selected' : '' }}>
                                        {{ $unidad->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Added preview section to show changes -->
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6 class="fw-bold mb-3"><i class="fas fa-eye me-2"></i>Vista Previa de Cambios</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Nombre completo:</small>
                                <div class="preview-name fw-semibold">{{ $usuario->first_name }} {{ $usuario->last_name }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Rol y Estado:</small>
                                <div>
                                    <span class="badge bg-info preview-role">{{ ucfirst($usuario->role) }}</span>
                                    <span class="badge bg-success preview-status">{{ ucfirst($usuario->status) }}</span>
                                </div>
                            </div>
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
@endforeach

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

        // Agregar event listeners para actualización en tiempo real
        document.querySelectorAll('[id^="first_name_"], [id^="last_name_"], [id^="role_"], [id^="status_"]').forEach(input => {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });

        // Configurar event listeners para los botones de edición
        document.querySelectorAll('.action-btn.edit').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetModal = this.getAttribute('data-target');
                $(targetModal).modal('show');
            });
        });
    });

    function updatePreview(event) {
        const input = event.target;
        const modalId = input.closest('.modal').id;
        const userId = modalId.replace('editModal', '');
        
        const firstName = document.getElementById(`first_name_${userId}`).value;
        const lastName = document.getElementById(`last_name_${userId}`).value;
        const role = document.getElementById(`role_${userId}`).value;
        const status = document.getElementById(`status_${userId}`).value;
        
        updatePreviewForModal(userId, firstName, lastName, role, status);
    }

    function updatePreviewForModal(userId, firstName, lastName, role, status) {
        const modal = document.getElementById(`editModal${userId}`);
        if (!modal) return;
        
        const previewName = modal.querySelector('.preview-name');
        const previewRole = modal.querySelector('.preview-role');
        const previewStatus = modal.querySelector('.preview-status');
        
        if (previewName) previewName.textContent = `${firstName} ${lastName}`;
        if (previewRole) {
            previewRole.textContent = role.charAt(0).toUpperCase() + role.slice(1);
            previewRole.className = `badge ${role === 'instructor' ? 'bg-warning' : 'bg-info'} preview-role`;
        }
        if (previewStatus) {
            previewStatus.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            previewStatus.className = `badge ${status === 'activo' ? 'bg-success' : 'bg-secondary'} preview-status`;
        }
    }

    function filtrarTabla() {
        const input = document.getElementById("busqueda");
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const nombre = row.cells[1].textContent.toLowerCase();
            const apellidos = row.cells[2].textContent.toLowerCase();
            const rol = row.cells[3].textContent.toLowerCase();

            if (nombre.includes(filter) || apellidos.includes(filter) || rol.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Scroll to table
    function scrollToTable() {
        const tabla = document.getElementById("tabla-usuarios");
        if (tabla) {
            tabla.scrollIntoView({ behavior: "smooth" });
        }
    }

    // Modal de confirmación de eliminación
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const userId = this.getAttribute('data-user-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción eliminará el usuario permanentemente!",
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
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 3000,
        position: 'center'
    });
</script>
@endif

@if(session('info'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Información',
        text: '{{ session("info") }}',
        showConfirmButton: false,
        timer: 3000,
        position: 'center'
    });
</script>
@endif

@if(session('successDelete'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session("successDelete") }}',
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

@if(session('delete_error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '!Error¡',
        text: '{{ session("delete_error") }}',
        showConfirmButton: true,
        confirmButtonText: 'Cerrar',
        position: 'center'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '!Error¡',
        text: 'Ya existe este usuario con el mismo rol y unidad productiva',
        showConfirmButton: true,
        confirmButtonText: 'Cerrar',,
                    position: 'center'
                });
            </script>
            @endif
        </div>
    </div>
</div>

@endsection