<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Seguimientos Plantas</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<h1 class="fw-bold mb-4">Seguimiento Plantas</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Seguimientos Plantas</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo seguimiento
            </button>
        </div>
        <div class="table-responsive">
            <table id="seguimientoplantatable" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>S/acuaponico</th>
                        <th>Cultivo</th>
                        <th>N° Plantas</th>
                        <th>Altura(cm)</th>
                        <th>Tonalidad</th>
                        <th>Crecimiento</th>
                        <th>Mortalidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $__currentLoopData = $seguimientoPlanta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($n++); ?></td>
                        <td class="text-center"><?php echo e($sp->Tracking->date); ?></td>
                        <td class="text-center"><?php echo e($sp->Tracking->aquaponicSystem->name ?? 'Sin sistema'); ?></td>
                        <td class="text-center"><?php echo e($sp->Tracking->crops->species->name); ?></td>
                        <td class="text-center"><?php echo e($sp->plant_count); ?></td>
                        <td class="text-center"><?php echo e($sp->height_cm); ?>cm</td>
                        <td class="text-center">
                            <span class="color-circle" style="background-color: <?php echo e($sp->color_tone); ?>;"></span>
                        </td>
                        <td class="text-center"><?php echo e($sp->growth); ?>cm</td>
                        <td class="text-center"><?php echo e($sp->mortality); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($sp->id); ?>"
                                data-aquaponic_system_id="<?php echo e($sp->Tracking->aquaponic_system_id); ?>"
                                data-tracking_id="<?php echo e($sp->tracking_id); ?>"
                                data-plant_count="<?php echo e($sp->plant_count); ?>"
                                data-height_cm="<?php echo e($sp->height_cm); ?>"
                                data-color_tone="<?php echo e($sp->color_tone); ?>"
                                data-growth="<?php echo e($sp->growth); ?>"
                                data-mortality="<?php echo e($sp->mortality); ?>"
                                data-toggle="modal"
                                data-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($sp->id); ?>">
                                Eliminar
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
                    <form id="formEditar" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Seguimiento Plantas</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit_aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                                <select class="form-control" id="edit_aquaponic_system_id" name="aquaponic_system_id" required>
                                    <option value="">Seleccione un sistema</option>
                                    <?php $__currentLoopData = $aquaponicSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-tracking_id" class="form-label">Cultivo seguimiento:</label>
                                <select class="form-control" id="edit_tracking_id" name="tracking_id" required>
                                    <option value="">Seleccione un seguimiento</option>
                                    <!-- Se cargará dinámicamente -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-plant_count" class="form-label">N° Plantas:</label>
                                <input type="number" class="form-control" id="edit-plant_count" name="plant_count" required>
                                <div class="invalid-feedback" id="error-plantas-edit"></div>
                            </div>
                            <div class="mb-3">
                                <label for="edit-height_cm" class="form-label">Altura (cm):</label>
                                <input type="number" class="form-control" name="height_cm" id="edit-height_cm" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tonalidad de la planta:</label>
                                <div class="d-flex gap-4">
                                    <?php
                                    $colores = [
                                        '#138713ff', // Verde oscuro
                                        '#a6d842ff', // Verde amarillento
                                        '#32dc32ff', // Verde claro
                                        '#1ccf00ff' // Verde normal
                                    ];
                                    ?>
                                    <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label>
                                        <input type="radio" name="color_tone" value="<?php echo e($color); ?>" required>
                                        <span class="color-circle" style="background-color: <?php echo e($color); ?>;"></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="edit-growth" class="form-label">Crecimiento:</label>
                                <input type="number" class="form-control" name="growth" id="edit-growth" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-mortality" class="form-label">Mortalidad:</label>
                                <input type="number" class="form-control" name="mortality" id="edit-mortality" readonly>
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarLabel">Eliminar Seguimiento</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este seguimiento?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storetrackingplant')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento Plantas</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="aquaponic_system_id">Sistema Acuapónico:</label>
                        <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione un sistema</option>
                            <?php $__currentLoopData = $aquaponicSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_id">Cultivo en seguimiento:</label>
                        <select name="tracking_id" id="tracking_id" class="form-control" required>
                            <option value="">Seleccione un seguimiento</option>
                            <!-- Se cargará dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="plant_count" class="form-label">N° Plantas:</label>
                        <input type="number" name="plant_count" class="form-control" id="plant_count" required>
                        <div class="invalid-feedback" id="error-plantas"></div>
                    </div>
                    <div class="mb-3">
                        <label for="height_cm" class="form-label">Altura (cm):</label>
                        <input type="number" name="height_cm" class="form-control" id="height_cm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tonalidad de la planta:</label>
                        <div class="d-flex gap-4">
                            <?php
                            $colores = [
                                '#138713ff', // Verde oscuro
                                '#a6d842ff', // Verde amarillento
                                '#32dc32ff', // Verde claro
                                '#1ccf00ff' // Verde normal
                            ];
                            ?>
                            <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label>
                                <input type="radio" name="color_tone" value="<?php echo e($color); ?>" required>
                                <span class="color-circle" style="background-color: <?php echo e($color); ?>;"></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="growth" class="form-label">Crecimiento:</label>
                        <input type="number" name="growth" class="form-control" id="growth" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mortality" class="form-label">Mortalidad:</label>
                        <input type="number" name="mortality" class="form-control" id="mortality" readonly>
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

<!-- Estilos para los círculos de color -->
<style>
    .color-circle {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
        margin-right: 8px;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked+.color-circle {
        border: 3px solid #000;
    }

    .color-circle:hover {
        transform: scale(1.1);
        border-color: #555;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lógica para el modal de agregar
        const aquaponicSystemId = document.getElementById('aquaponic_system_id');
        if (aquaponicSystemId) {
            aquaponicSystemId.addEventListener('change', function() {
                const systemId = this.value;
                const trackingSelect = document.getElementById('tracking_id');
                if (trackingSelect) {
                    trackingSelect.innerHTML = '<option value="">Seleccione un seguimiento</option>';
                    if (systemId) {
                        fetch(`/pasante/seguimientoPlanta/seguimientos/${systemId}`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.text = `${item.crops.species.name} - ${item.date}`;
                                    option.setAttribute('data-date', item.date);
                                    trackingSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching seguimientos:', error));
                    }
                }
            });
        }

        // Lógica para el modal de editar
        let editPlantasPrevias = 0;
        let editAlturaPrevia = 0;

        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const systemId = this.getAttribute('data-aquaponic_system_id');
                const trackingId = this.getAttribute('data-tracking_id');
                const plantCount = this.getAttribute('data-plant_count');
                const heightCm = this.getAttribute('data-height_cm');
                const growth = this.getAttribute('data-growth');
                const mortality = this.getAttribute('data-mortality');
                const colorTone = this.getAttribute('data-color_tone');

                const form = document.getElementById('formEditar');
                if (form) {
                    form.action = `/pasante/seguimientoPlanta/update/${id}`;
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit_aquaponic_system_id').value = systemId;
                    document.getElementById('edit-plant_count').value = plantCount;
                    document.getElementById('edit-height_cm').value = heightCm;
                    document.getElementById('edit-growth').value = growth;
                    document.getElementById('edit-mortality').value = mortality;

                    // Preseleccionar el color
                    const colorRadios = document.querySelectorAll('input[name="color_tone"]');
                    if (colorRadios) {
                        colorRadios.forEach(radio => {
                            radio.checked = radio.value === colorTone;
                        });
                    }

                    // Cargar seguimientos y preseleccionar
                    const editAquaponicSystem = document.getElementById('edit_aquaponic_system_id');
                    const editTrackingSelect = document.getElementById('edit_tracking_id');
                    if (editAquaponicSystem && editTrackingSelect) {
                        editAquaponicSystem.value = systemId;
                        editTrackingSelect.innerHTML = '<option value="">Cargando...</option>';

                        fetch(`/pasante/seguimientoPlanta/seguimientos/${systemId}`)
                            .then(res => res.json())
                            .then(data => {
                                editTrackingSelect.innerHTML = '<option value="">Seleccione un seguimiento</option>';
                                let trackingFound = false;
                                if (data.length === 0) {
                                    editTrackingSelect.innerHTML = '<option value="">No hay seguimientos para este sistema</option>';
                                } else {
                                    data.forEach(item => {
                                        const option = document.createElement('option');
                                        option.value = item.id;
                                        option.text = `${item.crops.species.name} - ${item.date}`;
                                        if (item.id == trackingId) {
                                            option.selected = true;
                                            trackingFound = true;
                                        }
                                        editTrackingSelect.appendChild(option);
                                    });
                                }
                                if (trackingFound && trackingId) {
                                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                                        .then(res => res.json())
                                        .then(data => {
                                            editPlantasPrevias = parseInt(data.plantas) || 0;
                                            editAlturaPrevia = parseFloat(data.altura) || 0;
                                            calcularEditar();
                                        })
                                        .catch(error => console.error('Error fetching prev data:', error));
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching seguimientos:', error);
                                editTrackingSelect.innerHTML = '<option value="">Error al cargar seguimientos</option>';
                            });
                    }
                }
            });
        });

        // Listener para actualizar campos al cambiar el seguimiento
        const editTrackingId = document.getElementById('edit_tracking_id');
        if (editTrackingId) {
            editTrackingId.addEventListener('change', function() {
                const trackingId = this.value;
                const editPlantCount = document.getElementById('edit-plant_count');
                const editHeightCm = document.getElementById('edit-height_cm');

                if (trackingId) {
                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                        .then(res => res.json())
                        .then(data => {
                            editPlantasPrevias = parseInt(data.plantas) || 0;
                            editAlturaPrevia = parseFloat(data.altura) || 0;
                            if (editPlantCount) editPlantCount.value = data.plantas || '';
                            if (editHeightCm) editHeightCm.value = data.altura || '';
                            calcularEditar();
                        })
                        .catch(error => console.error('Error fetching prev data:', error));
                } else {
                    editPlantasPrevias = 0;
                    editAlturaPrevia = 0;
                    if (editPlantCount) editPlantCount.value = '';
                    if (editHeightCm) editHeightCm.value = '';
                    calcularEditar();
                }
            });
        }

        // Escuchar cambios en los campos de entrada para recalcular
        ['edit-plant_count', 'edit-height_cm'].forEach(field => {
            const input = document.getElementById(field);
            if (input) {
                input.addEventListener('input', calcularEditar);
            }
        });

        // Función para calcular campos en edición
        function calcularEditar() {
            const editPlantCount = document.getElementById('edit-plant_count');
            const editHeightCm = document.getElementById('edit-height_cm');
            const editGrowth = document.getElementById('edit-growth');
            const editMortality = document.getElementById('edit-mortality');
            const errorPlantasEdit = document.getElementById('error-plantas-edit');

            if (!editPlantCount || !editHeightCm || !editGrowth || !editMortality || !errorPlantasEdit) {
                console.error('Uno o más elementos del DOM no están disponibles.');
                return false;
            }

            const actuales = parseInt(editPlantCount.value) || 0;
            const alturaActual = parseFloat(editHeightCm.value) || 0;

            const growth = (alturaActual - editAlturaPrevia).toFixed(2);
            editGrowth.value = growth > 0 ? growth : 0;

            const mortality = editPlantasPrevias - actuales > 0 ? editPlantasPrevias - actuales : 0;
            editMortality.value = mortality;

            if (actuales > editPlantasPrevias) {
                editPlantCount.classList.add('is-invalid');
                editPlantCount.classList.remove('is-valid');
                errorPlantasEdit.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${editPlantasPrevias})`;
                return false;
            } else {
                editPlantCount.classList.remove('is-invalid');
                editPlantCount.classList.add('is-valid');
                errorPlantasEdit.innerText = '';
                return true;
            }
        }

        // Validar formulario antes de enviar
        const editForm = document.querySelector('#editar form');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                if (!calcularEditar()) {
                    e.preventDefault();
                }
            });
        }

        // Lógica para el modal de eliminar
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
                        if (formEliminar) {
                            formEliminar.action = `/pasante/seguimientoPlanta/destroy/${id}`;
                            formEliminar.submit();
                        }
                    }
                });
            });
        });

        // Lógica para el modal de agregar
        let plantasPrevias = 0;
        let alturaPrevia = 0;

        const trackingIdSelect = document.getElementById('tracking_id');
        if (trackingIdSelect) {
            trackingIdSelect.addEventListener('change', function() {
                const trackingId = this.value;
                if (trackingId) {
                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                        .then(res => res.json())
                        .then(data => {
                            plantasPrevias = parseInt(data.plantas) || 0;
                            alturaPrevia = parseFloat(data.altura) || 0;
                            calcularAgregar();
                        })
                        .catch(error => console.error('Error fetching prev data:', error));
                }
            });

            document.getElementById('plant_count')?.addEventListener('input', calcularAgregar);
            document.getElementById('height_cm')?.addEventListener('input', calcularAgregar);

            function calcularAgregar() {
                const plantCount = document.getElementById('plant_count');
                const heightCm = document.getElementById('height_cm');
                const growth = document.getElementById('growth');
                const mortality = document.getElementById('mortality');
                const errorPlantas = document.getElementById('error-plantas');

                if (!plantCount || !heightCm || !growth || !mortality || !errorPlantas) {
                    console.error('Uno o más elementos del DOM no están disponibles.');
                    return;
                }

                const actuales = parseInt(plantCount.value) || 0;
                const alturaActual = parseFloat(heightCm.value) || 0;

                growth.value = (alturaActual - alturaPrevia).toFixed(2);
                mortality.value = (plantasPrevias - actuales > 0 ? plantasPrevias - actuales : 0);

                if (actuales > plantasPrevias) {
                    plantCount.classList.add('is-invalid');
                    plantCount.classList.remove('is-valid');
                    errorPlantas.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${plantasPrevias})`;
                } else {
                    plantCount.classList.remove('is-invalid');
                    plantCount.classList.add('is-valid');
                    errorPlantas.innerText = '';
                }
            }
        }
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
        $('#seguimientoplantatable').DataTable({
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

<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/seguimientoPlanta.blade.php ENDPATH**/ ?>