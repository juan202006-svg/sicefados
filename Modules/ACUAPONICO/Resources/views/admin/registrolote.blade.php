@extends('acuaponico::layouts.master')

@section('content')

<!-- links de los bootstrap -->

<!-- DataTables Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">






<!-- links de los js -->

<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (solo una vez) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



<!-- Estilos personalizados -->
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05) !important;
    }

    /* Estilos para el carrusel */
    .carousel-card {
        width: 70%;
        min-height: 100px;
        border-radius: 15px;
        border: none;
        transition: transform 0.5s ease, box-shadow 0.3s ease;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

    .carousel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

    .carousel-icon {
        transition: transform 0.3s ease;
        }

    .carousel-item.active .carousel-icon {
        animation: bounce 1s ease;
        }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
        }

    .carousel-item {
        transition: transform 1.2s ease-in-out, opacity 0.5s ease-out;
        }
  
    /* Tema acuapónico - colores agua/plantas */
    .text-primary { color: #1a7bb9 !important; } 
    .text-success { color: #28a745 !important; } 
    .text-info { color: #17a2b8 !important; } 
    .text-warning { color: #ffc107 !important; } 

    /* Buscador (barra de búsqueda) */
    .dataTables_filter {
        margin-top: 4%;
        text-align: right;
    }
    .dataTables_filter input {
        border-radius: 2rem;
        border: 1px solid #ced4da;
        padding: 0.5rem 1rem;
        font-size: 0.95rem;
        box-shadow: 0 0 5px rgba(0,0,0,0.05);
        transition: all 0.3s ease-in-out;
    }
    .dataTables_filter input:focus {
        outline: none;
        border-color: #3abed5;
        box-shadow: 0 0 10px rgba(58,190,213,0.3);
    }

    /* Paginación */
    .dataTables_paginate {
        margin-top: 4rem;
        margin-bottom: 5%;
    }
    .dataTables_paginate .pagination {
        justify-content: flex-end;
    }
    .dataTables_paginate .page-item.active .page-link {
        background: linear-gradient(135deg, #03c54d 0%, #02c27f 100%);
        border-color: transparent;
        color: white;
    }
    .dataTables_paginate .page-link {
        border-radius: 50px !important;
        margin: 0 0.25rem;
        color: #3abed5;
        border: 1px solid #dee2e6;
        transition: 0.2s;
    }
    .dataTables_paginate .page-link:hover {
        background-color: #e9f7fb;
        color: #02a4c7;
    }

    
    .dataTables_length {
        margin-left: 2rem; 
    }

    .dataTables_length select {
        margin-top: 10%;
        padding: 0.25rem 1.5rem 0.25rem 0.75rem; 
        border-radius: 1.5rem;
        border: 1px solid #ced4da;
        font-size: 0.9rem;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;

        appearance: none;             
        -webkit-appearance: none;     
        -moz-appearance: none;        
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg width='10' height='5' viewBox='0 0 10 5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0l5 5 5-5z' fill='%23666'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 0.65rem auto;
        text-align-last: right;
    }
</style>

<!-- inicio html de la pagina -->
<div class="container-fluid px-4" style="max-width: 100%; overflow-x: hidden;">
    <!-- Carrusel para Sistema Acuapónico - Módulo de Registro de Lotes -->
    <div id="acuaponicCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500" style="width: 80%; margin: 0 auto;">

        <!-- Indicadores del carrusel -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <!-- Tarjeta 1 - Registro de Lotes -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-water fa-3x text-primary"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Gestion de lotes en las unidades Acuapónicas</h2>
                            <p class="card-text fs-5 d-none d-md-block">Gestión completa de cada unidad de producción en la unidad acuaponica</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2 - Agregar lotes -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-chart-bar fa-3x text-success"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Agregar nuevos lotes en la unidad</h2>
                            <p class="card-text fs-5 d-none d-md-block">Tubos, capacidad, cantidad disponible, estado y fecha de creación</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tarjeta 4 - Producción -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-clipboard-check fa-3x text-warning"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Editar y eliminar lotes</h2>
                            <p class="card-text fs-5 d-none d-md-block">Control detallado de los lotes existentes en el sistema</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles de navegación con flechas negras -->
        <button class="carousel-control-prev" type="button" data-bs-target="#acuaponicCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
            <span class="visually-hidden">Anterior</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#acuaponicCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
        </div>

        <br><br>
        <div class="card border-0 shadow-lg rounded-3 overflow-hidden" style="margin-left: 8%; margin-right: 8%; margin-top: 0;">
            <div class="card-header bg-white py-3 border-0">
                <h2 class="mb-0 fw-semibold">
                    <i class="bi bi-table me-2 ml-3"></i>Lista de Lotes
                </h2>
            </div>
            <div class="card-body p-0" style="width: 93%; margin-left: 3%;">
                <div class="table-responsive" style="border: 1px solid #9797977b; border-radius: 10px; overflow: hidden;">
                    <table id="lotesTable" class="table table-hover mb-0" style="width:100%">
                        <thead class="bg-light text-center">
                            <tr>
                                <th class="ps-4">Código</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Capacidad</th>
                                <th>Ocupado</th>
                                <th>Disponible</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th class="text-end pe-4">Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 1; @endphp
                            @foreach ($lots as $lot)
                                <tr class="border-top">
                                    <td class="ps-4 fw-medium text-center">{{ $n++ }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($lot->date)->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <span class="d-inline-block text-truncate" style="max-width: 150px;">{{ $lot->name }}</span>
                                    </td>
                                    <td class="text-center">{{ $lot->capacity }}</></td>
                                    <td class="text-center">{{ $lot->ocupado }}</td>
                                    <td class="text-center">
                                        @if($lot->disponible > 0)
                                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success">{{ $lot->disponible }}</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger">0</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($lot->image)
                                            <img src="{{ asset('storage/lotes/' . $lot->image) }}" alt="Imagen del lote" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($lot->state == 'disponible')
                                        <span class="badge bg-opacity-20 text-white" style="background-color: #9adfaa">
                                            <i class="bi bi-check-circle me-1"></i>Disponible
                                        </span>
                                        @else
                                        <span class="badge bg-opacity-20 text-white" style="background-color: #df9a9a">
                                            <i class="bi bi-x-circle me-1"></i>No Disponible
                                        </span>
                                        @endif  
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-warning editbtn"
                                                data-id="{{ $lot->id }}"
                                                data-name="{{ $lot->name }}"
                                                data-capacity="{{ $lot->capacity }}"
                                                data-state="{{ $lot->state }}"
                                                data-ocupado="{{ $lot->ocupado }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateLot">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger btnEliminar" data-id="{{ $lot->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createLot" 
                        style="margin-left: 83%; margin-top: 20px; margin-bottom: 20px;">
                    <i class="bi bi-plus-circle me-2"></i>Agregar Lote
                </button>
            </div>
        </div>
</div>


<!-- Modal de creación -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true" data-bs-backdrop="static" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 40%;">
        <form action="{{ route('acuaponico.pasante.pasante.storeLot') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <!-- Encabezado con gradiente -->
                <div class="modal-header py-3" style="background: linear-gradient(135deg, #2abef5 0%, #6dc9dd 100%);">
                    <h5 class="modal-title text-white fs-5 fw-bold" id="createLotLabel">
                        <i class="bi bi-plus-circle-fill me-2"></i>CREAR NUEVO LOTE
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                <!-- Cuerpo del modal con animación suave -->
                <div class="modal-body py-4 px-4" style="background-color: #f8fafc;">
<div class="row g-3">
    <!-- Campo Fecha con ícono -->
    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" name="date" class="form-control shadow-sm rounded-4" id="date" readonly 
                   style="background-color: #fff; border-left: 4px solid #3abed5;">
            <label for="date" class="text-muted small">
                <i class="bi bi-calendar3 me-2"></i>Fecha
            </label>
        </div>
    </div>

    <!-- Campo Nombre con ícono -->
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="name" class="form-control shadow-sm rounded-4" required
                   style="background-color: #fff; border-left: 4px solid #3abed5;">
            <label for="name" class="text-muted small">
                <i class="bi bi-card-heading me-2"></i>Nombre del Lote
            </label>
            <div class="invalid-feedback small">Por favor ingrese un nombre válido</div>
        </div>
    </div>

    <!-- Campo Capacidad con ícono -->
    <div class="col-md-6">
        <div class="form-floating">
            <input type="number" name="capacity" class="form-control shadow-sm rounded-4" required
                   style="background-color: #fff; border-left: 4px solid #3abed5;">
            <label for="capacity" class="text-muted small">
                <i class="bi bi-arrows-angle-expand me-2"></i>Capacidad
            </label>
            <div class="invalid-feedback small">La capacidad es requerida</div>
        </div>
    </div>

    <!-- Campo Imagen con ícono -->
    <div class="col-md-6">
        <label for="image" class="form-label text-muted small mb-1">
            <i class="bi bi-image me-2"></i>Imagen del Lote
        </label>
        <input type="file" name="image" accept="image/*" class="form-control shadow-sm rounded-4" id="image"
               style="background-color: #fff; border-left: 4px solid #3abed5;" required>
        <div class="invalid-feedback small">Por favor seleccione una imagen</div>
    </div>

    <!-- Campo Estado con ícono -->
    <div class="col-md-6">
        <div class="form-floating">
            <select name="state" class="form-select shadow-sm rounded-4" required
                    style="background-color: #fff; border-left: 4px solid #3abed5;">
                <option value="disponible">Disponible</option>
            </select>
            <label for="state" class="text-muted small">
                <i class="bi bi-toggle-on me-2"></i>Estado
            </label>
        </div>
    </div>
</div>
                </div>
                
                <!-- Pie de página -->
                <div class="modal-footer border-0 py-3" style="background-color: #f1f5f9;">
                    <button type="button" class="btn btn-lg btn-outline-danger rounded-pill px-4 shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-lg rounded-pill px-4 shadow-sm" 
                            style="background: linear-gradient(135deg, #03c54d 0%, #02c27f 100%); color: white;">
                        <i class="bi bi-save2-fill me-2"></i>Guardar Lote
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script para validación-->
<script>

(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<!-- Modal de edición -->
<div class="modal fade" id="updateLot" tabindex="-1" aria-labelledby="updateLotLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 40%;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateLot', 0) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <!-- Encabezado con gradiente y sombra -->
                <div class="modal-header py-3" style="background: linear-gradient(135deg, #2abef5 0%, #6dc9dd 100%);">
                    <input type="hidden" name="from" value="{{ request()->routeIs('acuaponico.admin.*') ? 'admin' : 'pasante' }}">
                    <h5 class="modal-title text-white fs-5 fw-bold" id="updateLotLabel">
                        <i class="bi bi-pencil-square me-2"></i>EDITAR LOTE
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Cuerpo del modal -->
                <div class="modal-body py-4 px-4" style="background-color: #f8fafc;">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="row g-3">
                        <!-- Campo Nombre -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control shadow-sm rounded-4" id="edit-name" name="name" required
                                       style="background-color: #fff; border-left: 4px solid #3abed5;">
                                <label for="edit-name" class="text-muted small">
                                    <i class="bi bi-card-heading me-2"></i>Nombre del Lote
                                </label>
                                <div class="invalid-feedback small">Por favor ingrese un nombre válido</div>
                            </div>
                        </div>
                        
                        <!-- Campo Capacidad -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control shadow-sm rounded-4" id="edit-capacity" name="capacity" required
                                       style="background-color: #fff; border-left: 4px solid #3abed5;">
                                <label for="edit-capacity" class="text-muted small">
                                    <i class="bi bi-arrows-angle-expand me-2"></i>Capacidad
                                </label>
                                <div class="invalid-feedback small" id="error-capacidad-lote">La capacidad es requerida</div>
                            </div>
                        </div>
                        
                        <!-- Campo Estado -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select shadow-sm rounded-4" id="edit-state" name="state" required
                                        style="background-color: #fff; border-left: 4px solid #3abed5;">
                                    <option value="disponible">Disponible</option>
                                    <option value="no disponible">No Disponible</option>
                                </select>
                                <label for="edit-state" class="text-muted small">
                                    <i class="bi bi-toggle-on me-2"></i>Estado
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pie de página -->
                <div class="modal-footer border-0 py-3" style="background-color: #f1f5f9;">
                    <button type="button" class="btn btn-lg btn-outline-danger rounded-pill px-4 shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-lg rounded-pill px-4 shadow-sm" 
                            style="background: linear-gradient(135deg, #03c54d 0%, #02c27f 100%); color: white;">
                        <i class="bi bi-save2-fill me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Script para validación -->
<script>
// Validación del formulario de edición
document.getElementById('formEditar').addEventListener('submit', function(event) {
    if (!this.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    this.classList.add('was-validated');
}, false);

// Función para cargar datos en el modal de edición
function cargarDatosEdicion(id, name, capacity, state) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-capacity').value = capacity;
    document.getElementById('edit-state').value = state;
    
    // Actualizar la ruta del formulario con el ID correcto
    const form = document.getElementById('formEditar');
    form.action = form.action.replace('/0', '/' + id);
}
</script>



<!-- Modal de eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
<footer style="margin-top: 10%;">
    <div class="text-center py-3">
        <p class="mb-0">© 2025 SICEFA. Todos los derechos reservados.</p>
    </div>
</footer>


<script>
    // Script para establecer la fecha actual
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });


    //Script del modal editar

    document.addEventListener('DOMContentLoaded', function() {
    const formEdit = document.getElementById('formEditar');
    const inputCapacity = document.getElementById('edit-capacity');
    const errorDiv = document.getElementById('error-capacidad-lote');

    let capacidadOcupada = 0;

    inputCapacity.addEventListener('input', function() {
        const nuevaCapacidad = Number(inputCapacity.value);

        if (nuevaCapacidad < capacidadOcupada) {
            inputCapacity.classList.add('is-invalid');
            errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
        } else {
            inputCapacity.classList.remove('is-invalid');
            errorDiv.innerText = '';
        }
    });

    document.querySelectorAll('.editbtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const capacity = this.getAttribute('data-capacity');
            const state = this.getAttribute('data-state');
            capacidadOcupada = Number(this.getAttribute('data-ocupado')) || 0;

            formEdit.action = `/pasante/lote/update/${id}`;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            inputCapacity.value = capacity;
            document.getElementById('edit-state').value = state; 

            if (Number(capacity) < capacidadOcupada) {
                inputCapacity.classList.add('is-invalid');
                errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
            } else {
                inputCapacity.classList.remove('is-invalid');
                errorDiv.innerText = '';
            }

            const estadoSelect = document.getElementById('edit-state');
            if (state.toLowerCase() === "ocupado") {
                estadoSelect.value = 'no disponible'; 
                estadoSelect.setAttribute('disabled', 'disabled');
            } else {
                estadoSelect.removeAttribute('disabled');
            }
        });
    });

    formEdit.addEventListener('submit', function(e) {
        const nuevaCapacidad = Number(inputCapacity.value);
        if (nuevaCapacidad < capacidadOcupada) {
            e.preventDefault();
            inputCapacity.classList.add('is-invalid');
            errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
        }
    });
});
</script>

<script>
    document.querySelectorAll('.btnEliminar').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'rounded-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formEliminar = document.getElementById('formEliminar');
                    formEliminar.action = `/pasante/lote/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
        confirmButtonColor: '#d33',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
        confirmButtonColor: '#d33',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
@endif

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#lotesTable').DataTable({
            responsive: true,
            processing: true,
            language: {
                paginate: {
                    previous: 'Anterior',
                    next: 'Siguiente'
                },
                lengthMenu: 'Mostrar _MENU_ registros por página',
                zeroRecords: 'No se encontraron resultados',
                info: '',
                infoEmpty: 'No hay registros disponibles',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                search: 'Buscar:',
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                emptyTable: "No hay datos disponibles en la tabla"
            },
            drawCallback: function (settings) {
                const api = this.api();
                const pageInfo = api.page.info();
                const currentPage = pageInfo.page + 1;
                const totalPages = pageInfo.pages;

                let customInfo = `Página ${currentPage} de ${totalPages}`;
                if ($('#custom-info').length === 0) {
                    $('#lotesTable_info').after(`<div id="custom-info" class="fw-semibold" style="margin-left: 5%; margin-bottom: 5%; margin-top: -1%; color: #6c757d;">${customInfo}</div>`);
                } else {
                    $('#custom-info').html(customInfo);
                }
            }
        });
    </script>
@endsection

@endsection