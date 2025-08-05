@extends('acuaponico::layouts.master')

@section('content3')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/b.0ootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-gradient mb-0">
            <i class="bi bi-flower2 me-2"></i>Gestión de Especies
        </h1>
        <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#agregar">
            <i class="bi bi-plus-circle me-2"></i>Nueva Especie
        </button>
    </div>

    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="mb-0 fw-semibold text-primary">
                <i class="bi bi-list-check me-2"></i>Lista de Cultivos
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tabla-especies" class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Código</th>
                            <th>Fecha</th>
                            <th>Categoría</th>
                            <th>Nombre Científico</th>
                            <th>Nombre Común</th>
                            <th>Ciclo Vida</th>
                            <th>Temp. Óptima (°C)</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($especies as $especie)
                        <tr class="border-top">
                            <td class="ps-4 fw-medium">{{ $n++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($especie->date)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    {{ $especie->category->name }}
                                </span>
                            </td>
                            <td class="fst-italic">{{ $especie->scientific_name }}</td>
                            <td>{{ $especie->common_name }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                    {{ $especie->life_cycle }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    {{ $especie->optimal_temperature }}°C
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-sm btn-outline-primary editbtn"
                                        data-id="{{ $especie->id }}"
                                        data-date="{{ $especie->date }}"
                                        data-category_id="{{ $especie->category_id }}"
                                        data-scientific_name="{{ $especie->scientific_name }}"
                                        data-common_name="{{ $especie->common_name }}"
                                        data-life_cycle="{{ $especie->life_cycle }}"
                                        data-optimal_temperature="{{ $especie->optimal_temperature }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger btnEliminar" data-id="{{ $especie->id }}">
                                        <i class="bi bi-trash"></i>
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

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="{{ route('acuaponico.pasante.pasante.storespecies') }}" method="POST">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Nueva Especie
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Fecha</label>
                            <input type="date" name="date" class="form-control rounded-3" id="date" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categoty_id">Categoría:</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="scientific_name" class="form-label">Nombre Científico</label>
                            <input type="text" name="scientific_name" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="common_name" class="form-label">Nombre Común</label>
                            <input type="text" name="common_name" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ciclo_vida" class="form-label">Ciclo de Vida</label>
                            <input type="text" name="life_cycle" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="temperatura_optima" class="form-label">Temperatura Óptima (°C)</label>
                            <input type="number" name="optimal_temperature" class="form-control rounded-3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="bi bi-save me-1"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updatespecies', 0) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="editarLabel">
                        <i class="bi bi-pencil-square me-2"></i>Editar Especie
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-fecha" class="form-label">Fecha:</label>
                            <input type="date" class="form-control rounded-3" id="edit-date" name="date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-category_id" class="form-label">Categoría:</label>
                            <select class="form-select rounded-3" id="edit-category_id" name="category_id" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-nombre" class="form-label">Nombre Científico:</label>
                            <input type="text" class="form-control rounded-3" id="edit-scientific_name" name="scientific_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-nombre" class="form-label">Nombre Común:</label>
                            <input type="text" class="form-control rounded-3" id="edit-common_name" name="common_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-nombre" class="form-label">Ciclo de Vida:</label>
                            <input type="text" class="form-control rounded-3" id="edit-life_cycle" name="life_cycle">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-nombre" class="form-label">Temperatura Óptima (°C):</label>
                            <input type="number" class="form-control rounded-3" id="edit-optimal_temperature" name="optimal_temperature">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="bi bi-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#tabla-especies').DataTable({
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
                $('.dataTables_filter input').addClass('form-control rounded-pill');
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

<!--script del modal editar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/especie/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-category_id').value = this.getAttribute('data-category_id');
                document.getElementById('edit-scientific_name').value = this.getAttribute('data-scientific_name');
                document.getElementById('edit-common_name').value = this.getAttribute('data-common_name');
                document.getElementById('edit-life_cycle').value = this.getAttribute('data-life_cycle');
                document.getElementById('edit-optimal_temperature').value = this.getAttribute('data-optimal_temperature');
            });
        });
    });
</script>

<!-- Script Modal Eliminar -->
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
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'rounded-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formEliminar = document.getElementById('formEliminar');
                    formEliminar.action = `/pasante/especie/destroy/${id}`;
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
        customClass: {
            popup: 'rounded-3'
        }
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
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
@endif

<style>
    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
    }
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
    .fst-italic {
        font-style: italic;
    }
</style>
@endsection
