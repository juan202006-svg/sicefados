@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
<li class="breadcrumb-item active">Seguimientos Plantas</li>
@endpush

@section('content2')
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Seguimientos Plantas</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Seguimientos Plantas</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Seguimiento
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="seguimientoplantatable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Sistema Acuapónico</th>
                            <th>Cultivo</th>
                            <th>N° Plantas</th>
                            <th>Altura (cm)</th>
                            <th>Tonalidad</th>
                            <th>Crecimiento</th>
                            <th>Mortalidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimientoPlanta as $sp)
                        <tr class="table-light">
                            <td>{{ $n++ }}</td>
                            <td>{{ $sp->Tracking->date }}</td>
                            <td>{{ $sp->Tracking->aquaponicSystem->name ?? 'Sin sistema' }}</td>
                            <td>{{ $sp->Tracking->crops->species->name }}</td>
                            <td>{{ $sp->plant_count }}</td>
                            <td>{{ $sp->height_cm }} cm</td>
                            <td>
                                <span class="color-circle-large" style="background-color: {{ $sp->color_tone }};"></span>
                            </td>
                            <td>{{ $sp->growth }} cm</td>
                            <td>{{ $sp->mortality }}</td>
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
            <form action="{{ route('acuaponico.pasante.pasante.storetrackingplant') }}" method="POST">
                @csrf
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Nuevo Seguimiento Plantas</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="aquaponic_system_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-water mr-2"></i> Sistema Acuapónico
                                    </label>
                                    <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione un sistema</option>
                                        @foreach ($aquaponicSystems as $system)
                                        <option value="{{ $system->id }}">{{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="tracking_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-seedling mr-2"></i> Cultivo en seguimiento
                                    </label>
                                    <select name="tracking_id" id="tracking_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione un seguimiento</option>
                                        <!-- Se cargará dinámicamente -->
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
                                    <label for="height_cm" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-ruler-vertical mr-2"></i> Altura (cm)
                                    </label>
                                    <input type="number" name="height_cm" class="form-control form-control-lg custom-input" id="height_cm" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-palette mr-2"></i> Tonalidad de la planta
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

<!-- Estilos inline para los círculos de color -->
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

<!-- Script para cargar seguimientos dinámicamente y calcular campos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const aquaponicSystemId = document.getElementById('aquaponic_system_id');
        if (aquaponicSystemId) {
            aquaponicSystemId.addEventListener('change', function() {
                const systemId = this.value;
                const trackingSelect = document.getElementById('tracking_id');
                if (trackingSelect) {
                    trackingSelect.innerHTML = '<option value="">Seleccione un seguimiento</option>';
                    if (systemId) {
                        fetch(`/pasante/seguimientoPlanta/seguimientos/${systemId}`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.text = `${item.crops.species.name} - ${item.date}`;
                                    option.setAttribute('data-date', item.date);
                                    trackingSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching seguimientos:', error));
                    }
                }
            });
        }

        let plantasPrevias = 0;
        let alturaPrevia = 0;

        const trackingIdSelect = document.getElementById('tracking_id');
        if (trackingIdSelect) {
            trackingIdSelect.addEventListener('change', function() {
                const trackingId = this.value;
                if (trackingId) {
                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                        .then(res => res.json())
                        .then(data => {
                            plantasPrevias = parseInt(data.plantas) || 0;
                            alturaPrevia = parseFloat(data.altura) || 0;
                            calcularAgregar();
                        })
                        .catch(error => console.error('Error fetching prev data:', error));
                }
            });

            document.getElementById('plant_count')?.addEventListener('input', calcularAgregar);
            document.getElementById('height_cm')?.addEventListener('input', calcularAgregar);

            function calcularAgregar() {
                const plantCount = document.getElementById('plant_count');
                const heightCm = document.getElementById('height_cm');
                const growth = document.getElementById('growth');
                const mortality = document.getElementById('mortality');
                const errorPlantas = document.getElementById('error-plantas');

                if (!plantCount || !heightCm || !growth || !mortality || !errorPlantas) {
                    console.error('Uno o más elementos del DOM no están disponibles.');
                    return;
                }

                const actuales = parseInt(plantCount.value) || 0;
                const alturaActual = parseFloat(heightCm.value) || 0;

                growth.value = (alturaActual - alturaPrevia).toFixed(2);
                mortality.value = (plantasPrevias - actuales > 0 ? plantasPrevias - actuales : 0);

                if (actuales > plantasPrevias) {
                    plantCount.classList.add('is-invalid');
                    plantCount.classList.remove('is-valid');
                    errorPlantas.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${plantasPrevias})`;
                } else {
                    plantCount.classList.remove('is-invalid');
                    plantCount.classList.add('is-valid');
                    errorPlantas.innerText = '';
                }
            }
        }
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
        $('#seguimientoplantatable').DataTable({
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