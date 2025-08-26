@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
<li class="breadcrumb-item active">Seguimiento Resiembra</li>
@endpush

@section('content2')
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Seguimientos Resiembras</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Seguimientos de Resiembras</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Seguimiento
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="seguimientoresiembra" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Sistema Acuapónico</th>
                            <th>Resiembra</th>
                            <th>N° Plantas</th>
                            <th>Tonalidad</th>
                            <th>Altura (cm)</th>
                            <th>Tiempo (días)</th>
                            <th>Crecimiento</th>
                            <th>Mortalidad</th>
                            <th>Novedades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimiento_resiembra as $sr)
                        <tr class="table-light">
                            <td>{{ $n++ }}</td>
                            <td>{{ $sr->date }}</td>
                            <td>{{ $sr->aquaponicSystem->name ?? 'Sin sistema' }}</td>
                            <td>{{ $sr->resowing->crops->species->name ?? 'Sin cultivo' }}</td>
                            <td>{{ $sr->plant_count }}</td>
                            <td>
                                <span class="color-circle-large" style="background-color: {{ $sr->color_tone }};"></span>
                            </td>
                            <td>{{ $sr->height_cm }} cm</td>
                            <td>{{ $sr->days_elapsed }}</td>
                            <td>{{ $sr->growth }} cm</td>
                            <td>{{ $sr->mortality }}</td>
                            <td>{{ $sr->notes ?? 'Sin novedades' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form action="{{ route('acuaponico.pasante.pasante.storeresowingtracking') }}" method="POST">
                @csrf
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Nuevo Seguimiento Resiembra</h5>
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
                                    <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione el sistema</option>
                                        @foreach ($sistema as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="resowing_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-seedling mr-2"></i> Resiembra
                                    </label>
                                    <select name="resowing_id" id="resowing_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione una resiembra</option>
                                        @foreach ($resiembras as $r)
                                        <option value="{{ $r->id }}"
                                            data-system="{{ $r->aquaponic_system_id }}"
                                            data-date="{{ $r->date }}"
                                            data-total_quantity="{{ $r->total_quantity }}"
                                            data-status="{{ $r->status }}">
                                            {{ $r->crops->species->name ?? 'Sin cultivo' }} - {{ $r->status }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="plant_count" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-leaf mr-2"></i> N° Plantas
                                    </label>
                                    <input type="number" name="plant_count" class="form-control form-control-lg custom-input" id="plant_count" required>
                                    <div class="invalid-feedback" id="error-plantas"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-palette mr-2"></i> Tonalidad de la Planta
                                    </label>
                                    <div class="d-flex gap-4 justify-content-center">
                                        @php
                                        $colores = [
                                            '#138713ff', // Verde oscuro
                                            '#a6d842ff', // Verde amarillento
                                            '#32dc32ff', // Verde claro
                                            '#1ccf00ff' // Verde normal
                                        ];
                                        @endphp
                                        @foreach($colores as $color)
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="color_tone" value="{{ $color }}" required style="margin-right: 5px;">
                                            <span class="color-circle-large" style="background-color: {{ $color }};"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="height_cm" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-ruler-vertical mr-2"></i> Altura (cm)
                                    </label>
                                    <input type="number" name="height_cm" class="form-control form-control-lg custom-input" id="height_cm" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="days_elapsed" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-clock mr-2"></i> Tiempo (días)
                                    </label>
                                    <input type="number" name="days_elapsed" class="form-control form-control-lg custom-input" id="days_elapsed" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="growth" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-chart-line mr-2"></i> Crecimiento
                                    </label>
                                    <input type="number" name="growth" class="form-control form-control-lg custom-input" id="growth" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="mortality" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-skull-crossbones mr-2"></i> Mortalidad
                                    </label>
                                    <input type="number" name="mortality" class="form-control form-control-lg custom-input" id="mortality" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="notes" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sticky-note mr-2"></i> Novedades
                                    </label>
                                    <textarea name="notes" class="form-control form-control-lg custom-textarea" id="notes"></textarea>
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
</div>

<!-- Estilos inline para los círculos de color (opcional, puedes mover a custom-styles.css) -->
<style>
    .color-circle-large {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-block;
        margin-left: 5px;
        border: 2px solid #000;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked + .color-circle-large {
        border: 3px solid #000;
    }

    .color-circle-large:hover {
        transform: scale(1.1);
        border-color: #555;
    }
</style>

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
        $('#seguimientoresiembra').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Establecer la fecha actual
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Filtrar resiembras por sistema acuapónico
        const systemSelect = document.getElementById('aquaponic_system_id');
        const resowingSelect = document.getElementById('resowing_id');
        const allOptions = Array.from(resowingSelect.options).slice(1);

        systemSelect.addEventListener('change', function() {
            const selectedSystemId = this.value;
            resowingSelect.innerHTML = '<option value="">Seleccione una resiembra</option>';
            allOptions.forEach(option => {
                if (option.getAttribute('data-system') === selectedSystemId) {
                    resowingSelect.appendChild(option.cloneNode(true));
                }
            });
            document.getElementById('days_elapsed').value = '';
            document.getElementById('growth').value = '';
            document.getElementById('mortality').value = '';
        });

        // Calcular días transcurridos
        function calculateDaysElapsed(resowingDate, dateInputId, daysInputId) {
            const dateInput = document.getElementById(dateInputId);
            const daysInput = document.getElementById(daysInputId);
            if (!resowingDate || !dateInput.value) {
                daysInput.value = '';
                return;
            }
            try {
                const fechaInicio = new Date(resowingDate);
                const fechaSeleccionada = new Date(dateInput.value);
                if (isNaN(fechaInicio) || isNaN(fechaSeleccionada)) {
                    daysInput.value = '';
                    return;
                }
                const diffTiempo = fechaSeleccionada - fechaInicio;
                const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));
                daysInput.value = Math.max(0, diffDias);
            } catch (error) {
                daysInput.value = '';
            }
        }

        // Actualizar campos calculados
        function updateCalculatedFields() {
            const plantCountInput = document.getElementById('plant_count');
            const heightInput = document.getElementById('height_cm');
            const growthInput = document.getElementById('growth');
            const mortalityInput = document.getElementById('mortality');
            const errorDiv = document.getElementById('error-plantas');
            const resowingSelect = document.getElementById('resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const totalQuantity = parseInt(selectedOption?.getAttribute('data-total_quantity')) || 0;
            const resowingStatus = selectedOption?.getAttribute('data-status');

            const plantCount = parseInt(plantCountInput.value) || 0;
            const heightCm = parseFloat(heightInput.value) || 0;

            // Validar plant_count
            if (plantCount > totalQuantity) {
                plantCountInput.classList.add('is-invalid');
                errorDiv.textContent = `El número de plantas no puede exceder la cantidad resembrada total (${totalQuantity}).`;
                return false;
            } else {
                plantCountInput.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }

            // Calcular crecimiento
            let growth = 0;
            if (resowingStatus === 'Seguimiento' && window.previousTracking) {
                const previousHeight = parseFloat(window.previousTracking.height_cm) || 0;
                growth = heightCm - previousHeight;
            } else {
                growth = heightCm;
            }
            growth = Math.max(0, growth);
            growthInput.value = growth.toFixed(2);

            // Calcular mortalidad
            let mortality = 0;
            let previousPlantCount = totalQuantity;
            if (resowingStatus === 'Seguimiento' && window.previousTracking) {
                previousPlantCount = parseInt(window.previousTracking.plant_count) || totalQuantity;
            }
            mortality = previousPlantCount - plantCount;
            mortality = Math.max(0, mortality);
            mortalityInput.value = mortality;

            return true;
        }

        // Escuchar cambios en resowing_id
        resowingSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaResiembra = selectedOption.getAttribute('data-date');
            const totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
            document.getElementById('growth').value = '';
            document.getElementById('mortality').value = '';
            window.totalQuantity = totalQuantity;
            window.initialPlantCount = totalQuantity;

            if (this.value) {
                fetch(`{{ url('/pasante/seguimiento_resiembra/previous') }}/${this.value}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    window.previousTracking = data.previousTracking;
                    window.totalQuantity = data.total_quantity;
                    window.initialPlantCount = data.total_quantity;
                    updateCalculatedFields();
                })
                .catch(error => {
                    window.previousTracking = null;
                    updateCalculatedFields();
                });
            }
        });

        // Escuchar cambios en plant_count y height_cm
        ['plant_count', 'height_cm'].forEach(field => {
            document.getElementById(field).addEventListener('input', updateCalculatedFields);
        });

        // Validar formulario antes de enviar
        document.querySelector('#agregar form').addEventListener('submit', function(e) {
            if (!updateCalculatedFields()) {
                e.preventDefault();
            }
        });

        // Forzar cálculo al abrir el modal
        document.querySelector('#agregar').addEventListener('show.bs.modal', function() {
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
            updateCalculatedFields();
        });
    });
</script>
@endsection
@endsection