@extends('acuaponico::layouts.masterpa')

@section('content2')
<div class="container mt-4">
    <h2 class="text-center mb-4">Actividades Recibidas</h2>
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table id="tabla-actividad" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>#</th>
                        <th>Actividad</th>
                        <th>Aprendiz</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Evidencia</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach($activities as $activity)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $activity->activity_name}}</td>
                        <td>{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
                        <td>{{ $activity->date }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#agregar{{ $activity->id }}">
                                <i class="bi bi-plus-circle"></i> + Evidencia
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Agregar Evidencia -->
                    <div class="modal fade" id="agregar{{ $activity->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('acuaponico.pasante.pasante.storecontrolactivity') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Agregar Evidencia</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Actividad:</label>
                                            <input type="text" class="form-control" value="{{ $activity->activity_name }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label>Fecha:</label>
                                            <input type="date" name="date" class="form-control date-input" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label>Novedades:</label>
                                            <textarea name="news" class="form-control"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Subir Evidencia (PDF):</label>
                                            <input type="file" name="evidence" class="form-control" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="container mt-5">
    <h3 class="text-center mb-4">Evidencias Registradas</h3>
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table id="tabla-evidencia" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>#</th>
                        <th>Actividad</th>
                        <th>Fecha</th>
                        <th>Novedades</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 1; @endphp
                    @foreach($evidencias as $evidencia)
                    <tr>
                        <td>{{ $n++ }}</td>
                        <td>{{ $evidencia->activity->activity_name  }}</td>
                        <td>{{ $evidencia->date }}</td>
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
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#verPdfModal{{ $evidencia->id }}">
                                <i class="bi bi-eye"></i>
                                ver PDF
                            </button>
                            @endif

                            <!-- Botón editar -->
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $evidencia->id }}">
                                <i class="bi bi-pencil"></i> Editar
                            </button>

                            <!-- Botón eliminar -->
                            <button class="btn btn-sm btn-danger btnEliminar" data-url="{{ route('acuaponico.pasante.pasante.destroycontrolactivity', $evidencia->id) }}">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>


                        </td>
                    </tr>

                    <!-- Modal Ver PDF -->
                    <div class="modal fade" id="verPdfModal{{ $evidencia->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Evidencia PDF</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="{{ route('evidencia.ver', $evidencia->id) }}" width="100%" height="600px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar -->
                    <div class="modal fade" id="editarModal{{ $evidencia->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('acuaponico.pasante.pasante.updatecontrolactivity', $evidencia->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white">Editar Evidencia</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Fecha:</label>
                                            <input type="date" name="date" class="form-control" value="{{ $evidencia->date }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Novedades:</label>
                                            <textarea name="news" class="form-control">{{ $evidencia->news }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Actualizar PDF:</label>
                                            <input type="file" name="evidence" class="form-control" accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Guardar Cambios</button>
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Eliminar -->
<form id="formEliminar" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>


<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.date-input');
        const today = new Date().toISOString().slice(0, 10);
        inputs.forEach(input => input.value = today);
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session("success") }}',
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
    });
</script>
@endif


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#tabla-actividad').DataTable({
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


        $('#tabla-evidencia').DataTable({
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

<script>
    document.querySelectorAll('.btnEliminar').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción eliminará la evidencia!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('formEliminar');
                    form.action = url;
                    form.submit();
                }
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection