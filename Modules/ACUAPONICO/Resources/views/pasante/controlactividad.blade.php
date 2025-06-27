@extends('acuaponico::layouts.masterpa')

@section('content2')
<div class="container mt-4">
    <h2 class="text-center mb-4">Actividades Resividas</h2>
    <a href="{{ route('acuaponico.pasante.pasante.indexactivity') }}"> </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Apprentice</th>
                <th>Date</th>
                <th>Description</th>
                <th>Evidencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $index => $activity)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
                <td>{{ $activity->date }}</td>
                <td>{{ $activity->description }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#agregar{{ $activity->id }}">
                        <i class="bi bi-plus-circle"></i> + Evidencia
                    </button>
                </td>
            </tr>

            <!-- Modal único por actividad -->
            <div class="modal fade" id="agregar{{ $activity->id }}" tabindex="-1" aria-labelledby="agregarLabel{{ $activity->id }}" aria-hidden="true">**
                <div class="modal-dialog">
                    <form action="{{ route('acuaponico.pasante.pasante.storecontrolactivity') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="agregarLabel{{ $activity->id }}">Agregar Evidencia</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Fecha:</label>
                                    <input type="date" name="date" class="form-control" id="date" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Actividad:</label>
                                    <input type="text" class="form-control" value="{{ $activity->description }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Novedades:</label>
                                    <textarea name="news" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Subir Evidencia (solo PDF):</label>
                                    <input type="file" name="evidence" class="form-control" accept="application/pdf" required>
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
        </tbody>
    </table>
</div>
@endforeach

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- lista de las evidencias  -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Evidencias Registradas</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Descripción Actividad</th>
                <th>Novedades</th>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evidencias as $index => $evidencia)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $evidencia->date }}</td>
                <td>{{ $evidencia->activity->description ?? 'Sin descripción' }}</td>
                <td>{{ $evidencia->news }}</td>
                <td>
                    @if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence))
                        <span class="text-success">PDF Subido</span>
                    @else
                        <span class="text-danger">No disponible</span>
                    @endif
                </td>
                <td>
                    @if($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence))
                        <!-- Botón para ver PDF -->
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#verPdfModal{{ $evidencia->id }}">
                            <i class="bi bi-eye"></i> Ver
                        </button>

                        <!-- Botón para descargar PDF -->
                        <a href="{{ asset('storage/' . $evidencia->evidence) }}" download class="btn btn-sm btn-outline-success">
                            <i class="bi bi-download"></i> Descargar
                        </a>

                        <!-- Modal para visualizar el PDF -->
                        <div class="modal fade" id="verPdfModal{{ $evidencia->id }}" tabindex="-1" aria-labelledby="verPdfLabel{{ $evidencia->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verPdfLabel{{ $evidencia->id }}">Evidencia PDF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe src="{{ asset('storage/' . $evidencia->evidence) }}" frameborder="0" width="100%" height="600px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="text-muted">Sin archivo</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
@endsection