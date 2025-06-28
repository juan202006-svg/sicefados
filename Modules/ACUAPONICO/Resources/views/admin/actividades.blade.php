@extends('acuaponico::layouts.master')

@section('content3')
<div class="container mt-4">
    <h2 class="text-center mb-4" style="font-family: 'Noto Sans', sans-serif; font-weight: 600;">
        Activity List
    </h2>

    {{-- FORMULARIO DE CREACIÓN --}}
    <form action="{{ route('acuaponico.admin.admin.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-2">
                <label>Nombre de la actividad:</label>
                <input type="text" name="activity_name" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label>Apprentice:</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Date:</label>
                <input type="date" name="date" id="date" class="form-control" readonly>
            </div>
            <div class="col-md-2">
                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label>End Date:</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="col-md-3 mt-2">
                <label>Estado :</label>
                <select name="activity_status" class="form-control">
                    <option value="Pendiente">Pendiente</option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Create Activity</button>
            </div>
        </div>
    </form>

    <hr>

    {{-- TABLA DE ACTIVIDADES --}}
    <div class="table-responsive">
        <table id="tabla-actividad" class="table table-hover table-bordered align-middle text-center">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th>#</th>
                    <th>Nombre actividad</th>
                    <th>Nombre Aprendiz</th>
                    <th>Fecha</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $n = 1; @endphp
                @forelse ($activities as $activity)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $activity->activity_name }}</td>
                    <td>{{ $activity->user->first_name }} {{ $activity->user->last_name }}</td>
                    <td>{{ $activity->date }}</td>
                    <td>{{ $activity->start_date }}</td>
                    <td>{{ $activity->end_date }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>
                        <span class="badge 
                                @if($activity->activity_status == 'Pendiente')  badge-danger
                                @elseif($activity->activity_status == '') badge-success
                                @endif
                            ">
                            {{ ucfirst(str_replace('_', ' ', $activity->activity_status)) }}
                        </span>
                    </td>
                    <td>
                        {{-- EDIT BUTTON (trigger modal) --}}
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $activity->id }}">Edit</button>

                        {{-- DELETE FORM --}}
                        <form action="{{ route('acuaponico.admin.admin.destroy', $activity->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this activity?')">Delete</button>
                        </form>

                        {{-- SEND FORM --}}
                        <form action="{{ route('acuaponico.admin.admin.send', $activity->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('PUT')
                            <button class="btn btn-sm btn-success">Send</button>
                        </form>
                    </td>
                </tr>

                {{-- EDIT MODAL --}}
                <div class="modal fade" id="editModal{{ $activity->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $activity->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('acuaponico.admin.admin.update', $activity->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $activity->id }}">Edit Activity</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-md-3">
                                        <label>Activity Name:</label>
                                        <input type="text" name="activity_name" class="form-control" value="{{ $activity->activity_name }}" required>
                                        <div class="col-md-4">
                                            <label>Apprentice:</label>
                                            <select name="user_id" class="form-control">
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $activity->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Date:</label>
                                            <input type="date" name="date" class="form-control" value="{{ $activity->date }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Start Date:</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ $activity->start_date }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label>End Date:</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ $activity->end_date }}">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>Description:</label>
                                            <input type="text" name="description" class="form-control" value="{{ $activity->description }}">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>Status:</label>
                                            <select name="activity_status" class="form-control">
                                                <option value="Pendiente" {{ $activity->activity_status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="Completada" {{ $activity->activity_status == 'Completada' ? 'selected' : '' }}>In Completada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No activities found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tabla  para mostrar las eidencias de las actividades ya gestionadas  -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Activiades completas</h3>
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
                    @foreach($evidenciasAdmin as $evidencia)
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
                            <a href="{{ route('evidencia.descargar', $evidencia->id) }}" class="btn btn-sm btn-success">
                                <i class="bi bi-download"></i> Descargar PDF
                            </a>
                            @endif
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
@endsection