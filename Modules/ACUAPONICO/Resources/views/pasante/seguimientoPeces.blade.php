@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Seguimientos Peces</li>
@endpush

@section('content2')
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Seguimientos Peces</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Seguimientos</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Seguimiento
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="seguimientopeztable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Cultivo</th>
                            <th>N° Peces</th>
                            <th>Peso (gr)</th>
                            <th>Biomasa (gr)</th>
                            <th>Ganancia de peso (gr)</th>
                            <th>Mortalidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimientoPez as $sp)
                        <tr class="table-light">
                            <td>{{ $n++ }}</td>
                            <td>{{ $sp->Tracking->date }}</td>
                            <td>{{ $sp->Tracking->crops->species->name }}</td>
                            <td>{{ $sp->fish_count }}</td>
                            <td>{{ $sp->weight_gr }} gr</td>
                            <td>{{ $sp->biomass_gr }} gr</td>
                            <td>{{ $sp->weight_gain_gr }} gr</td>
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
            <form action="{{ route('acuaponico.pasante.pasante.storetrackingfish') }}" method="POST">
                @csrf
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Nuevo Seguimiento Peces</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="tracking_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-seedling mr-2"></i> Cultivo en seguimiento
                                    </label>
                                    <select name="tracking_id" id="tracking_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione un seguimiento</option>
                                        @foreach ($seguimientos as $seguimiento)
                                        <option value="{{ $seguimiento->id }}"
                                            data-peces="{{ optional($seguimiento->latestFishTracking)->fish_count ?? $seguimiento->crops->quantity }}"
                                            data-peso="{{ optional($seguimiento->latestFishTracking)->weight_gr ?? 0 }}">
                                            {{ $seguimiento->crops->species->name }} - {{ $seguimiento->date }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="fish_count" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-fish mr-2"></i> N° Peces
                                    </label>
                                    <input type="number" name="fish_count" class="form-control form-control-lg custom-input" id="fish_count" required>
                                    <div class="invalid-feedback" id="error-peces"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="weight_gr" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-weight mr-2"></i> Peso Promedio (gr)
                                    </label>
                                    <input type="number" name="weight_gr" class="form-control form-control-lg custom-input" id="weight_gr" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="biomass_gr" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-balance-scale mr-2"></i> Biomasa (gr)
                                    </label>
                                    <input type="number" name="biomass_gr" class="form-control form-control-lg custom-input" id="biomass_gr" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="weight_gain_gr" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-chart-line mr-2"></i> Ganancia de peso (gr)
                                    </label>
                                    <input type="number" name="weight_gain_gr" class="form-control form-control-lg custom-input" id="weight_gain_gr" readonly>
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

<!-- Script para calcular biomasa, ganancia de peso y mortalidad -->
<script>
    let pecesPrevios = 0;
    let pesoPrevio = 0;

    document.getElementById('tracking_id').addEventListener('change', function() {
        const trackingId = this.value;

        if (trackingId) {
            fetch(`/pasante/seguimientoPez/prevdata/${trackingId}`)
                .then(response => response.json())
                .then(data => {
                    pecesPrevios = parseInt(data.peces) || 0;
                    pesoPrevio = parseFloat(data.peso) || 0;
                    calcularCampos();
                });
        }
    });

    document.getElementById('fish_count').addEventListener('input', calcularCampos);
    document.getElementById('weight_gr').addEventListener('input', calcularCampos);

    function calcularCampos() {
        const pecesActuales = parseInt(document.getElementById('fish_count').value) || 0;
        const pesoActual = parseFloat(document.getElementById('weight_gr').value) || 0;

        const inputPeces = document.getElementById('fish_count');
        const errorMsg = document.getElementById('error-peces');

        if (pecesActuales > pecesPrevios) {
            inputPeces.classList.add('is-invalid');
            errorMsg.innerText = `No puede ingresar más peces (${pecesActuales}) que los registrados anteriormente (${pecesPrevios}).`;
        } else {
            inputPeces.classList.remove('is-invalid');
            errorMsg.innerText = '';
        }

        document.getElementById('biomass_gr').value = (pesoActual * pecesActuales).toFixed(2);
        document.getElementById('weight_gain_gr').value = (pesoActual - pesoPrevio).toFixed(2);
        document.getElementById('mortality').value = (pecesPrevios - pecesActuales > 0 ? pecesPrevios - pecesActuales : 0);
    }
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
        $('#seguimientopeztable').DataTable({
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