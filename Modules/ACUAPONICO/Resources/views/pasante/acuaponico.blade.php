@extends('acuaponico::layouts.masterpa')
@push('breadcrumbs')
<li class="breadcrumb-item active">Sistemas Acuaponicos</li>
@endpush
@section('content2')

<h1 class="fw-bold mb-4">Gestión de sistemas Acuaponicos</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de sistemas acuaponicos</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo sistemas
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table id="acuaponicoTable" class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Ubicacion</th>
                            <th>Imagen</th>
                            <th>Capacidad de lotes</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($acuaponico as $item)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-center">
                                @if ($item->description)
                                <span>{{ $item->description }}</span>
                                @else
                                <span class="text-muted">Sin descripción</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->location }}</td>
                            <td class="text-center">
                                @if ($item->image)
                                <img src="{{ asset('modules/acuaponico/images/acuaponico/' . $item->image) }}" alt="Imagen de la especie" class="img-fluid" style="max-width: 100px; max-height: 100px;">

                                @else
                                <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->lot_capacity }}</td>
                            <td class="text-center">
                                @if($item->active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-description="{{ $item->description }}"
                                    data-location="{{ $item->location }}"
                                    data-image="{{ $item->image }}"
                                    data-lot_capacity="{{ $item->lot_capacity }}"
                                    data-active="{{ $item->active }}"
                                    data-toggle="modal"
                                    data-target="#editar">
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
        <!-- Modal Editar -->
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.acuaponicoupdate', 0) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Sistema Acuaponico</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="edit-name" name="name" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-description" class="form-label">Descripcion:</label>
                                <textarea class="form-control" id="edit-description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit-location" class="form-label">Ubicacion:</label>
                                <input type="text" class="form-control" id="edit-location" name="location">
                            </div>
                            <div class="mb-3 text-center">
                                <label class="form-label">Imagen actual:</label><br>
                                <img id="edit-preview-image" src="" alt="Imagen del sistema acuaponico" class="img-fluid mb-2" style="max-width: 100px; max-height: 100px;">
                            </div>
                            <div class="mb-3">
                                <label for="edit-image" class="form-label">Cambiar imagen:</label>
                                <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="edit-lot_capacity" class="form-label">Capacidad de lotes:</label>
                                <input type="number" class="form-control" id="edit-lot_capacity" name="lot_capacity">
                            </div>
                            <div class="form-group">
                                <label for="edit-active" class="form-label">Estado:</label>
                                <select class="form-control" id="edit-active" name="active">
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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

        <!-- Modal Agregar -->
        <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route ('acuaponico.pasante.pasante.acuaponicostore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="agregarLabel">Agregar Nuevo sistema</h5>
                            <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripcion:</label>
                                <textarea class="form-control" name="description"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicacion:</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen: </label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="lot_capacity" class="form-label">Capacidad de lotes:</label>
                                <input type="number" name="lot_capacity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="active" class="form-label">Estado:</label>
                                <select class="form-control" name="active" required>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>

        <!-- Script Modal Editar -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.editbtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        document.getElementById('formEditar').action = `/pasante/sistemas_acuaponicos/update/${id}`;
                        document.getElementById('edit-id').value = id;
                        document.getElementById('edit-name').value = this.getAttribute('data-name');
                        document.getElementById('edit-description').value = this.getAttribute('data-description');
                        document.getElementById('edit-location').value = this.getAttribute('data-location');

                        const image = this.getAttribute('data-image');
                        document.getElementById('edit-preview-image').src = image ? `/modules/acuaponico/images/acuaponico/${image}` : '';

                        document.getElementById('edit-lot_capacity').value = this.getAttribute('data-lot_capacity');
                        document.getElementById('edit-active').value = this.getAttribute('data-active');
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
                            formEliminar.action = `/pasante/sistemas_acuaponicos/destroy/${id}`;
                            formEliminar.submit();
                        }
                    });
                });
            });
        </script>
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
        @endif

        @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session("error") }}',
                    confirmButtonColor: '#d33',
                });
            });
        </script>
        @endif
        @section('scripts')
        <script>
            $(document).ready(function() {
                $('#acuaponicoTable').DataTable({
                    responsive: false,
                    autoWidth: false,
                    language: {
                        url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
                    }
                });
            });
        </script>
        @endsection

@endsection