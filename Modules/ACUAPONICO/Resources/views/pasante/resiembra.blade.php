@extends('acuaponico::layouts.masterpa')
@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Resiembras</li>
@endpush
@section('content2')
<h1 class="fw-bold mb-4">Gestión de resiembras</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Resiembras</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva resiembra
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table id="resiembraTable" class="table table-bordered table-striped datatable text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Código</th>
                            <th>S/Acuapónico</th>
                            <th>Cultivo</th>
                            <th>Cantidad</th>
                            <th>Mortalidad Original</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($resiembra as $item)
                        <tr>
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $item->system->name }}</td>
                            <td class="text-center">{{ $item->crops->species->name }}</td>
                            <td class="text-center">
                                {{ $item->lots->sum('pivot.quantity') }}
                            </td>
                            <td class="text-center">{{ $item->original_mortality }}</td>
                            <td class="text-center">{{ $item->description }}</td>
                            <td class="text-center">{{ $item->date }}</td>
                            <td class="text-center">
                                <span class="badge badge-success">{{ $item->status }}</span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="{{ $item->id }}"
                                    data-aquaponic_system_id="{{ $item->aquaponic_system_id }}"
                                    data-crop_id="{{ $item->crop_id }}"
                                    data-original_mortality="{{ $item->original_mortality }}"
                                    data-description="{{ $item->description }}"
                                    data-date="{{ $item->date }}"
                                    data-status="{{ $item->status }}"
                                    data-toggle="modal"
                                    data-target="#editar">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="{{ $item->id }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Editar -->
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Resiembra</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-date" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="edit-date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                                <select name="aquaponic_system_id" id="edit-aquaponic_system_id" class="form-control" required>
                                    @foreach ($acuaponico as $system)
                                    <option value="{{ $system->id }}">{{ $system->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-crop_id" class="form-label">Cultivo:</label>
                                <select name="crop_id" id="edit-crop_id" class="form-control" required>
                                    @foreach ($cultivos as $cultivo)
                                    <option value="{{ $cultivo->id }}">{{ $cultivo->species->name ?? 'Sin especie' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-original_mortality" class="form-label">Mortalidad Original:</label>
                                <input type="number" class="form-control" id="edit-original_mortality" name="original_mortality" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-description" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->
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
        <form action="{{ route('acuaponico.pasante.pasante.storeresowing') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nueva Resiembra</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <!-- Sistema Acuapónico -->
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                        <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                            @foreach ($acuaponico as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Cultivo de plantas (se llenará por AJAX según el sistema acuapónico) -->
                    <div class="mb-3">
                        <label for="crop_id" class="form-label">Cultivo de Plantas:</label>
                        <select name="crop_id" id="crop_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione un cultivo de plantas</option>
                        </select>
                    </div>

                    <!-- Mortalidad total -->
                    <div class="mb-3">
                        <label for="mortalidad_total" class="form-label">Mortalidad Total:</label>
                        <input type="number" id="mortalidad_total" name="original_mortality" class="form-control" readonly>
                    </div>

                    <!-- Lotes disponibles -->
                    <div class="mb-3">
                        <label class="form-label">Lotes:</label>
                        <div id="lots-container">
                            <!-- Aquí se agregan inputs por AJAX -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad Total:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select name="status" class="form-control" required>
                            <option value="Registrada">Resiembra</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // DataTable initialization
        $('#resiembraTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            }
        });

        // Set current date
        const dateInput = document.getElementById('date');
        if (dateInput) {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const localDate = `${year}-${month}-${day}`;
            dateInput.value = localDate;
        }

        // Edit button events
        $(document).on('click', '.editbtn', function() {
            const id = $(this).data('id');
            $('#formEditar').attr('action', `/pasante/resiembras/update/${id}`);
            $('#edit-id').val(id);
            $('#edit-date').val($(this).data('date'));
            $('#edit-aquaponic_system_id').val($(this).data('aquaponic_system_id'));
            $('#edit-crop_id').val($(this).data('crop_id'));
            $('#edit-original_mortality').val($(this).data('original_mortality'));
            $('#edit-description').val($(this).data('description'));
            $('#edit-status').val($(this).data('status'));
        });

        // Delete button events
        $(document).on('click', '.btnEliminar', function() {
            const id = $(this).data('id');
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
                    $('#formEliminar').attr('action', `/pasante/resiembras/destroy/${id}`);
                    $('#formEliminar').submit();
                }
            });
        });

        // When aquaponic system changes
        $('#aquaponic_system_id').change(function() {
            let systemId = $(this).val();
            
                         // Reset fields
             $('#crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo de plantas</option>');
            $('#mortalidad_total').val('');
            $('#lots-container').empty();
            $('#quantity').val('');

            if (systemId) {
                console.log('Sistema seleccionado:', systemId); // Debug
                $.get(`/crops-by-system/${systemId}`)
                .done(function(data) {
                    console.log('Cultivos recibidos:', data); // Debug
                    if (data && data.length > 0) {
                        data.forEach(function(crop) {
                            $('#crop_id').append(
                                `<option value="${crop.id}">${crop.species?.name ?? 'Sin especie'}</option>`
                            );
                        });
                                         } else {
                         $('#crop_id').append('<option value="" disabled>No hay cultivos de plantas en seguimiento</option>');
                     }
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar cultivos:', error); // Debug
                    alert('Error al cargar cultivos: ' + error);
                });
            }
        });

        // When crop changes
        $('#crop_id').change(function() {
            let cropId = $(this).val();
            $('#mortalidad_total').val('');
            $('#lots-container').empty();
            $('#quantity').val('');

            if (cropId) {
                console.log('Cultivo seleccionado:', cropId); 
                $.get(`/crop-details/${cropId}`)
                .done(function(data) {
                    console.log('Detalles del cultivo:', data); 
                    
                    // Show mortality
                    $('#mortalidad_total').val(data.mortality || 0);

                    // Generate lot inputs
                    if (data.lots && data.lots.length > 0) {
                        data.lots.forEach(function(lot) {
                            $('#lots-container').append(`
                            <div class="mb-2">
                                <label>${lot.name} (Disponible: ${lot.available_capacity})</label>
                                <input type="number" 
                                       name="lots[${lot.id}]" 
                                       max="${lot.available_capacity}" 
                                       min="0" 
                                       class="form-control lot-input"
                                       data-lot-id="${lot.id}">
                            </div>
                        `);
                        });
                    } else {
                        $('#lots-container').append('<p>No hay lotes disponibles para este cultivo.</p>');
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar detalles del cultivo:', error); 
                    alert('Error al cargar detalles del cultivo: ' + error);
                });
            }
        });

        // Calculate total quantity when lot inputs change
        $(document).on('input', '.lot-input', function() {
            let total = 0;
            $('.lot-input').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#quantity').val(total);
        });
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
@endsection