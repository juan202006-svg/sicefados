<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Especies</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<h1 class="fw-bold mb-4">Gestión de Especies</h1>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de especies</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva Especie
            </button>
        </div>
        <div class="table-responsive">
            <div class="card-body">
                <table id="especiesTable" class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Nombre Cientifico</th>
                            <th>Nombre Comun</th>
                            <th>Imagen</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($n++); ?></td>
                            <td class="text-center"><?php echo e($especie->category->name?? 'Sin categoría'); ?></td>
                            <td class="text-center"><?php echo e($especie->scientific_name); ?></td>
                            <td class="text-center"><?php echo e($especie->name); ?></td>
                            <td class="text-center">
                                <?php if($especie->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/especies/' . $especie->image)); ?>" alt="Imagen de la especie" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($especie->description ?? 'Sin descripción'); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="<?php echo e($especie->id); ?>"
                                    data-category_id="<?php echo e($especie->category_id); ?>"
                                    data-scientific_name="<?php echo e($especie->scientific_name); ?>"
                                    data-name="<?php echo e($especie->name); ?>"
                                    data-image="<?php echo e($especie->image); ?>"
                                    data-description="<?php echo e($especie->description); ?>"
                                    data-toggle="modal"
                                    data-target="#editar">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($especie->id); ?>">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Inicio de modal de editar-->
        <div class="modal fade " id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updatespecies', 0)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Especies</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-category_id" class="form-label">Categoría:</label>
                                <select class="form-control" id="edit-category_id" name="category_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-scientific_name" class="form-label"> Nombre Cientifico: </label>
                                <input type="text" class="form-control" id="edit-scientific_name" name="scientific_name">
                            </div>
                            <div class="mb-3">
                                <label for="edit-name" class="form-label"> Nombre Comun: </label>
                                <input type="text" class="form-control" id="edit-name" name="name">
                            </div>
                            <div class="mb-3 text-center">
                                <label class="form-label">Imagen actual:</label><br>
                                <img id="edit-preview-image" src="" alt="Imagen de la especie" class="img-fluid mb-2" style="max-width: 100px; max-height: 100px;">
                            </div>
                            <div class="mb-3">
                                <label for="edit-image" class="form-label">Cambiar imagen:</label>
                                <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="edit-description" class="form-label">Descripción (Opcional): </label>
                                <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--termina modal de editar-->
        <!--Inicia modal de eliminar-->
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
<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storespecies')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nueva Especie</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoty_id">Categoria:</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Seleccione una categoria</option>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="scientific_name" class="form-label">Nombre Cientifico: </label>
                        <input type="text" name="scientific_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Comun: </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen: </label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción (Opcional): </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
    </div>
    </form>
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
<!--script del modal editar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/especie/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-category_id').value = this.getAttribute('data-category_id');
                document.getElementById('edit-scientific_name').value = this.getAttribute('data-scientific_name');
                document.getElementById('edit-name').value = this.getAttribute('data-name');

                const image = this.getAttribute('data-image');
                document.getElementById('edit-preview-image').src = image ? `/modules/acuaponico/images/especies/${image}` : '';
                document.getElementById('edit-description').value = this.getAttribute('data-description');
            });
        });

    });
</script>
<!-- Script Modal Eliminar -->
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
                    formEliminar.action = `/pasante/especie/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#especiesTable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/especies.blade.php ENDPATH**/ ?>