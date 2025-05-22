@extends( 'acuaponico::layouts.masterpa' )


@section('content2')
<div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestión de Cultivos</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
            <i class="bi bi-plus-circle"></i> Nuevo Cultivo
        </button>
    </div>

    <div class="table-responsive">
        <table id="tabla-especies" class="table table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
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
                            data-category_id="{{ $cultivo->species_id }}"
                            data-scientific_name="{{ $cultivo->lot_id}}"
                            data-common_name="{{ $cultivo->quantity }}"
                            data-life_cycle="{{ $cultivo->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editar">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger btn-sm deletbtn"
                            data-id="{{ $cultivo->id }}"
                            data-bs-toggle="modal"
                            data-bs-target="#eliminar">
                            Eliminar
                        </button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Inicio de modal de editar-->
        <div class="modal fade bg-white" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Especies</h5>
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
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($especies as $especie)
                                    <option value="{{ $especie->id }}">{{ $especie->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-lot_id" class="form-label">Lote:</label>
                                <select class="form-control" id="edit-lot_id" name="lot_id" required>
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
        <div class="modal fade bg-white" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEliminar" action="" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarLabel">Confirmar Eliminacion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estas seguro de que quieres eliminar esta especie?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!--script del modal de eliminar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.deletbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/pasante/especie/destroy/${id}`;
            });
        });
    });
</script>
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
                        <input type="date" name="date" class="form-control" id="date" equired>
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
                        <input type="number" name="quantity" class="form-control" equired>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select name="status"  class="form-control" required>
                            <option value="Cultivado">Cultivado</option>
                            <option value="Seguimiento">Seguimiento</option>
                            <option value="Cosechado">Cosechado</option>
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




@endsection