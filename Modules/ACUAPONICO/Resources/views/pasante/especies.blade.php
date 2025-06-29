@extends ('acuaponico::layouts.masterpa')

@section('content2')
<h1 class="fw-bold mb-4">Gestión de Especies</h1>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Cultivos</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva Especie
            </button>
        </div>
        <div class="table-responsive">
            <table id="tabla-especies" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Categoria</th>
                        <th>Nombre Cientifico</th>
                        <th>Nombre Comun</th>
                        <th>Ciclo vida</th>
                        <th>Temperatura optima C°</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach ($especies as $especie)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $especie->date }}</td>
                        <td class="text-center">{{ $especie->category->name }}</td>
                        <td class="text-center">{{ $especie->scientific_name }}</td>
                        <td class="text-center">{{ $especie->common_name }}</td>
                        <td class="text-center">{{ $especie->life_cycle }}</td>
                        <td class="text-center">{{ $especie->optimal_temperature }}°C</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="{{ $especie->id }}"
                                data-date="{{ $especie->date }}"
                                data-category_id="{{ $especie->category_id }}"
                                data-scientific_name="{{ $especie->scientific_name }}"
                                data-common_name="{{ $especie->common_name }}"
                                data-life_cycle="{{ $especie->life_cycle }}"
                                data-optimal_temperature="{{ $especie->optimal_temperature }}"

                                data-bs-toggle="modal"
                                data-bs-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $especie->id }}">
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
                    <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updatespecies', 0) }}" method="POST">
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
                                <label for="edit-category_id" class="form-label">Categoría:</label>
                                <select class="form-control" id="edit-category_id" name="category_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-nombre" class="form-label"> Nombre Cientifico: </label>
                                <input type="text" class="form-control" id="edit-scientific_name" name="scientific_name">
                            </div>
                            <div class="mb-3">
                                <label for="edit-nombre" class="form-label"> Nombre Comun: </label>
                                <input type="text" class="form-control" id="edit-common_name" name="common_name">
                            </div>
                            <div class="mb-3">
                                <label for="edit-nombre" class="form-label"> Ciclo de Vida: </label>
                                <input type="text" class="form-control" id="edit-life_cycle" name="life_cycle">
                            </div>
                            <div class="mb-3">
                                <label for="edit-nombre" class="form-label"> Temperatura Optima C°: </label>
                                <input type="number" class="form-control" id="edit-optimal_temperature" name="optimal_temperature">
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
        <form action="{{ route('acuaponico.pasante.pasante.storespecies') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nueva Especie</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="categoty_id">Categoria:</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Seleccione una categoria</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="scientific_name" class="form-label">Nombre Cientifico: </label>
                        <input type="text" name="scientific_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="common_name" class="form-label">Nombre Comun: </label>
                        <input type="text" name="common_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ciclo_vida" class="form-label">Ciclo de Vida: </label>
                        <input type="text" name="life_cycle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="temperatura_optima" class="form-label">Temperatura Optima C°: </label>
                        <input type="number" name="optimal_temperature" class="form-control" required>
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
<!-- Script para establecer la fecha actual en el campo de fecha  -->
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
                cancelButtonText: 'Cancelar'
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