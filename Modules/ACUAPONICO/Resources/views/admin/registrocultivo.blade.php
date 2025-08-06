@extends('acuaponico::layouts.master')

@section('content4')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .custom-card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .custom-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .table-custom {
        --bs-table-bg: #fff;
        --bs-table-striped-bg: #f8f9fa;
        --bs-table-hover-bg: #f1f3f5;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-custom thead th {
        background-color: #4e73df;
        color: white;
        font-weight: 600;
        border: none;
        padding: 1rem;
    }
    .table-custom tbody tr {
        transition: all 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05) !important;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35em 0.75em;
        border-radius: 50rem;
        font-weight: 500;
    }
    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    .gradient-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .lot-badge {
        display: inline-block;
        margin: 0.1rem;
        font-size: 0.75rem;
    }
    .select2-container--default .select2-selection--multiple {
        border-radius: 8px !important;
        min-height: 42px;
        padding: 3px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e9ecef;
        border: none;
        border-radius: 4px;
        padding: 0 8px;
    }
</style>

<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0 text-dark">
                <i class="fas fa-leaf me-2 text-success"></i>Gestión de Cultivos
            </h1>
            <p class="text-muted mb-0">Sistema de seguimiento de cultivos acuapónicos</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#agregar">
            <i class="fas fa-plus me-2"></i>Nuevo Cultivo
        </button>
    </div>

    <div class="card custom-card">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-dark">
                    <i class="fas fa-list-ul me-2 text-primary"></i>Registros de Cultivos
                </h5>
                <div class="d-flex">
                    <input type="text" id="searchInput" class="form-control form-control-sm rounded-pill" placeholder="Buscar...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tabla-cultivo" class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Fecha</th>
                            <th>Especie</th>
                            <th>Lotes</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($cultivos as $cultivo)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $n++ }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="far fa-calendar me-1 text-muted"></i>
                                    {{ \Carbon\Carbon::parse($cultivo->date)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="fw-semibold">
                                <i class="fas fa-seedling me-2 text-success"></i>
                                {{ $cultivo->species->common_name }}
                            </td>
                            <td>
                                @foreach ($cultivo->lotes as $lote)
                                <span class="lot-badge badge bg-info bg-opacity-10 text-info border border-info border-opacity-10">
                                    {{ $lote->name }} ({{ $lote->pivot->planted_quantity }})
                                </span>
                                @endforeach
                            </td>
                            <td class="fw-bold text-primary">{{ $cultivo->quantity }}</td>
                            <td>
                                @if($cultivo->status == 'Cultivado')
                                <span class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-10">
                                    <i class="fas fa-seedling me-1"></i>{{ $cultivo->status }}
                                </span>
                                @elseif($cultivo->status == 'Seguimiento')
                                <span class="status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10">
                                    <i class="fas fa-eye me-1"></i>{{ $cultivo->status }}
                                </span>
                                @else
                                <span class="status-badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10">
                                    <i class="fas fa-basket-shopping me-1"></i>{{ $cultivo->status }}
                                </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-primary action-btn me-2 editbtn"
                                    data-id="{{ $cultivo->id }}"
                                    data-date="{{ $cultivo->date }}"
                                    data-species_id="{{ $cultivo->species_id }}"
                                    data-lot_ids="{{ $cultivo->lotes->pluck('id')->implode(',') }}"
                                    data-quantity="{{ $cultivo->quantity }}"
                                    data-status="{{ $cultivo->status }}"
                                    @foreach($cultivo->lotes as $lote)
                                    data-lot_asignado_{{ $lote->id }}="{{ $lote->pivot->planted_quantity }}"
                                    @endforeach
                                    data-bs-toggle="modal"
                                    data-bs-target="#editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger action-btn btnEliminar" 
                                    data-id="{{ $cultivo->id }}">
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
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header gradient-header">
                <h5 class="modal-title" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Cultivo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('acuaponico.pasante.pasante.storecrops') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Fecha</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="far fa-calendar text-muted"></i></span>
                                <input type="date" name="date" class="form-control" id="date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="species_id" class="form-label">Especie</label>
                            <select name="species_id" class="form-select" required>
                                <option value="">Seleccione una especie</option>
                                @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}">{{ $especie->common_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lot_ids" class="form-label">Lotes</label>
                        <select id="lot_ids" name="lot_ids[]" class="form-select" multiple required>
                            @foreach ($lotesDisponibles as $lote)
                            <option value="{{ $lote->id }}" data-capacidad="{{ $lote->capacity }}" data-ocupado="{{ $lote->ocupado }}">
                                {{ $lote->name }} (Disponible: {{ $lote->capacity - $lote->ocupado }})
                            </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Mantén presionado Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples lotes</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Cantidad a cultivar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-hashtag text-muted"></i></span>
                                <input type="number" id="quantity" name="quantity" class="form-control" required>
                            </div>
                            <div class="invalid-feedback" id="error-cantidad"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select name="status" class="form-select" required>
                                <option value="Cultivado">Cultivado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header gradient-header">
                <h5 class="modal-title" id="editarLabel">
                    <i class="fas fa-edit me-2"></i>Editar Cultivo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditar" action="" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-date" class="form-label">Fecha</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="far fa-calendar text-muted"></i></span>
                                <input type="date" class="form-control" id="edit-date" name="date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-species_id" class="form-label">Especie</label>
                            <select class="form-select" id="edit-species_id" name="species_id" required>
                                <option value="">Seleccione un cultivo</option>
                                @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}">{{ $especie->common_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit-lot_ids" class="form-label">Lotes</label>
                        <select id="edit-lot_ids" class="form-select" name="lot_ids[]" multiple required>
                            @foreach ($lotesTodos as $lote)
                            <option value="{{ $lote->id }}" data-state="{{ $lote->state }}" data-capacidad="{{ $lote->capacity }}" data-ocupado="{{ $lote->ocupado }}">
                                {{ $lote->name }} (Capacidad: {{ $lote->capacity - $lote->ocupado }})
                            </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Mantén presionado Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples lotes</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-quantity" class="form-label">Cantidad a cultivar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-hashtag text-muted"></i></span>
                                <input type="number" class="form-control" id="edit-quantity" name="quantity">
                            </div>
                            <div class="invalid-feedback" id="error-cantidad-edit"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-status" class="form-label">Estado</label>
                            <select class="form-select" id="edit-status" name="status" required>
                                <option value="">Seleccione un estado</option>
                                <option value="Cultivado">Cultivado</option>
                                <option value="Seguimiento">Seguimiento</option>
                                <option value="Cosechado">Cosechado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form id="formEliminar" method="POST" action="" style="display:none;">
                @csrf
                @method('delete')
            </form>
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
<!-- Select2 (opcional para selects múltiples mejorados) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('#tabla-cultivo').DataTable({
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

        // Inicializar Select2 para selects múltiples
        $('#lot_ids, #edit-lot_ids').select2({
            placeholder: "Seleccione lotes",
            width: '100%',
            dropdownParent: $('#agregar, #editar')
        });
    });

    // Script para establecer la fecha actual
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });

    // Script para validación de lotes y cantidad (agregar)
    document.addEventListener('DOMContentLoaded', function() {
        const loteSelect = document.getElementById('lot_ids');
        const cantidadInput = document.getElementById('quantity');
        const errorDiv = document.getElementById('error-cantidad');
        const form = loteSelect.closest('form');

        let capacidadTotal = 0;

        function calcularCapacidadTotal() {
            const selectedOptions = Array.from(loteSelect.selectedOptions);
            capacidadTotal = selectedOptions.reduce((total, option) => {
                const capacidad = parseInt(option.getAttribute('data-capacidad')) || 0;
                const ocupado = parseInt(option.getAttribute('data-ocupado')) || 0;
                return total + (capacidad - ocupado);
            }, 0);
        }

        function validarCantidad() {
            calcularCapacidadTotal();
            const cantidad = parseInt(cantidadInput.value) || 0;

            if (cantidad > capacidadTotal) {
                cantidadInput.classList.add('is-invalid');
                errorDiv.innerText = `La cantidad excede la capacidad total de los lotes seleccionados (${capacidadTotal}).`;
                return false;
            } else {
                cantidadInput.classList.remove('is-invalid');
                errorDiv.innerText = '';
                return true;
            }
        }

        loteSelect.addEventListener('change', validarCantidad);
        cantidadInput.addEventListener('input', validarCantidad);

        form.addEventListener('submit', function(e) {
            if (!validarCantidad()) {
                e.preventDefault();
            }
        });
    });

    // Script para validación de lotes y cantidad (editar)
    document.addEventListener('DOMContentLoaded', function() {
        const loteSelectEdit = document.getElementById('edit-lot_ids');
        const cantidadInputEdit = document.getElementById('edit-quantity');
        const formEdit = document.getElementById('formEditar');
        const errorDivEdit = document.getElementById('error-cantidad-edit');

        function calcularCapacidadTotalEdit() {
            const selectedOptions = Array.from(loteSelectEdit.selectedOptions);
            let total = 0;
            selectedOptions.forEach(option => {
                const capacidad = parseInt(option.getAttribute('data-capacidad')) || 0;
                const ocupado = parseInt(option.getAttribute('data-ocupado')) || 0;
                total += (capacidad - ocupado);
            });
            return total;
        }

        function validarCantidadEdit() {
            const capacidadTotal = calcularCapacidadTotalEdit();
            const cantidad = parseInt(cantidadInputEdit.value) || 0;

            if (cantidad > capacidadTotal) {
                cantidadInputEdit.classList.add('is-invalid');
                errorDivEdit.innerText = `La cantidad excede la capacidad total de los lotes seleccionados (${capacidadTotal}).`;
                return false;
            } else {
                cantidadInputEdit.classList.remove('is-invalid');
                errorDivEdit.innerText = '';
                return true;
            }
        }

        loteSelectEdit.addEventListener('change', validarCantidadEdit);
        cantidadInputEdit.addEventListener('input', validarCantidadEdit);

        formEdit.addEventListener('submit', function(e) {
            if (!validarCantidadEdit()) {
                e.preventDefault();
            }
        });

        // Configuración del modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const loteIds = this.getAttribute('data-lot_ids').split(',');
                const form = document.getElementById('formEditar');

                form.action = `/pasante/cultivo/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-species_id').value = this.getAttribute('data-species_id');
                document.getElementById('edit-quantity').value = this.getAttribute('data-quantity');
                document.getElementById('edit-status').value = this.getAttribute('data-status');

                // Mostrar solo los lotes actuales o disponibles
                const options = loteSelectEdit.querySelectorAll('option');
                options.forEach(option => {
                    const loteId = option.value;
                    const loteState = option.getAttribute('data-state');
                    const capacidad = parseInt(option.getAttribute('data-capacidad')) || 0;
                    const ocupado = parseInt(option.getAttribute('data-ocupado')) || 0;

                    // Si este lote pertenece al cultivo, restamos su cantidad asignada actual
                    let ocupadoAjustado = ocupado;
                    if (loteIds.includes(loteId)) {
                        const asignadoActual = parseInt(
                            document.querySelector(`button[data-id='${id}']`)
                            ?.getAttribute('data-lot_asignado_' + loteId)
                        ) || 0;
                        ocupadoAjustado -= asignadoActual;
                    }

                    option.setAttribute('data-ocupado', ocupadoAjustado);

                    if (loteIds.includes(loteId) || loteState === 'disponible') {
                        option.style.display = '';
                        option.disabled = false;
                        option.selected = loteIds.includes(loteId);
                    } else {
                        option.style.display = 'none';
                        option.selected = false;
                    }
                });

                setTimeout(() => {
                    validarCantidadEdit();
                }, 200);
            });
        });
    });

    // Script para eliminar
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
                    formEliminar.action = `/pasante/cultivo/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

@if(session('error'))
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

@endsection