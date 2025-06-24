@extends('acuaponico::layouts.master')

@section('content')
<style>
    table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
</style>
<div class="container">
    <br>
    <h2 class="text-justify text-center mt-4" 
        style="font-size: 54px; font-family:'Savate', sans-serif; font-optical-sizing: auto; font-weight: 400;
        font-style: normal;">Gestión de Usuarios</h2>
    <div class="mt-4">
        <div class="border-bottom"></div>
    </div>

    <div class="row mt-4">
        {{-- Columna izquierda: Formulario --}}
        <div class="col-md-8">
            <form action="{{ route('acuaponico.admin.admin.storeUsuarios') }}" method="POST" class="mb-6">
                @csrf
                <div class="shadow p-4 rounded bg-light">
                    <h4 class="text-center mb-4">Agregar Nuevo Usuario</h4>

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <input type="text" name="first_name" class="form-control form-control-lg" placeholder="Ingresa el Nombre" required>
                        </div>

                        {{-- Apellidos --}}
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Apellidos</label>
                            <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Ingresa los Apellidos" required>
                        </div>

                        {{-- Rol --}}
                        <div class="col-md-6 mb-3">
                            <label for="opciones" class="form-label">Rol</label>
                            <select name="role" class="form-select form-select-lg" required id="opciones">
                                <option value="" disabled selected>Seleccione un rol</option>
                                <option value="pasante">Pasante</option>
                                <option value="instructor">Instructor</option>
                            </select>
                        </div>

                        {{-- Unidad Productiva --}}
                        <div class="col-md-6 mb-3">
                            <label for="productive_unit_id" class="form-label">Unidad Productiva</label>
                            <select name="productive_unit_id" class="form-select form-select-lg" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Botón --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg px-5">Agregar</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Columna derecha: tarjetas --}}
        <div class="col-md-4 d-flex flex-column align-items-end">
            {{-- Tarjetas de resumen --}}
            <div class="d-flex flex-column h-100" style="max-width: 300px; width: 100%;">
                {{-- Tarjeta de unidades productivas --}}
                {{-- Tarjeta de usuarios registrados --}}
                <div onclick="scrollToTable()" class="card shadow mb-4 flex-fill" style="background-color: hsl(176, 100%, 51%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong>{{ $totalCount }}</strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Usuarios registrados</h6>
                            <i class="fa fa-users fa-lg"></i>
                        </div>
                    </div>
                </div>

                {{-- Tarjeta de pasantes --}}
                <div onclick="scrollToTable()" class="card shadow mb-3 flex-fill" style="background-color: hsl(131, 100%, 77%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong>{{ $pasantesCount }}</strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Pasantes</h6>
                            <i class="fa fa-user-graduate fa-lg"></i>
                        </div>
                    </div>
                </div>

                {{-- Tarjeta de instructores --}}
                <div onclick="scrollToTable()" class="card shadow flex-fill" style="background-color: hsl(77, 92%, 90%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong>{{ $instructorCount }}</strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Instructores</h6>
                            <i class="fa fa-chalkboard-teacher fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h1 class="mt-5 border-bottom"></h1>
    </div>



{{-- Encabezado y búsqueda --}}
<div class="container mt-5">
    <h1 class="text-center text-secondary border-bottom pb-2">Lista de usuarios</h1>

    <div class="d-flex justify-content-end align-items-center mt-3 mb-3">
        <label for="busqueda" class="me-2 fw-semibold text-secondary">Buscar:</label>
        <input type="text" id="busqueda" class="form-control w-25" placeholder="Búsqueda..." onkeyup="filtrarTabla()">
    </div>

    {{-- Tabla de usuarios --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabla-usuarios">
            <thead class="table-primary">
                <tr> 
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Unidad Productiva</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $index => $usuario)
                <tr">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usuario->first_name }}</td>
                    <td>{{ $usuario->last_name }}</td>
                    <td>{{ ucfirst($usuario->role) }}</td>
                    <td>{{ $usuario->productiveUnit->name ?? 'No asignado' }}</td>
                    <td>{{ ucfirst($usuario->status) }}</td>
                    <td>
                        {{-- Botón Editar --}}
                        <a data-bs-toggle="modal" data-bs-target="#editModal{{ $usuario->id }}" title="Editar" class="text-dark me-3">
                            <i class="fas fa-pencil-alt" style="font-size: 1.2rem;"></i>
                        </a>

                        {{-- Botón Eliminar --}}
                        <form action="{{ route('acuaponico.admin.admin.destroyUsuarios', $usuario->id) }}" 
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-delete" title="Eliminar" data-user-id="{{ $usuario->id }}">
                                <i class="fas fa-trash" style="font-size: 1.2rem;"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                    {{-- Modal de edición --}}
                    <div class="modal fade" id="editModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $usuario->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('acuaponico.admin.admin.updateUsuarios', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title w-100 text-center">Realiza cambios</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">Nombre</label>
                                            <input type="text" name="first_name" class="form-control" value="{{ $usuario->first_name }}" required style="height: 50px; width: 45%">
                                        </div>
                                        <div class="mb-3" style="margin-left: 54%; margin-top: -21%;">
                                            <label for="last_name" class="form-label">Apellidos</label>
                                            <input type="text" name="last_name" class="form-control" value="{{ $usuario->last_name }}" required style="height: 50px; width: 100%;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Rol</label>
                                            <select name="role" class="form-select" required>
                                                <option value="pasante" {{ $usuario->role == 'pasante' ? 'selected' : '' }}>Pasante</option>
                                                <option value="instructor" {{ $usuario->role == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productive_unit_id" class="form-label">Unidad Productiva</label>
                                            <select name="productive_unit_id" class="form-select"  style="width: 45%; height: 50px;" required>
                                                <option value="">-- Seleccione --</option>
                                                @foreach($unidades as $unidad)
                                                    <option value="{{ $unidad->id }}" {{ $usuario->productive_unit_id == $unidad->id ? 'selected' : '' }}>
                                                        {{ $unidad->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3" style="margin-left: 55%; margin-top: -21%;">
                                            <label for="status" class="form-label" >Estado</label>
                                            <select name="status" class="form-select" required style="height: 50px;">
                                                <option value="activo" {{ $usuario->status == 'activo' ? 'selected' : '' }}>Activo</option>
                                                <option value="inactivo" {{ $usuario->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
            {{-- Texto con el estado de paginación --}}
            <div class="text-muted small">
                Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios
            </div>

            {{-- Controles de paginación --}}
            <div>
                {{ $usuarios->links('pagination::bootstrap-4') }}
            </div>
        </div>
            </div>
        </div>

        <div class="mt-5 mb-5">
            <div class="border-bottom"></div>
        </div>
        
        <footer class="bg-white text-dark border-top mt-5 pt-4">
            <div class="container small">
                <div class="row gy-4 text-center text-md-start">
                    {{-- Información del sistema --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Sistema de Gestión ACUAPONICO</h6>
                        <p class="mb-1">Administra usuarios, unidades productivas y roles.</p>
                        <p class="mb-0 text-muted">Construido con Laravel & Bootstrap 5.</p>
                    </div>

                    {{-- Información del desarrollador --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Desarrollado por</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">Juan Sebastian Guzman Hernandez</li>
                            <li class="mb-1">
                                <a href="mailto:guzmanhernandezj603@gmail.com" class="text-decoration-none text-dark">
                                    guzmanhernandezj603@gmail.com
                                </a>
                            </li>
                            <li class="mb-0">
                                <a href="tel:‪+573005954563‬" class="text-decoration-none text-dark">
                                    ‪+57 300 595 4563‬
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Enlaces adicionales --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Más información</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a href="#" class="text-decoration-none text-dark">Política de privacidad</a></li>
                            <li><a href="#" class="text-decoration-none text-dark">Términos de uso</a></li>
                            <li><a href="#" class="text-decoration-none text-dark">Soporte técnico</a></li>
                        </ul>
                    </div>
                </div>

                <hr class="my-4">

                <div class="text-center text-muted pb-2">
                    &copy; {{ date('Y') }} ACUAPONICO. Todos los derechos reservados.
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- script para filtrar la tabla --}}
        <script>
            function filtrarTabla() {
                const input = document.getElementById("busqueda");
                const filter = input.value.toLowerCase();
                const rows = document.querySelectorAll("table tbody tr");

                rows.forEach(row => {
                    const nombre = row.cells[1].textContent.toLowerCase();
                    const apellidos = row.cells[2].textContent.toLowerCase();
                    const rol = row.cells[3].textContent.toLowerCase();

                    if (nombre.includes(filter) || apellidos.includes(filter) || rol.includes(filter)) {
                        row.style.display = "";
                    } else {
                            row.style.display = "none";
                        }
                    });
                }


                //scroll
                function scrollToTable() {
                    const tabla = document.getElementById("tabla-usuarios");
                    if (tabla) {
                        tabla.scrollIntoView({ behavior: "smooth" });
                    }
                }


                //Modal de confirmación de eliminación
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('form');
                        const userId = this.getAttribute('data-user-id');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡Esta acción eliminará el usuario permanentemente!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                })
            </script>

            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session("success") }}',
                    showConfirmButton: false,
                    timer: 3000,
                    position: 'center'
                });
            </script>
            @endif

            @if(session('info'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Información',
                    text: '{{ session("info") }}',
                    showConfirmButton: false,
                    timer: 3000,
                    position: 'center'
                });
            </script>
            @endif
            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session("success") }}',
                    showConfirmButton: false,
                    timer: 2500,
                    position: 'center'
                });
            </script>
            @endif
            @if(session('successDelete'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session("successDelete") }}',
                    showConfirmButton: false,
                    timer: 2500,
                    position: 'center'
                });
            </script>
            @endif
            @if ($errors->any())
            <script>
                swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Caracteres no válidos o campos incompletos.',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            @endif
            @if(session('delete_error'))
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: '{{ session("delete_error") }}',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            @endif
            @if(session('error'))
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: 'El usuario ya existe',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            @endif
            @if(session('error'))
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: 'Ya existe este usuario con el mismo rol y unidad productiva',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            @endif
        </div>
    </div>
</div>

@endsection