<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Seguimientos generales</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>

<h1 class="fw-bold mb-4">Gestión de Seguimientos</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Seguimientos</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo seguimiento
            </button>
        </div>
        <div class="table-responsive">
            <table id="seguimientosTable" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Código</th>
                        <th>Sistema Acuapónico</th>
                        <th>Fecha</th>
                        <th>Cultivo/Resiembra</th>
                        <th>Tipo</th>
                        <th>Tiempo (días)</th>
                        <th>Novedades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $__empty_1 = true; $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center"><?php echo e($n++); ?></td>
                        <td class="text-center">
                            <?php if($seguimiento->subject_type === 'crop'): ?>
                            <?php echo e($seguimiento->crops->aquaponicSystem->name ?? 'N/A'); ?>

                            <?php else: ?>
                            <?php echo e($seguimiento->subject->aquaponicSystem->name ?? 'N/A'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($seguimiento->date); ?></td>
                        <td class="text-center">
                            <?php if($seguimiento->subject_type === 'crop'): ?>
                            <?php echo e($seguimiento->crops->species->name ?? 'N/A'); ?>

                            <?php else: ?>
                            <?php echo e($seguimiento->subject->crops->species->name ?? 'N/A'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($seguimiento->subject_type === 'crop'): ?>
                            <span class="badge badge-primary">Cultivo</span>
                            <?php else: ?>
                            <span class="badge badge-warning">Resiembra</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($seguimiento->days_elapsed); ?></td>
                        <td class="text-center"><?php echo e(Str::limit($seguimiento->notes, 50)); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($seguimiento->id); ?>"
                                data-aquaponic_system_id="<?php echo e($seguimiento->aquaponic_system_id); ?>"
                                data-date="<?php echo e($seguimiento->date); ?>"
                                data-crop_id="<?php echo e($seguimiento->subject_id); ?>"
                                data-subject_type="<?php echo e($seguimiento->subject_type); ?>"
                                data-subject_id="<?php echo e($seguimiento->subject_id); ?>"
                                data-days_elapsed="<?php echo e($seguimiento->days_elapsed); ?>"
                                data-notes="<?php echo e($seguimiento->notes); ?>"
                                data-toggle="modal"
                                data-target="#editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($seguimiento->id); ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay seguimientos registrados</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Inicio de modal de editar-->
        <div class="modal fade " id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="<?php echo e(route ('acuaponico.pasante.pasante.updatetracking',0)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Seguimiento</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                                <label for="edit-aquaponic_system_id">S/acuaponico:</label>
                                <select id="edit-aquaponic_system_id" name="aquaponic_system_id" class="form-control" required>
                                    <option value="">Seleccione un sistema acuapónico</option>
                                    <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-crop_id" class="form-label">Cultivo:</label>
                                <select class="form-control" id="edit-crop_id" name="crop_id" required>
                                    <option value="">Seleccione un cultivo</option>
                                    <?php $__currentLoopData = $cultivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cultivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cultivo->id); ?>" data-date="<?php echo e($cultivo->date); ?>"
                                        data-system="<?php echo e($cultivo->aquaponic_system_id); ?>"><?php echo e($cultivo->species->name ?? 'no hay cultivos'); ?> - <?php echo e($cultivo->status); ?></option>
                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-days_elapsed" class="form-label"> Tiempo en dias: </label>
                                <input type="number" class="form-control" id="edit-days_elapsed" name="days_elapsed" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-notes" class="form-label"> Novedad: </label>
                                <textarea class="form-control" name="notes" id="edit-notes"></textarea>
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
        <form action="<?php echo e(route ('acuaponico.pasante.pasante.storetracking')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="aquaponic_system_id">S/acuaponico:</label>
                        <select id="aquaponic_system_id" name="aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione un sistema acuapónico</option>
                            <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="crop_id">Cultivo/Resiembra:</label>
                        <select name="crop_id" id="crop_id" class="form-control" required>
                            <option value="">Seleccione un cultivo o resiembra</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="item_type" class="form-label">Tipo:</label>
                        <input type="text" id="item_type" class="form-control" readonly>
                    </div>
                    <!-- Campos ocultos para el tipo de sujeto -->
                    <input type="hidden" name="subject_type" id="subject_type">
                    <input type="hidden" name="subject_id" id="subject_id">
                    <div class=" mb-3">
                        <label for="days_elapsed" class="form-label">Tiempo en dias:</label>
                        <input type="number" name="days_elapsed" class="form-control" id="days_elapsed" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Novedad:</label>
                        <textarea name="notes" class="form-control" id="notes" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
        </form>
    </div>
</div>

<!-- Script para el metodo de ajax para cargar los cultivos y las resiembras  -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Cuando cambia el sistema acuapónico
    document.getElementById('aquaponic_system_id').addEventListener('change', function () {
        let systemId = this.value;
        let cropSelect = document.getElementById('crop_id');
        cropSelect.innerHTML = '<option value="">Seleccione un cultivo o resiembra</option>';

        if (!systemId) return;

        fetch(`/pasante/seguimiento/subjects/${systemId}`)
            .then(response => response.json())
            .then(data => {
                // Agregar cultivos
                data.crops.forEach(crop => {
                    cropSelect.innerHTML += `<option value="crop-${crop.id}">Cultivo: ${crop.name} (${crop.status})</option>`;
                });

                // Agregar resiembras
                data.resowings.forEach(res => {
                    cropSelect.innerHTML += `<option value="resowing-${res.id}">Resiembra: ${res.description} (${res.status})</option>`;
                });
            })
            .catch(err => console.error('Error cargando datos:', err));
    });

    // Cuando el usuario selecciona un cultivo o resiembra
    document.getElementById('crop_id').addEventListener('change', function () {
        let value = this.value;
        if (!value) return;

        let [type, id] = value.split('-');
        
        // Guardar en los campos ocultos
        document.getElementById('subject_type').value = type;
        document.getElementById('subject_id').value = id;

        // Mostrar el tipo en el campo visible
        document.getElementById('item_type').value = type === 'crop' ? 'Cultivo' : 'Resiembra';
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

<!--script del modal editar-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/seguimiento/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-aquaponic_system_id').value = this.getAttribute('date-aquaponic_system_id');
                document.getElementById('edit-crop_id').value = this.getAttribute('data-crop_id');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');
            });
        });
    });
</script>
<!--script para mostrar los tiempos en dias en el campo al selecionar otro cultivo a la hora de editar-->
<script>
    document.getElementById('edit-crop_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fechaCultivo = selectedOption.getAttribute('data-date');

        if (fechaCultivo) {
            const fechaInicio = new Date(fechaCultivo);
            const fechaHoy = new Date();
            const diffTiempo = fechaHoy - fechaInicio;
            const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

            document.getElementById('edit-days_elapsed').value = diffDias;
        } else {
            document.getElementById('edit-days_elapsed').value = '';
        }
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
                    formEliminar.action = `/pasante/seguimiento/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<script>
    document.getElementById('crop_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fechaCultivo = selectedOption.getAttribute('data-date');

        if (fechaCultivo) {
            const fechaInicio = new Date(fechaCultivo);
            const fechaHoy = new Date();

            const diffTiempo = fechaHoy - fechaInicio;
            const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));

            // Asignar al campo
            document.getElementById('days_elapsed').value = diffDias;
        } else {
            document.getElementById('days_elapsed').value = '';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function setupSystemCropDependency(systemSelectId, cropSelectId, daysInputId = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const cropSelect = document.getElementById(cropSelectId);
            if (!systemSelect || !cropSelect) return;

            // Guardar todas las opciones al iniciar
            const allOptions = Array.from(cropSelect.options).slice(1); // Omitir "Seleccione un cultivo"

            systemSelect.addEventListener('change', function() {
                const selectedSystemId = this.value;

                cropSelect.innerHTML = '<option value="">Seleccione un cultivo</option>';

                allOptions.forEach(option => {
                    if (option.getAttribute('data-system') === selectedSystemId) {
                        cropSelect.appendChild(option.cloneNode(true)); // importante: clonar para evitar remover de otros selects
                    }
                });

                if (daysInputId) {
                    const daysInput = document.getElementById(daysInputId);
                    if (daysInput) daysInput.value = '';
                }
            });
        }

        // Agregar (modal nuevo)
        setupSystemCropDependency('aquaponic_system_id', 'crop_id', 'days_elapsed');

        // Editar (modal editar)
        setupSystemCropDependency('edit-aquaponic_system_id', 'edit-crop_id', 'edit-days_elapsed');
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
        $('#seguimientosTable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/seguimiento.blade.php ENDPATH**/ ?>