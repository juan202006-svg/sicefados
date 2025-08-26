@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Cosechas</li>
@endpush

@section('content2')
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Gestión de Cosechas</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Cosechas</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nueva Cosecha
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="cosecha" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>S/Acuapónico</th>
                            <th>Cultivo/Resiembra</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Unidad medida</th>
                            <th>Destino</th>
                            <th>Mortandad</th>
                            <th>Novedades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($cosechas as $ch)
                        <tr class="table-light">
                            <td>{{ $n++ }}</td>
                            <td>{{ $ch->aquaponicSystem->name ?? 'N/A' }}</td>
                            <td>
                                @if ($ch->harvestable instanceof \Modules\AGROCEFA\Entities\Crop)
                                {{ $ch->harvestable->species->name }} (Cultivo)
                                @elseif ($ch->harvestable instanceof \Modules\ACUAPONICO\Entities\Resowing)
                                {{ $ch->harvestable->crops->species->name ?? 'N/A' }} (Resiembra)
                                @else
                                N/A
                                @endif
                            </td>
                            <td>{{ $ch->date }}</td>
                            <td>{{ $ch->quantity }}</td>
                            <td>{{ $ch->unit }}</td>
                            <td>{{ $ch->destination }}</td>
                            <td>{{ $ch->mortality }}</td>
                            <td>{{ $ch->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ route('acuaponico.pasante.pasante.storeharvest') }}" method="POST">
                @csrf
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Nueva Cosecha</h5>
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
                                        <option value="">Seleccione un sistema</option>
                                        @foreach ($systems as $system)
                                        <option value="{{ $system->id }}">{{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="harvestable" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-leaf mr-2"></i> Cultivo o Resiembra
                                    </label>
                                    <select name="harvestable" id="harvestable" class="form-control form-control-lg custom-select" required>
                                        <option value="">Primero seleccione un sistema</option>
                                    </select>
                                    <input type="hidden" name="harvestable_id" id="harvestable_id">
                                    <input type="hidden" name="harvestable_type" id="harvestable_type">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="quantity" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sort-numeric-up mr-2"></i> Cantidad
                                    </label>
                                    <input type="number" name="quantity" class="form-control form-control-lg custom-input" id="quantity" step="0.01" required>
                                    <div class="invalid-feedback" id="error-peces" style="display:none;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="unit" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-ruler mr-2"></i> Unidad de medida
                                    </label>
                                    <select name="unit" id="unit" class="form-control form-control-lg custom-select" required>
                                        <option value="Gramos">Gramos</option>
                                        <option value="Kilogramos">Kilogramos</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="destination" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-map-marker-alt mr-2"></i> Destino
                                    </label>
                                    <input type="text" name="destination" class="form-control form-control-lg custom-input" id="destination" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="mortality" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-skull-crossbones mr-2"></i> Mortandad
                                    </label>
                                    <input type="number" name="mortality" class="form-control form-control-lg custom-input" id="mortality" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="notes" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sticky-note mr-2"></i> Novedad
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

<link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fecha actual para el modal agregar
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Función para cargar cultivos/resiembras
        function loadHarvestables(systemSelectId, harvestableSelectId, harvestableIdInputId, harvestableTypeInputId) {
            const systemSelect = document.getElementById(systemSelectId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const harvestableIdInput = document.getElementById(harvestableIdInputId);
            const harvestableTypeInput = document.getElementById(harvestableTypeInputId);

            systemSelect.addEventListener('change', function() {
                const systemId = this.value;
                harvestableSelect.innerHTML = '<option value="">Cargando...</option>';
                if (systemId) {
                    fetch(`{{ route('acuaponico.pasante.pasante.harvests.harvestables-by-system', '') }}/${systemId}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            harvestableSelect.innerHTML = '<option value="">Seleccione un cultivo o resiembra</option>';
                            data.forEach(item => {
                                harvestableSelect.innerHTML += `<option value="${item.type}|${item.id}" data-quantity="${item.quantity}">${item.name}</option>`;
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching harvestables:', error);
                            harvestableSelect.innerHTML = '<option value="">Error al cargar los datos</option>';
                        });
                } else {
                    harvestableSelect.innerHTML = '<option value="">Primero seleccione un sistema</option>';
                }
            });

            harvestableSelect.addEventListener('change', function() {
                const value = this.value;
                const mortalityInput = document.getElementById('mortality');
                const quantityInput = document.getElementById('quantity');
                if (value) {
                    const [type, id] = value.split('|');
                    harvestableTypeInput.value = type;
                    harvestableIdInput.value = id;
                    const quantity = parseFloat(this.selectedOptions[0].getAttribute('data-quantity')) || 0;
                    const inputQuantity = parseFloat(quantityInput.value) || 0;
                    mortalityInput.value = quantity - inputQuantity >= 0 ? quantity - inputQuantity : '';
                } else {
                    harvestableTypeInput.value = '';
                    harvestableIdInput.value = '';
                    mortalityInput.value = '';
                }
            });

            if (systemSelect.value) {
                systemSelect.dispatchEvent(new Event('change'));
            }
        }

        // Inicializar para el modal de agregar
        loadHarvestables('aquaponic_system_id', 'harvestable', 'harvestable_id', 'harvestable_type');

        // Validar cantidad y calcular mortalidad
        function validateQuantity(inputId, errorId, harvestableSelectId, mortalityId) {
            const input = document.getElementById(inputId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const errorDiv = document.getElementById(errorId);
            const mortality = document.getElementById(mortalityId);

            function calculate() {
                const quantity = parseFloat(harvestableSelect.options[harvestableSelect.selectedIndex]?.getAttribute('data-quantity') || 0);
                const cantidad = parseFloat(input.value) || 0;

                if (cantidad < 0 || isNaN(cantidad)) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = 'La cantidad debe ser un número válido mayor o igual a 0.';
                    mortality.value = '';
                } else if (cantidad > quantity) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = `No puedes ingresar más de ${quantity}.`;
                    mortality.value = '';
                } else {
                    input.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    mortality.value = quantity - cantidad >= 0 ? quantity - cantidad : '';
                }
            }

            harvestableSelect.addEventListener('change', calculate);
            input.addEventListener('input', calculate);
            calculate();
        }

        validateQuantity('quantity', 'error-peces', 'harvestable', 'mortality');
    });
</script>

<!-- Scripts para notificaciones -->
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
        $('#cosecha').DataTable({
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