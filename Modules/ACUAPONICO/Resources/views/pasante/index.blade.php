@extends('acuaponico::layouts.masterpa')

@section('content2')

<!-- Bootstrap CSS (Asegúrate de que esté incluido en el layout o aquí) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<h1 class="fw-bold mb-4">Gestión de Lotes</h1>

<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Lotes</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLot">
                <i class="bi bi-plus-circle"></i> Agregar Lote
            </button>
        </div>
        <div class="table-responsive">
            <table id="lotesTable" class="table table-hover table-bordered align-middle text-center" style="width:100%">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Código</th>
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
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $lot->date }}</td>
                        <td class="text-center">{{ $lot->name }}</td>
                        <td class="text-center">{{ $lot->capacity }}</td>
                        <td class="text-center">{{$lot->state }} </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="{{ $lot->id }}"
                                data-date="{{ $lot->date }}"
                                data-name="{{ $lot->name }}"
                                data-capacity="{{ $lot->capacity }}"
                                data-state="{{ $lot->state }}"
                                data-bs-toggle="modal"
                                data-bs-target="#updateLot">
                                Editar
                            </button>
                           <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $lot->id }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('acuaponico.pasante.pasante.storeLot') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createLotLabel">Nuevo Lote</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidad:</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">Estado:</label>
                        <select name="state" class="form-select" required>
                            <option value="disponible">Disponible</option>
                            <option value="ocupado">Ocupado</option>
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

<!-- Modal de edición -->
<div class="modal fade" id="updateLot" tabindex="-1" aria-labelledby="updateLotLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateLot', 0) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateLotLabel">Editar Lote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-date" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="edit-date" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-capacity" class="form-label">Capacidad:</label>
                        <input type="number" class="form-control" id="edit-capacity" name="capacity">
                    </div>
                    <div class="mb-3">
                        <label for="edit-state" class="form-label">Estado:</label>
                        <select class="form-control" id="edit-state" name="state" required>
                            <option value="">Seleccione un estado</option>
                            <option value="disponible">Disponible</option>
                            <option value="ocupado">Ocupado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de eliminar -->
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('date');
        var currentDate = new Date().toISOString().split('T')[0];
        dateInput.value = currentDate;
    });
</script>

<!-- Script del modal editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/lote/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-name').value = this.getAttribute('data-name');
                document.getElementById('edit-capacity').value = this.getAttribute('data-capacity');
                document.getElementById('edit-state').value = this.getAttribute('data-state');
            });
        });
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
                    formEliminar.action = `/pasante/lote/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>



<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#lotesTable').DataTable({
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

@endsection