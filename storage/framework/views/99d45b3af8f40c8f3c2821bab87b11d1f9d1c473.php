

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Lotes</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<h1 class="fw-bold mb-4">Gestión de Lotes</h1>

<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Lotes</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createLot">
                <i class="bi bi-plus-circle"></i> Nuevo Lote
            </button>
        </div>
        <div class="table-responsive">
            <div class="card-body">
                <table id="lotesTable" class="table table-hover table-bordered align-middle text-center" style="width:100%">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Código</th>
                            <th>S/Acuapónico</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Ocupado</th>
                            <th>Disponible</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($n++); ?></td>
                            <td class="text-center"><?php echo e($lot->aquaponicSystem->name ?? 'sin lote'); ?></td>
                            <td class="text-center"><?php echo e($lot->date); ?></td>
                            <td class="text-center"><?php echo e($lot->name); ?></td>
                            <td class="text-center"><?php echo e($lot->capacity); ?></td>
                            <td class="text-center">
                                <?php if($lot->image): ?>
                                <img src="<?php echo e(asset('modules/acuaponico/images/lotes/' . $lot->image)); ?>" alt="Imagen del lote" style="max-width: 100px; max-height: 100px;">
                                <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if( $lot->description ): ?>
                                <span><?php echo e($lot->description); ?></span>
                                <?php else: ?>
                                <span class="text-muted">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($lot->ocupado); ?></td>
                            <td class="text-center">
                                <?php if($lot->disponible > 0): ?>
                                <span class="badge bg-success"><?php echo e($lot->disponible); ?></span>
                                <?php else: ?>
                                <span class="badge bg-danger">0</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($lot->state); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="<?php echo e($lot->id); ?>"
                                    data-aquaponic_system_id="<?php echo e($lot->aquaponic_system_id); ?>"
                                    data-date="<?php echo e($lot->date); ?>"
                                    data-name="<?php echo e($lot->name); ?>"
                                    data-capacity="<?php echo e($lot->capacity); ?>"
                                    data-image="<?php echo e($lot->image); ?>"
                                    data-description="<?php echo e($lot->description); ?>"
                                    data-state="<?php echo e($lot->state); ?>"
                                    data-ocupado="<?php echo e($lot->ocupado); ?>"
                                    data-toggle="modal"
                                    data-target="#updateLot">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($lot->id); ?>">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación -->
<div class="modal fade" id="createLot" tabindex="-1" aria-labelledby="createLotLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storeLot')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createLotLabel">Nuevo Lote</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                      <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                        <select name="aquaponic_system_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                            <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidad:</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen:</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">Estado:</label>
                        <select name="state" class="form-control" required>
                            <option value="disponible">Disponible</option>
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

<!-- Modal de edición -->
<div class="modal fade" id="updateLot" tabindex="-1" aria-labelledby="updateLotLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateLot', 0)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="updateLotLabel">Editar Lote</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                        <select class="form-control" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                            <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-capacity" class="form-label">Capacidad:</label>
                        <input type="number" class="form-control" id="edit-capacity" name="capacity">
                        <div class="invalid-feedback" id="error-capacidad-lote"></div>
                    </div>
                    <div class="mb-3 text-center">
                        <label class="form-label">Imagen actual:</label><br>
                        <img id="edit-preview-image" src="" alt="Imagen del lote" class="img-fluid mb-2" style="max-width: 100px; max-height: 100px;">
                    </div>
                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Imagen:</label>
                        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-state" class="form-label">Estado:</label>
                        <select class="form-control" id="edit-state" name="state" required>
                            <option value="disponible">Disponible</option>
                            <option value="no disponible">No Disponible</option>
                        </select>
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

<!-- Modal de eliminar -->
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

<!-- Script del modal editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formEdit = document.getElementById('formEditar');
        const inputCapacity = document.getElementById('edit-capacity');
        const errorDiv = document.getElementById('error-capacidad-lote');

        let capacidadOcupada = 0;

        // Validación en vivo
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
                const aquaponicSystemId = this.getAttribute('data-aquaponic_system_id');
                const date = this.getAttribute('data-date');
                const name = this.getAttribute('data-name');
                const capacity = this.getAttribute('data-capacity');
                const image = this.getAttribute('data-image');
                document.getElementById('edit-preview-image').src = image ? `/modules/acuaponico/images/lotes/${image}` : '';
                const description = this.getAttribute('data-description');
                document.getElementById('edit-description').value = description;
                const state = this.getAttribute('data-state');
                capacidadOcupada = Number(this.getAttribute('data-ocupado')) || 0;

                const estadoSelect = document.getElementById('edit-state');

                // Rellenar formulario
                formEdit.action = `/pasante/lote/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                inputCapacity.value = capacity;

                // Validación de capacidad ocupada
                if (Number(capacity) < capacidadOcupada) {
                    inputCapacity.classList.add('is-invalid');
                    errorDiv.innerText = `No puedes asignar una capacidad menor a la cantidad ya ocupada (${capacidadOcupada} unidades).`;
                } else {
                    inputCapacity.classList.remove('is-invalid');
                    errorDiv.innerText = '';
                }

                // Estado
                estadoSelect.removeAttribute('disabled');
                if (state.toLowerCase() === "ocupado" || (state.toLowerCase() === "disponible" && capacidadOcupada > 0)) {
                    estadoSelect.innerHTML = `<option value="${state}" selected>${state.charAt(0).toUpperCase() + state.slice(1)}</option>`;
                    estadoSelect.setAttribute('disabled', 'disabled');
                } else {
                    estadoSelect.innerHTML = `<option value="disponible" ${state === 'disponible' ? 'selected' : ''}>Disponible</option>
                <option value="no disponible" ${state === 'no disponible' ? 'selected' : ''}>No Disponible</option>`;
                }
            });
        });

        // Validación al enviar
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
                cancelButtonText: 'Cancelar'
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


<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#lotesTable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registrolote.blade.php ENDPATH**/ ?>