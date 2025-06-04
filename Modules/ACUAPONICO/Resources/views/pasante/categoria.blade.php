@extends('acuaponico::layouts.masterpa')

@section('content2')
<h1 class="fw-bold mb-4">Gestión de Categorias</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Categorias</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva categoria
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table id="tabla-categorias" class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($categorias as $item)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->date }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="{{ $item->id }}"
                                    data-date="{{ $item->date }}"
                                    data-name="{{ $item->name }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editar">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $item->id }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar -->
        <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('acuaponico.pasante.pasante.storeCategory') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="agregarLabel">Agregar Nueva Categoría</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha:</label>
                                <input type="date" name="date" class="form-control" id="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Categoría:</label>
                                <input type="text" name="name" class="form-control" required>
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

        <!-- Modal Editar -->
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateCategory', 0) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Categoría</h5>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
        <div>
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
                $('#tabla-categorias').DataTable({
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

        <!-- Script Modal Editar -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.editbtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        document.getElementById('formEditar').action = `/pasante/categoria/update/${id}`;
                        document.getElementById('edit-id').value = id;
                        document.getElementById('edit-date').value = this.getAttribute('data-date');
                        document.getElementById('edit-name').value = this.getAttribute('data-name');
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
                            formEliminar.action = `/pasante/categoria/destoy/${id}`;
                            formEliminar.submit();
                        }
                    });
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var dateInput = document.getElementById('date');
                var currentDate = new Date().toISOString().split('T')[0];
                dateInput.value = currentDate;
            });
        </script>
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'se ha realizado la acción correctamente.',
            });
        </script>
        @endif

        @endsection