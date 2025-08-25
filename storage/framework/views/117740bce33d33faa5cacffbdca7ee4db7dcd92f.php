
<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Categorias</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<h1 class="fw-bold mb-4">Gestión de Categorias</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 text-dark">Lista de Categorias</h5>
            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva categoria
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="categoriaTable" class="table table-hover table-bordered align-middle text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->date); ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm editbtn"
                                    data-id="<?php echo e($item->id); ?>"
                                    data-name="<?php echo e($item->name); ?>"
                                    data-toggle="modal"
                                    data-target="#editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($item->id); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Editar -->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateCategory', 0)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('put'); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarLabel">Editar Categoría</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="edit-id">
                                <div class="mb-3">
                                    <label for="edit-name" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="edit-name" name="name">
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
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storeCategory')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nueva Categoría</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la Categoría:</label>
                        <input type="text" name="name" class="form-control" required>
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
<style>
    /* --- Estilos para la tabla --- */
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(49, 137, 231, 0.08);
        transition: 0.3s;
    }

    /* --- Botón "Nueva categoría" --- */
    .btn-light.btn-sm {
        background: #ffffff;
        color: #007bff;
        font-weight: 500;
        border: 1px solid #007bff;
        border-radius: 20px;
        padding: 5px 15px;
        transition: 0.3s;
    }

    .btn-light.btn-sm:hover {
        background: #007bff;
        color: #fff;
    }

    /* --- Botones de acción --- */
    .btn-info.btn-sm,
    .btn-danger.btn-sm {
        border-radius: 50%;
        width: 34px;
        height: 34px;
        padding: 6px;
    }

    .btn-info.btn-sm i,
    .btn-danger.btn-sm i {
        font-size: 14px;
    }

    /* --- Estilos para el modal --- */
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border-bottom: none;
        border-radius: 12px 12px 0 0;
    }

    .modal-footer {
        border-top: none;
        justify-content: space-between;
    }

    .modal .form-control {
        border-radius: 8px;
        box-shadow: none !important;
        border: 1px solid #ced4da;
    }

    .modal .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }

    /* --- Botones en modal --- */
    .modal-footer .btn-primary {
        border-radius: 8px;
        padding: 6px 20px;
        font-weight: 500;
    }

    .modal-footer .btn-secondary {
        border-radius: 8px;
        padding: 6px 20px;
    }
</style>

<!-- Script Modal Editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/categoria/update/${id}`;
                document.getElementById('edit-id').value = id;
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
                cancelButtonText: 'Cancelar'
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


<!-- Script para establecer la fecha actual en el campo de fecha  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes empieza desde 0
        const day = String(today.getDate()).padStart(2, '0');

        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    });
</script>
<?php if(session('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '<?php echo e(session("success")); ?>',
            confirmButtonColor: '#3085d6',
        });
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo e(session("error")); ?>',
            confirmButtonColor: '#d33',
        });
    });
</script>
<?php endif; ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#categoriaTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/categoria.blade.php ENDPATH**/ ?>