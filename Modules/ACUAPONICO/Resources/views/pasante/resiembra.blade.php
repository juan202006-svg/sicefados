@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
<li class="breadcrumb-item active">Gestión de Resiembras</li>
@endpush

@section('content2')
<h1 class="fw-bold mb-4 text-primary text-center">Gestión de resiembras</h1>
<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Resiembras</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nueva resiembra
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="resiembraTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>S/Acuapónico</th>
                            <th>Cultivo</th>
                            <th>Cantidad</th>
                            <th>Mortalidad Original</th>
                            <th>Lotes</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($resiembra as $item)
                        <tr class="table-light">
                            <td class="text-center">{{ $n++ }}</td>
                            <td class="text-center">{{ $item->system->name }}</td>
                            <td class="text-center">{{ $item->crops->species->name }}</td>
                            <td class="text-center">
                                {{ $item->lots->sum('pivot.quantity') }}
                            </td>
                            <td class="text-center">{{ $item->original_mortality }}</td>
                            <td class="text-center">
                                @foreach ($item->lots as $lot)
                                {{ $lot->name }} ({{ $lot->pivot->quantity }})<br>
                                @endforeach
                            </td>
                            <td class="text-center">{{ $item->description ?? 'sin descripcion' }}</td>
                            <td class="text-center">{{ $item->date }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ $item->status }}</span>
                            </td>
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
            <form action="{{ route('acuaponico.pasante.pasante.storeresowing') }}" method="POST">
                @csrf
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Agregar Nueva Resiembra</h5>
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
                                    <input type="date" class="form-control form-control-lg custom-input" id="date" name="date" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="aquaponic_system_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-water mr-2"></i> Sistema Acuapónico
                                    </label>
                                    <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                        <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                                        @foreach ($acuaponico as $system)
                                        <option value="{{ $system->id }}">{{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="crop_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-leaf mr-2"></i> Cultivo de Plantas
                                    </label>
                                    <select name="crop_id" id="crop_id" class="form-control form-control-lg custom-select" required>
                                        <option value="" disabled selected>Seleccione un cultivo de plantas</option>
                                    </select>
                                    <div class="invalid-feedback" id="crop_id-error"></div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="mortalidad_total" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-skull-crossbones mr-2"></i> Mortalidad Total
                                    </label>
                                    <input type="number" id="mortalidad_total" name="original_mortality" class="form-control form-control-lg custom-input" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-layer-group mr-2"></i> Lotes
                                    </label>
                                    <div id="lots-container">
                                        <!-- Aquí se agregan inputs por AJAX -->
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="quantity" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sort-numeric-up mr-2"></i> Cantidad Total
                                    </label>
                                    <input type="number" class="form-control form-control-lg custom-input" id="quantity" name="quantity" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-align-left mr-2"></i> Descripción
                                    </label>
                                    <textarea class="form-control form-control-lg custom-textarea" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="status" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-toggle-on mr-2"></i> Estado
                                    </label>
                                    <select name="status" class="form-control form-control-lg custom-select" required>
                                        <option value="Registrada">Resiembra</option>
                                    </select>
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

        // Set current date for registration form
        const dateInput = document.getElementById('date');
        if (dateInput) {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const localDate = `${year}-${month}-${day}`;
            dateInput.value = localDate;
        }

        // FUNCIONALIDAD DE REGISTRO (NUEVA RESIEMBRA)

        // When aquaponic system changes in registration form
        $('#aquaponic_system_id').change(function() {
            let systemId = $(this).val();

            // Reset fields and validation
            $('#crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo de plantas</option>');
            $('#crop_id').removeClass('is-invalid'); // Resetear color rojo
            $('#crop_id-error').text(''); // Limpiar mensaje de error
            $('#mortalidad_total').val('');
            $('#lots-container').empty();
            $('#quantity').val('');

            if (systemId) {
                console.log('Sistema seleccionado:', systemId);
                $.get(`/crops-by-system/${systemId}`)
                    .done(function(data) {
                        console.log('Cultivos recibidos:', data);
                        if (data && data.length > 0) {
                            $('#crop_id').removeClass('is-invalid'); // Asegurar normal
                            $('#crop_id-error').text('');
                            data.forEach(function(crop) {
                                // Mostrar más info para distinguir si hay "duplicados"
                                let optionText = `${crop.species?.name ?? 'Sin especie'} `;
                                $('#crop_id').append(
                                    `<option value="${crop.id}">${optionText}</option>`
                                );
                            });
                        } else {
                            $('#crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                            $('#crop_id').addClass('is-invalid');
                            $('#crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');

                            // Mostrar alerta
                            Swal.fire({
                                icon: 'warning',
                                title: 'Sin cultivos disponibles',
                                text: 'No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema acuapónico.',
                                confirmButtonColor: '#3085d6',
                            });
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.error('Error al cargar cultivos:', error);
                        $('#crop_id').addClass('is-invalid');
                        $('#crop_id-error').text('Error al cargar cultivos: ' + error);
                    });
            }
        });

        // When crop changes in registration form
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
                        $('#lots-container').append('<p>Error al cargar lotes: ' + error + '</p>');
                    });
            }
        });

        // Calculate total quantity when lot inputs change in registration form
        $(document).on('input', '.lot-input', function() {
            let total = 0;
            $('.lot-input').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#quantity').val(total);

            // Validar que no exceda la mortalidad
            const mortality = parseInt($('#mortalidad_total').val()) || 0;

            if (total > mortality) {
                $('#quantity').addClass('is-invalid');
                if (!$('#quantity').next('.invalid-feedback').length) {
                    $('#quantity').after('<div class="invalid-feedback">La cantidad total no puede exceder la mortalidad registrada.</div>');
                }
            } else {
                $('#quantity').removeClass('is-invalid');
                $('#quantity').next('.invalid-feedback').remove();
            }
        });

        // Validación del formulario de registro
        $('form[action*="storeresowing"]').on('submit', function(e) {
            const total = parseInt($('#quantity').val()) || 0;
            const mortality = parseInt($('#mortalidad_total').val()) || 0;

            if (total > mortality) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'La cantidad total no puede exceder la mortalidad registrada.',
                    confirmButtonColor: '#d33',
                });
                return false;
            }
        });

        // FUNCIONALIDAD DE EDICIÓN

        // Edit button events
        $(document).on('click', '.editbtn', function() {
            const id = $(this).data('id');
            $('#formEditar').attr('action', `/pasante/resiembras/update/${id}`);
            $('#edit-id').val(id);

            // Cargar datos de la resiembra
            $.get(`/resowing-edit-data/${id}`)
                .done(function(data) {
                    console.log('Datos de edición cargados:', data);

                    // Llenar datos básicos
                    $('#edit-date').val(data.resowing.date);
                    $('#edit-aquaponic_system_id').val(data.resowing.aquaponic_system_id);
                    $('#edit-description').val(data.resowing.description);
                    $('#edit-original_mortality').val(data.mortality);

                    // Llenar cultivos del sistema
                    $('#edit-crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo</option>');
                    if (data.cropsInSystem && data.cropsInSystem.length > 0) {
                        data.cropsInSystem.forEach(function(crop) {
                            const selected = crop.id == data.resowing.crop_id ? 'selected' : '';
                            let optionText = `${crop.species?.name ?? 'Sin especie'}`;
                            $('#edit-crop_id').append(
                                `<option value="${crop.id}" ${selected}>${optionText}</option>`
                            );
                        });
                    } else {
                        $('#edit-crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                        $('#edit-crop_id').addClass('is-invalid');
                        $('#edit-crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');
                    }

                    // Llenar lotes con cantidades actuales
                    $('#edit-lots-container').empty();
                    if (data.resowingLots && data.resowingLots.length > 0) {
                        data.resowingLots.forEach(function(lot) {
                            $('#edit-lots-container').append(`
                                <div class="mb-2">
                                    <label>${lot.name} (Disponible: ${lot.available_capacity})</label>
                                    <input type="number" 
                                           name="lots[${lot.id}]" 
                                           max="${lot.available_capacity}" 
                                           min="0" 
                                           value="${lot.current_quantity}"
                                           class="form-control edit-lot-input"
                                           data-lot-id="${lot.id}">
                                </div>
                            `);
                        });
                    } else {
                        $('#edit-lots-container').append('<p>No hay lotes disponibles para este cultivo.</p>');
                    }

                    // Calcular cantidad total inicial
                    calculateEditTotal();
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar datos de edición:', error);
                    $('#edit-crop_id').addClass('is-invalid');
                    $('#edit-crop_id-error').text('Error al cargar datos de edición: ' + error);
                });
        });

        // Calculate total quantity for edit modal
        function calculateEditTotal() {
            let total = 0;
            $('.edit-lot-input').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#edit-quantity').val(total);

            // Validar que no exceda la mortalidad (usar total existente)
            const mortality = parseInt($('#edit-original_mortality').val()) || 0;

            if (total > mortality) {
                $('#edit-quantity').addClass('is-invalid');
                if (!$('#edit-quantity').next('.invalid-feedback').length) {
                    $('#edit-quantity').after('<div class="invalid-feedback">La cantidad total no puede exceder la mortalidad registrada.</div>');
                }
            } else {
                $('#edit-quantity').removeClass('is-invalid');
                $('#edit-quantity').next('.invalid-feedback').remove();
            }
        }

        // When edit lot inputs change
        $(document).on('input', '.edit-lot-input', function() {
            calculateEditTotal();
        });

        // When edit aquaponic system changes
        $('#edit-aquaponic_system_id').change(function() {
            let systemId = $(this).val();
            let resowingId = $('#edit-id').val(); // Pasamos el ID de la resiembra actual

            // Reset fields (except description and date)
            $('#edit-crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo</option>');
            $('#edit-crop_id').removeClass('is-invalid');
            $('#edit-crop_id-error').text('');
            $('#edit-original_mortality').val('');
            $('#edit-lots-container').empty();
            $('#edit-quantity').val('');

            if (systemId) {
                console.log('Sistema seleccionado en edición:', systemId);
                let url = `/crops-by-system/${systemId}`;
                if (resowingId) {
                    url += `/${resowingId}`; // Agregamos resowingId para modo edición
                }
                $.get(url)
                    .done(function(data) {
                        console.log('Cultivos recibidos en edición:', data);
                        if (data && data.length > 0) {
                            $('#edit-crop_id').removeClass('is-invalid');
                            $('#edit-crop_id-error').text('');
                            data.forEach(function(crop) {
                                let optionText = `${crop.species?.name ?? 'Sin especie'}`;
                                $('#edit-crop_id').append(
                                    `<option value="${crop.id}">${optionText}</option>`
                                );
                            });
                        } else {
                            $('#edit-crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                            $('#edit-crop_id').addClass('is-invalid');
                            $('#edit-crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');

                            Swal.fire({
                                icon: 'warning',
                                title: 'Sin cultivos disponibles',
                                text: 'No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema acuapónico.',
                                confirmButtonColor: '#3085d6',
                            });
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.error('Error al cargar cultivos en edición:', error);
                        $('#edit-crop_id').addClass('is-invalid');
                        $('#edit-crop_id-error').text('Error al cargar cultivos: ' + error);
                    });
            }
        });

        // When edit crop changes
        $('#edit-crop_id').change(function() {
            let cropId = $(this).val();
            let resowingId = $('#edit-id').val();
            $('#edit-original_mortality').val('');
            $('#edit-lots-container').empty();
            $('#edit-quantity').val('');

            if (cropId) {
                // Usar el método que filtra por resiembra cuando estamos en modo edición
                let url = `/crop-lots-for-edit/${cropId}/${resowingId}`;

                $.get(url)
                    .done(function(data) {
                        // Show mortality
                        $('#edit-original_mortality').val(data.mortality || 0);

                        // Generate lot inputs
                        if (data.lots && data.lots.length > 0) {
                            data.lots.forEach(function(lot) {
                                let currentValue = lot.current_quantity || 0;
                                $('#edit-lots-container').append(`
                                    <div class="mb-2">
                                        <label>${lot.name} (Disponible: ${lot.available_capacity})</label>
                                        <input type="number" 
                                               name="lots[${lot.id}]" 
                                               max="${lot.available_capacity}" 
                                               min="0" 
                                               value="${currentValue}"
                                               class="form-control edit-lot-input"
                                               data-lot-id="${lot.id}">
                                    </div>
                                `);
                            });
                        } else {
                            $('#edit-lots-container').append('<p>No hay lotes disponibles para este cultivo.</p>');
                        }

                        // Calcular total inicial
                        calculateEditTotal();
                    })
                    .fail(function(xhr, status, error) {
                        console.error('Error al cargar detalles del cultivo:', error);
                        $('#edit-lots-container').append('<p>Error al cargar lotes: ' + error + '</p>');
                    });
            }
        });

        // Validación del formulario de edición
        $('#formEditar').on('submit', function(e) {
            const total = parseInt($('#edit-quantity').val()) || 0;
            const mortality = parseInt($('#edit-original_mortality').val()) || 0;

            if (total > mortality) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'La cantidad total no puede exceder la mortalidad registrada.',
                    confirmButtonColor: '#d33',
                });
                return false;
            }
        });

        // Eliminar los registros de resiembra
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
@endsection