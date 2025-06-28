@extends('acuaponico::layouts.masterpa')

@section('content2')

<h1 class="fw-bold mb-4">Gestión de cosechas</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Cosechas</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva Cosecha
            </button>
        </div>
        <div class="table-responsive">
            <table id="tabla-cultivos" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Cultivo</th>
                        <th>Cantidad</th>
                        <th>Unidad medida</th>
                        <th>Destino</th>
                        <th>Mortandad</th>
                        <th>Novedades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach ($cosechas as $ch)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $ch->date }}</td>
                        <td class="text-center">{{ $ch->crops->species->common_name }}</td>
                        <td class="text-center">{{ $ch->quantity }}</td>
                        <td class="text-center">{{ $ch->unit }}</td>
                        <td class="text-center">{{ $ch->destination }}</td>
                        <td class="text-center">{{ $ch->mortality }}</td>
                        <td class="text-center">{{ $ch->notes }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="{{ $ch->id }}"
                                data-date="{{ $ch->date }}"
                                data-crop_id="{{ $ch->crop_id }}"
                                data-quantity="{{ $ch->quantity }}"
                                data-unit="{{ $ch->unit }}"
                                data-destination="{{ $ch->destination }}"
                                data-mortality="{{ $ch->mortality }}"
                                data-notes="{{ $ch->notes }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $ch->id }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Inicio de modal de editar-->
        <div class="modal fade " id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="{{route('acuaponico.pasante.pasante.updateharvest',0) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Cosecha</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-date" class="form-label"> Fecha:</label>
                                <input type="date" class="form-control" id="edit-date" name="date" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-crop_id" class="form-label">Cultivo:</label>
                                <select class="form-control" id="edit-crop_id" name="crop_id" required>
                                    <option value="">Seleccione un cultivo</option>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}" data-quantity="{{ $cultivo->quantity }}">{{ $cultivo->species->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-quantity" class="form-label"> Cantidad: </label>
                                <input type="number" class="form-control" id="edit-quantity" name="quantity" required>
                                <div class="invalid-feedback" id="edit-error-peces" style="display:none;"></div>
                            </div>
                            <div class="mb-3">
                                <label for="edit-unit" class="form-label"> Unidad de medida: </label>
                                <input type="text" class="form-control" id="edit-unit" name="unit" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-destination" class="form-label"> Destino: </label>
                                <input type="text" class="form-control" id="edit-destination" name="destination" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-mortality" class="form-label"> Mortandad: </label>
                                <input type="number" class="form-control" id="edit-mortality" name="mortality" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-notes" class="form-label"> Novedad: </label>
                                <textarea class="form-control" name="notes" id="edit-notes"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!--termina modal de editar-->
        <!--Inicia modal de eliminar-->
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
</div>
<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route ('acuaponico.pasante.pasante.storeharvest') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nueva Cosecha</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="crop_id">Cultivo:</label>
                        <select name="crop_id" id="crop_id" class="form-control" required>
                            <option value="">Seleccione un cultivo</option>
                            @foreach ($cultivos as $cultivo)
                            <option
                                value="{{ $cultivo->id }}" data-quantity="{{ $cultivo->quantity }}">
                                {{ $cultivo->species->common_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"> Cantidad:</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" required>
                        <div class="invalid-feedback" id="error-peces" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label"> Unidad de medida:</label>
                        <input type="text" name="unit" class="form-control" id="unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label"> Destino:</label>
                        <input type="text" name="destination" class="form-control" id="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="mortality" class="form-label"> Mortandad:</label>
                        <input type="number" name="mortality" class="form-control" id="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Novedad:</label>
                        <textarea name="notes" class="form-control" id="notes" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
        </form>
    </div>
</div>
<!-- Script para establecer la fecha actual en el campo de fecha  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
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
                document.getElementById('formEditar').action = `/pasante/cosecha/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-crop_id').value = this.getAttribute('data-crop_id');
                document.getElementById('edit-quantity').value = this.getAttribute('data-quantity');
                document.getElementById('edit-unit').value = this.getAttribute('data-unit');
                document.getElementById('edit-destination').value = this.getAttribute('data-destination');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');
            });
        });
    });
</script>
<!-- validar la cantidad de peces en lacosecha y la parte de la mortalidad a lahora de agregar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function validarCantidad(inputId, errorId, selectId, mortalidadId) {
            const input = document.getElementById(inputId);
            const select = document.getElementById(selectId);
            const errorDiv = document.getElementById(errorId);
            const mortalidad = document.getElementById(mortalidadId);

            function calcular() {
                const selected = select.options[select.selectedIndex];
                const cantidadMax = parseInt(selected.getAttribute('data-quantity')) || 0;
                const cantidad = parseInt(input.value) || 0;

                if (cantidad < 0 || isNaN(cantidad)) {
                    input.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    if (mortalidad) mortalidad.value = '';
                    return;
                }

                if (cantidad > cantidadMax) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = `No puedes ingresar más de ${cantidadMax} peces.`;
                    if (mortalidad) mortalidad.value = '';
                } else {
                    input.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    if (mortalidad) {
                        mortalidad.value = cantidadMax - cantidad;
                    }
                }
            }

            select.addEventListener('change', calcular);
            input.addEventListener('input', calcular);
        }

        // Agregar
        validarCantidad('quantity', 'error-peces', 'crop_id', 'mortality');
        // Editar
        validarCantidad('edit-quantity', 'edit-error-peces', 'edit-crop_id', 'edit-mortality');
    });
</script>


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
                    formEliminar.action = `/pasante/cosecha/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<!-- Bootstrap 5 JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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
            }
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