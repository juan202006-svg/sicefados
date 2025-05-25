@extends('acuaponico::layouts.masterpa')

@section('content')

<!-- Bootstrap CSS (Ensure this is included in your layout or here) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<h1 class="fw-bold mb-4">Gestión de Lotes</h1>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Listado de Lotes</h4>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createLot">Agregar Lote</button>
        </div>
        <div class="card-body">
            <!-- Search and Show Entries -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <label for="show-entries" class="me-2">Mostrar</label>
                    <select id="show-entries" class="form-select form-select-sm" style="width: auto;">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-2">registros</span>
                </div>
                <div>
                    <input type="text" class="form-control form-control-sm" placeholder="Buscar:" style="width: 200px;">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead style="background-color: #e6f4ea;">
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($lots as $lot)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $lot->date }}</td>
                            <td>{{ $lot->name }}</td>
                            <td>{{ $lot->capacity }}</td>
                            <td>
                                <span class="badge bg-{{ $lot->state == 'disponible' ? 'success' : ($lot->state == 'ocupado' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($lot->state) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#updateLot{{ $lot->id }}">Editar</button>
                                <form action="{{ route('acuaponico.pasante.pasante.destroyLot', $lot->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este lote?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="updateLot{{ $lot->id }}" tabindex="-1" aria-labelledby="updateLotLabel{{ $lot->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('acuaponico.pasante.pasante.updateLot', $lot->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="updateLotLabel{{ $lot->id }}">Editar Lote</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Fecha:</label>
                                                <input type="date" name="date" value="{{ $lot->date }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre:</label>
                                                <input type="text" name="name" value="{{ $lot->name }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Capacidad:</label>
                                                <input type="number" name="capacity" value="{{ $lot->capacity }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Estado:</label>
                                                <select name="state" class="form-select" required>
                                                    <option value="disponible" {{ $lot->state == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                                    <option value="no disponible" {{ $lot->state == 'no disponible' ? 'selected' : '' }}>No disponible</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>Mostrando 1 a 3 de 3 registros</div>
                <div>
                    <button class="btn btn-outline-primary btn-sm me-1" disabled>Anterior</button>
                    <button class="btn btn-primary btn-sm me-1">1</button>
                    <button class="btn btn-outline-primary btn-sm">Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('acuaponico.pasante.pasante.storeLot') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="createLotLabel">Agregar Lote</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id= "date"   required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacidad:</label>
                        <input type="number" name="capacity" class="form-control"  required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado:</label>
                        <select name="state" class="form-select" required>
                            <option value="disponible">Disponible</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('date');
        var currentDate = new Date().toISOString().split('T')[0];
        dateInput.value = currentDate;
    });
</script>

@endsection