@extends('acuaponico::layouts.master')

@push('breadcrumbs')
<li class="breadcrumb-item active">Seguimientos generales</li>
@endpush
@section('content8')
<h1 class="fw-bold mb-4">Gestión de Seguimientos</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Seguimientos</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo seguimiento
            </button>
        </div>
        <div class="table-responsive">
            <table id="seguimientosTable" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
                        <th>S/acuaponico</th>
                        <th>Fecha</th>
                        <th>Cultivo</th>
                        <th>Tiempo dias</th>
                        <th>Novedades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach ($seguimientos as $seguimiento)
                    <tr>
                        <td class="text-center">{{ $n++ }}</td>
                        <td class="text-center">{{ $seguimiento->crops->aquaponicSystem->name ?? 'Sin sistema'}}</td>
                        <td class="text-center">{{ $seguimiento->date }}</td>
                        <td class="text-center">{{ $seguimiento->crops->species->name ?? 'Sin cultivo' }}</td>
                        <td class="text-center">{{ $seguimiento->days_elapsed }}</td>
                        <td class="text-center">{{ $seguimiento->notes }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="{{ $seguimiento->id }}"
                                date-aquaponic_system_id="{{ $seguimiento->aquaponic_system_id }}"
                                data-date="{{ $seguimiento->date }}"
                                data-crop_id="{{ $seguimiento->crop_id }}"
                                data-days_elapsed="{{ $seguimiento->days_elapsed }}"
                                data-notes="{{ $seguimiento->notes }}"
                                data-toggle="modal"
                                data-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $seguimiento->id }}">
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
                    <form id="formEditar" action="{{route ('acuaponico.pasante.pasante.updatetracking',0)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Seguimiento</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                                <label for="edit-aquaponic_system_id">S/acuaponico:</label>
                                <select id="edit-aquaponic_system_id" name="aquaponic_system_id" class="form-control" required>
                                    <option value="">Seleccione un sistema acuapónico</option>
                                    @foreach ($acuaponicos as $acuaponico)
                                    <option value="{{ $acuaponico->id }}">{{ $acuaponico->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-crop_id" class="form-label">Cultivo:</label>
                                <select class="form-control" id="edit-crop_id" name="crop_id" required>
                                    <option value="">Seleccione un cultivo</option>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}" data-date="{{ $cultivo->date }}"
                                        data-system="{{ $cultivo->aquaponic_system_id }}">{{ $cultivo->species->name ?? 'no hay cultivos' }} - {{
                                        $cultivo->status }}</option>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-days_elapsed" class="form-label"> Tiempo en dias: </label>
                                <input type="number" class="form-control" id="edit-days_elapsed" name="days_elapsed" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-notes" class="form-label"> Novedad: </label>
                                <textarea class="form-control" name="notes" id="edit-notes"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
        <form action="{{route ('acuaponico.pasante.pasante.storetracking') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="aquaponic_system_id">S/acuaponico:</label>
                        <select id="aquaponic_system_id" name="aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione un sistema acuapónico</option>
                            @foreach ($acuaponicos as $acuaponico)
                            <option value="{{ $acuaponico->id }}">{{ $acuaponico->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="crop_id">Cultivo:</label>
                        <select name="crop_id" id="crop_id" class="form-control" required>
                            <option value="">Seleccione un cultivo</option>
                            @foreach ($cultivos as $cultivo)
                            <option
                                value="{{ $cultivo->id }}"
                                data-date="{{ $cultivo->date }}"
                                data-system="{{ $cultivo->aquaponic_system_id }}">
                                {{ $cultivo->species->name?? 'no hay cultivos' }} - {{
                                        $cultivo->status }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label for="days_elapsed" class="form-label">Tiempo en dias:</label>
                        <input type="number" name="days_elapsed" class="form-control" id="days_elapsed" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Novedad:</label>
                        <textarea name="notes" class="form-control" id="notes" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
                document.getElementById('formEditar').action = `/pasante/seguimiento/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-aquaponic_system_id').value = this.getAttribute('date-aquaponic_system_id');
                document.getElementById('edit-crop_id').value = this.getAttribute('data-crop_id');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');
            });
        });
    });
</script>
<!--script para mostrar los tiempos en dias en el campo al selecionar otro cultivo a la hora de editar-->
<script>
    document.getElementById('edit-crop_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fechaCultivo = selectedOption.getAttribute('data-date');

        if (fechaCultivo) {
            const fechaInicio = new Date(fechaCultivo);
            const fechaHoy = new Date();
            const diffTiempo = fechaHoy - fechaInicio;
            const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

            document.getElementById('edit-days_elapsed').value = diffDias;
        } else {
            document.getElementById('edit-days_elapsed').value = '';
        }
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
                    formEliminar.action = `/pasante/seguimiento/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<script>
    document.getElementById('crop_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fechaCultivo = selectedOption.getAttribute('data-date');

        if (fechaCultivo) {
            const fechaInicio = new Date(fechaCultivo);
            const fechaHoy = new Date();

            const diffTiempo = fechaHoy - fechaInicio;
            const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

            // Asignar al campo
            document.getElementById('days_elapsed').value = diffDias;
        } else {
            document.getElementById('days_elapsed').value = '';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function setupSystemCropDependency(systemSelectId, cropSelectId, daysInputId = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const cropSelect = document.getElementById(cropSelectId);
            if (!systemSelect || !cropSelect) return;

            // Guardar todas las opciones al iniciar
            const allOptions = Array.from(cropSelect.options).slice(1); // Omitir "Seleccione un cultivo"

            systemSelect.addEventListener('change', function() {
                const selectedSystemId = this.value;

                cropSelect.innerHTML = '<option value="">Seleccione un cultivo</option>';

                allOptions.forEach(option => {
                    if (option.getAttribute('data-system') === selectedSystemId) {
                        cropSelect.appendChild(option.cloneNode(true)); // importante: clonar para evitar remover de otros selects
                    }
                });

                if (daysInputId) {
                    const daysInput = document.getElementById(daysInputId);
                    if (daysInput) daysInput.value = '';
                }
            });
        }

        // Agregar (modal nuevo)
        setupSystemCropDependency('aquaponic_system_id', 'crop_id', 'days_elapsed');

        // Editar (modal editar)
        setupSystemCropDependency('edit-aquaponic_system_id', 'edit-crop_id', 'edit-days_elapsed');
    });
</script>



@section('scripts')
<script>
    $(document).ready(function() {
        $('#seguimientosTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            }
        });
    });
</script>
@endsection
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
@endsection