@extends('acuaponico::layouts.master')

@section('content5')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .table-custom {
        --bs-table-bg: #fff;
        --bs-table-striped-bg: #f9fafb;
        --bs-table-hover-bg: #f8f9fa;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-custom thead th {
        background-color: #4e73df;
        color: white;
        border: none;
        font-weight: 600;
    }
    .table-custom tbody tr {
        transition: all 0.2s ease;
    }
    .table-custom tbody tr:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        border-radius: 50rem;
    }
    .notes-cell {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 3px;
    }
    .gradient-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .table-rounded {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0 text-dark">
                <i class="fas fa-clipboard-list me-2"></i>Gestión de Seguimientos
            </h1>
            <p class="text-muted mb-0">Monitoreo y seguimiento de cultivos</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#agregar">
            <i class="fas fa-plus me-2"></i>Nuevo Seguimiento
        </button>
    </div>

    <div class="card table-rounded shadow-sm border-0">
        <div class="card-header card-header-custom">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-table me-2"></i>Registros de Seguimiento
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tabla-cultivos" class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Fecha</th>
                            <th>Cultivo</th>
                            <th>Tiempo (días)</th>
                            <th>Novedades</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimientos as $seguimiento)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $n++ }}</td>
                            <td>
                                <span class="badge bg-light text-dark status-badge">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($seguimiento->date)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="fw-semibold text-primary">
                                <i class="fas fa-seedling me-2"></i>
                                {{ $seguimiento->crops->species->common_name }}
                            </td>
                            <td>
                                <span class="badge bg-info text-white status-badge">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $seguimiento->days_elapsed }}
                                </span>
                            </td>
                            <td class="notes-cell" title="{{ $seguimiento->notes }}">
                                <i class="far fa-sticky-note me-2 text-muted"></i>
                                {{ $seguimiento->notes }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary action-btn editbtn"
                                    data-id="{{ $seguimiento->id }}"
                                    data-date="{{ $seguimiento->date }}"
                                    data-crop_id="{{ $seguimiento->crop_id }}"
                                    data-days_elapsed="{{ $seguimiento->days_elapsed }}"
                                    data-notes="{{ $seguimiento->notes }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger action-btn btnEliminar" 
                                    data-id="{{ $seguimiento->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header gradient-header">
                    <h5 class="modal-title" id="agregarLabel">
                        <i class="fas fa-plus-circle me-2"></i>Nuevo Seguimiento
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route ('acuaponico.pasante.pasante.storetracking') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Fecha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                    <input type="date" name="date" class="form-control" id="date" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="crop_id" class="form-label">Cultivo</label>
                                <select name="crop_id" id="crop_id" class="form-select" required>
                                    <option value="">Seleccione un cultivo</option>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}" data-date="{{ $cultivo->date }}">
                                        {{ $cultivo->species->common_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="days_elapsed" class="form-label">Tiempo en días</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    <input type="number" name="days_elapsed" class="form-control" id="days_elapsed" required readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label">Novedad</label>
                            <textarea name="notes" class="form-control" id="notes" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header gradient-header">
                    <h5 class="modal-title" id="editarLabel">
                        <i class="fas fa-edit me-2"></i>Editar Seguimiento
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditar" action="{{route ('acuaponico.pasante.pasante.updatetracking',0)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit-date" class="form-label">Fecha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="edit-date" name="date">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit-crop_id" class="form-label">Cultivo</label>
                                <select class="form-select" id="edit-crop_id" name="crop_id" required>
                                    <option value="">Seleccione un cultivo</option>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}">{{ $cultivo->species->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit-days_elapsed" class="form-label">Tiempo en días</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    <input type="number" class="form-control" id="edit-days_elapsed" name="days_elapsed" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-notes" class="form-label">Novedad</label>
                            <textarea class="form-control" name="notes" id="edit-notes" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEliminar" method="POST" action="">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#tabla-cultivos').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "dom": '<"top"f>rt<"bottom"lip><"clear">',
            "initComplete": function() {
                $('.dataTables_filter input').addClass('form-control');
            }
        });
    });
</script>

<!-- Script para establecer la fecha actual -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });
</script>

<!-- Script para calcular días transcurridos -->
<script>
    document.getElementById('crop_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fechaCultivo = selectedOption.getAttribute('data-date');

        if (fechaCultivo) {
            const fechaInicio = new Date(fechaCultivo);
            const fechaHoy = new Date();

            const diffTiempo = fechaHoy - fechaInicio;
            const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

            document.getElementById('days_elapsed').value = diffDias;
        } else {
            document.getElementById('days_elapsed').value = '';
        }
    });
</script>

<!-- Script del modal editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/seguimiento/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-crop_id').value = this.getAttribute('data-crop_id');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');
            });
        });
    });
</script>

<!-- Script para eliminar -->
<script>
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
                    formEliminar.action = `/pasante/seguimiento/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6',
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
        confirmButtonColor: '#d33',
    });
</script>
@endif

@endsection