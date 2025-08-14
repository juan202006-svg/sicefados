

<?php $__env->startSection('content2'); ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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

    @keyframes  bounce {
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

    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #20c997);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
</style>

<div class="container-fluid px-4" style="max-width: 100%; overflow-x: hidden;">
    <!-- Carrusel para Sistema Acuapónico - Módulo de Categorías -->
    <div id="acuaponicCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500" style="width: 80%; margin: 0 auto;">

        <!-- Indicadores del carrusel -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#acuaponicCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <!-- Tarjeta 1 - Gestión de Categorías -->
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-tags fa-3x text-primary"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Gestión de Categorías en el Sistema Acuapónico</h2>
                            <p class="card-text fs-5 d-none d-md-block">Organización y clasificación de los diferentes tipos de elementos en la unidad acuapónica</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 2 - Agregar Categorías -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-plus-circle fa-3x text-success"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Agregar Nuevas Categorías</h2>
                            <p class="card-text fs-5 d-none d-md-block">Creación de nuevas clasificaciones para organizar los elementos del sistema</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 - Edición de Categorías -->
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center p-3" style="min-height: 320px;">
                    <div class="card carousel-card shadow-lg w-100 d-flex justify-content-center align-items-center">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
                            <div class="carousel-icon mb-3">
                                <i class="fas fa-edit fa-3x text-warning"></i>
                            </div>
                            <h2 class="card-title display-5 fw-bold mb-3 text-center">Editar y Eliminar Categorías</h2>
                            <p class="card-text fs-5 d-none d-md-block">Mantenimiento y actualización de las categorías existentes</p>
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
                <i class="bi bi-table me-2 ml-3"></i>Lista de Categorías
            </h2>
        </div>
        <div class="card-body p-0" style="width: 93%; margin-left: 3%;">
            <div class="table-responsive" style="border: 1px solid #9797977b; border-radius: 10px; overflow: hidden;">
                <table id="categoriasTable" class="table table-hover mb-0" style="width:100%">
                    <thead class="bg-light text-center">
                        <tr>
                            <th class="ps-4">Código</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-top">
                            <td class="ps-4 fw-medium text-center"><?php echo e($n++); ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-tag me-1"></i><?php echo e($item->name); ?>

                                </span>
                            </td>
                            <td class="text-center"><?php echo e(\Carbon\Carbon::parse($item->date)->format('d/m/Y')); ?></td>
                            <td class="text-end pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-sm btn-outline-warning editbtn"
                                        data-id="<?php echo e($item->id); ?>"
                                        data-date="<?php echo e($item->date); ?>"
                                        data-name="<?php echo e($item->name); ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger btnEliminar" data-id="<?php echo e($item->id); ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-success rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#agregar" 
                    style="margin-left: 80%; margin-top: 20px; margin-bottom: 20px;">
                <i class="bi bi-plus-circle me-2"></i>Agregar categoria
            </button>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 40%;">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storeCategory')); ?>" method="POST" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <!-- Encabezado con gradiente -->
                <div class="modal-header py-3" style="background: linear-gradient(135deg, #2abef5 0%, #6dc9dd 100%);">
                    <h5 class="modal-title text-white fs-5 fw-bold" id="agregarLabel">
                        <i class="bi bi-plus-circle-fill me-2"></i>CREAR NUEVA CATEGORÍA
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
                                    <i class="bi bi-card-heading me-2"></i>Nombre de la Categoría
                                </label>
                                <div class="invalid-feedback small">Por favor ingrese un nombre válido</div>
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
                        <i class="bi bi-save2-fill me-2"></i>Guardar Categoría
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 40%;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateCategory', 0)); ?>" method="POST" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                <!-- Encabezado con gradiente y sombra -->
                <div class="modal-header py-3" style="background: linear-gradient(135deg, #2abef5 0%, #6dc9dd 100%);">
                    <h5 class="modal-title text-white fs-5 fw-bold" id="editarLabel">
                        <i class="bi bi-pencil-square me-2"></i>EDITAR CATEGORÍA
                    </h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Cuerpo del modal -->
                <div class="modal-body py-4 px-4" style="background-color: #f8fafc;">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="row g-3">
                        <!-- Campo Fecha -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control shadow-sm rounded-4" id="edit-date" name="date" readonly
                                       style="background-color: #fff; border-left: 4px solid #3abed5;">
                                <label for="edit-date" class="text-muted small">
                                    <i class="bi bi-calendar3 me-2"></i>Fecha
                                </label>
                            </div>
                        </div>
                        
                        <!-- Campo Nombre -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control shadow-sm rounded-4" id="edit-name" name="name" required
                                       style="background-color: #fff; border-left: 4px solid #3abed5;">
                                <label for="edit-name" class="text-muted small">
                                    <i class="bi bi-card-heading me-2"></i>Nombre de la Categoría
                                </label>
                                <div class="invalid-feedback small">Por favor ingrese un nombre válido</div>
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

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEliminar" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>
            </form>
        </div>
    </div>
</div>

<footer style="margin-top: 10%;">
    <div class="text-center py-3">
        <p class="mb-0">© 2025 SICEFA. Todos los derechos reservados.</p>
    </div>
</footer>

<!-- Bootstrap Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (solo una vez) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

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

<!-- Script para establecer la fecha actual -->
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

<!--Script del modal editar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/categoria/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-name').value = this.getAttribute('data-name');
            });
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
                    formEliminar.action = `/pasante/categoria/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '<?php echo e(session("success")); ?>',
        confirmButtonColor: '#3085d6',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?php echo e(session("error")); ?>',
        confirmButtonColor: '#d33',
        customClass: {
            popup: 'rounded-3'
        }
    });
</script>
<?php endif; ?>

<?php $__env->startSection('scripts'); ?>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            const table = $('#categoriasTable').DataTable({
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

                    // Mostrar el nuevo mensaje de "Página 1 de 10"
                    let customInfo = `Página ${currentPage} de ${totalPages}`;
                    if ($('#custom-info').length === 0) {
                        $('#categoriasTable_info').after(`<div id="custom-info" class="fw-semibold" style="margin-left: 5%; margin-bottom: 5%; margin-top: -1%; color: #6c757d;">${customInfo}</div>`);
                    } else {
                        $('#custom-info').html(customInfo);
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registrocategoria.blade.php ENDPATH**/ ?>