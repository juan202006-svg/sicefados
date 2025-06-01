@extends( 'acuaponico::layouts.masterpa' )


@section('content2')
<h1 class="fw-bold mb-4">Gestión de Cultivos</h1>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Cultivos</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo Cultivo
            </button>
        </div>
        <div class="table-responsive">
            <div class="card-body">
                <table id="tabla-especies" class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Especie</th>
                            <th>Lote</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($cultivos as $cultivo)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $cultivo->date }}</td>
                            <td class="text-center">{{ $cultivo->species->common_name }}</td>
                            <td class="text-center">{{ $cultivo->lot->name }}</td>
                            <td class="text-center">{{ $cultivo->quantity }}</td>
                            <td class="text-center">{{ $cultivo->status }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="{{ $cultivo->id }}"
                                    data-date="{{ $cultivo->date }}"
                                    data-species_id="{{ $cultivo->species_id }}"
                                    data-lot_id="{{ $cultivo->lot_id }}"
                                    data-quantity="{{ $cultivo->quantity }}"
                                    data-status="{{ $cultivo->status }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editar">
                                    Editar
                                </button>

                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $cultivo->id }}">
                                    Eliminar
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Inicio de modal de editar-->
                <div class="modal fade " id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formEditar" action="" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarLabel">Editar cultivo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="edit-id">
                                    <div class="mb-3">
                                        <label for="edit-fecha" class="form-label"> Fecha:</label>
                                        <input type="date" class="form-control" id="edit-date" name="date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-species_id" class="form-label">Especie:</label>
                                        <select class="form-control" id="edit-species_id" name="species_id" required>
                                            <option value="">Seleccione un cultivo</option>
                                            @foreach ($especies as $especie)
                                            <option value="{{ $especie->id }}">{{ $especie->common_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-lot_id" class="form-label">Lote:</label>
                                        <select id="edit-lot_id" class="form-control" name="lot_id" required>
                                            <option value="">Seleccione un Lote</option>
                                            @foreach ($lotes as $lote)
                                            <option value="{{ $lote->id }}">{{ $lote->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-quantity" class="form-label"> cantidad a cultivar: </label>
                                        <input type="number" class="form-control" id="edit-quantity" name="quantity">
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit-status" class="form-label">Estado:</label>
                                        <select class="form-control" id="edit-status" name="status" required>
                                            <option value="">Seleccione un estado</option>
                                            <option value="Cultivado">Cultivado</option>
                                            <option value="Seguimiento">Seguimiento</option>
                                            <option value="Cosechado">Cosechado</option>
                                        </select>
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
                <div class="modal fade " id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formEliminar" action="" method="POST" style="display:none;">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('acuaponico.pasante.pasante.storecrops') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nuevo cultivo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>
                    <div class="form-group">
                        <label for="lot_id">Lote:</label>
                        <select name="lot_id" class="form-control" required>
                            <option value="">Seleccione un Lote</option>
                            @foreach ($lotes as $lote)
                            <option value="{{ $lote->id }}">{{ $lote->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="species_id">Especie:</label>
                        <select name="species_id" class="form-control" required>
                            <option value="">Seleccione una especie</option>
                            @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}">{{ $especie->common_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad a cultivar: </label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select name="status" class="form-control" required>
                            <option value="Cultivado">Cultivado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
<!--script del modal editar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/cultivo/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-species_id').value = this.getAttribute('data-species_id');
                document.getElementById('edit-lot_id').value = this.getAttribute('data-lot_id');
                document.getElementById('edit-quantity').value = this.getAttribute('data-quantity');
                document.getElementById('edit-status').value = this.getAttribute('data-status');
            });

        });
    });
</script>
<!--script del modal de eliminar-->
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
                    formEliminar.action = `/pasante/cultivo/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>
</div>
</div>

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
            }
        });
    });
</script>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
    });
</script>
@endif

@endsection