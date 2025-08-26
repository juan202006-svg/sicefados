@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
<li class="breadcrumb-item active">Seguimientos generales</li>
@endpush

@section('content2')
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Gestión de Seguimientos</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Seguimientos</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Seguimiento
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="seguimientosTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Sistema Acuapónico</th>
                            <th>Fecha</th>
                            <th>Cultivo</th>
                            <th>Tiempo (días)</th>
                            <th>Novedades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimientos as $seguimiento)
                        <tr class="table-light">
                            <td>{{ $n++ }}</td>
                            <td>{{ $seguimiento->crops->aquaponicSystem->name}}</td>
                            <td>{{ $seguimiento->date }}</td>
                            <td>{{ $seguimiento->crops->species->name }}</td>
                            <td>{{ $seguimiento->days_elapsed }}</td>
                            <td>{{ $seguimiento->notes }}</td>
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="{{ route('acuaponico.pasante.pasante.storetracking') }}" method="POST">
            @csrf
            <div class="modal-content border-0 rounded-lg shadow-lg">
                <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                    <h5 class="modal-title font-weight-bold" id="agregarLabel">Nuevo Seguimiento</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5 bg-white rounded-bottom">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="date" class="form-label text-dark font-weight-bold custom-form-label">
                                    <i class="fas fa-calendar-alt mr-2"></i> Fecha
                                </label>
                                <input type="date" name="date" class="form-control form-control-lg custom-input" id="date" readonly>
                            </div>
                            <div class="form-group mb-4">
                                <label for="aquaponic_system_id" class="form-label text-dark font-weight-bold custom-form-label">
                                    <i class="fas fa-water mr-2"></i> Sistema Acuapónico
                                </label>
                                <select id="aquaponic_system_id" name="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                    <option value="">Seleccione un sistema acuapónico</option>
                                    @foreach ($acuaponicos as $acuaponico)
                                    <option value="{{ $acuaponico->id }}">{{ $acuaponico->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="crop_id" class="form-label text-dark font-weight-bold custom-form-label">
                                    <i class="fas fa-seedling mr-2"></i> Cultivo
                                </label>
                                <select name="crop_id" id="crop_id" class="form-control form-control-lg custom-select" required>
                                    <option value="">Seleccione un cultivo</option>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}" data-date="{{ $cultivo->date }}" data-system="{{ $cultivo->aquaponic_system_id }}">
                                        {{ $cultivo->species->name ?? 'Sin cultivo' }} - {{ $cultivo->status }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="days_elapsed" class="form-label text-dark font-weight-bold custom-form-label">
                                    <i class="fas fa-clock mr-2"></i> Tiempo (días)
                                </label>
                                <input type="number" name="days_elapsed" class="form-control form-control-lg custom-input" id="days_elapsed" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="notes" class="form-label text-dark font-weight-bold custom-form-label">
                                    <i class="fas fa-sticky-note mr-2"></i> Novedades
                                </label>
                                <textarea name="notes" class="form-control form-control-lg custom-textarea" id="notes" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-4 rounded-bottom">
                    <button type="button" class="btn btn-secondary btn-lg rounded-pill px-4" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">

<!-- Script para establecer la fecha actual en el campo de fecha -->
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

        // Configurar dependencia entre sistema y cultivo
        setupSystemCropDependency('aquaponic_system_id', 'crop_id', 'days_elapsed');

        // Calcular días transcurridos al cambiar cultivo
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