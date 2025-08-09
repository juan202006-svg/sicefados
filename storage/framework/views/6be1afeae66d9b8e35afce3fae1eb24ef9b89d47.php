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
                        <th>Cultivo</th>
                        <th>N° Plantas</th>
                        <th>Altura(cm)</th>
                        <th>Crecimiento</th>
                        <th>Rendimiento(%)</th>
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
                        <td class="text-center"><?php echo e($sp->Tracking->crops->species->name); ?></td>
                        <td class="text-center"><?php echo e($sp->plant_count); ?></td>
                        <td class="text-center"><?php echo e($sp->height_cm); ?>cm</td>
                        <td class="text-center"><?php echo e($sp->growth); ?>cm</td>
                        <td class="text-center"><?php echo e($sp->comparison_percentage); ?>%</td>
                        <td class="text-center"><?php echo e($sp->mortality); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($sp->id); ?>"
                                data-tracking_id="<?php echo e($sp->tracking_id); ?>"
                                data-plant_count="<?php echo e($sp->plant_count); ?>"
                                data-height_cm="<?php echo e($sp->height_cm); ?>"
                                data-growth="<?php echo e($sp->growth); ?>"
                                data-comparison_percentage="<?php echo e($sp->comparison_percentage); ?>"
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
        <!-- Inicio de modal de editar-->
        <div class="modal fade " id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
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
                                <label for="edit-tracking_id" class="form-label">Cultivo seguimiento:</label>
                                <select class="form-control" id="edit-tracking_id" name="tracking_id" required>
                                    <option value="">Seleccione un seguimiento</option>
                                    <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($seguimiento->id); ?>">
                                        <?php echo e($seguimiento->crops->species->name); ?> - <?php echo e($seguimiento->date); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-plant_count" class="form-label"> N° Plantas: </label>
                                <input type="number" class="form-control" id="edit-plant_count" name="plant_count" required>
                                <div class="invalid-feedback" id="error-plantas-edit"></div>
                            </div>
                            <div class="mb-3">
                                <label for="edit-height_cm" class="form-label"> Altura (cm): </label>
                                <input type="number" class="form-control" name="height_cm" id="edit-height_cm" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-growth" class="form-label"> Crecimiento: </label>
                                <input type="number" class="form-control" name="growth" id="edit-growth" readonly>
                                <div class="mb-3">
                                    <label for="edit-comparison_percentage" class="form-label"> Rendimiento (%): </label>
                                    <input type="number" class="form-control" name="comparison_percentage" id="edit-comparison_percentage" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-mortality" class="form-label"> Mortalidad: </label>
                                    <input type="number" class="form-control" name="mortality" id="edit-mortality" readonly>
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
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storetrackingplant')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento plantas</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tracking_id">Cultivo en seguimiento:</label>
                        <select name="tracking_id" id="tracking_id" class="form-control" required>
                            <option value="">Seleccione un seguimiento</option>
                            <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($seguimiento->id); ?>">
                                <?php echo e($seguimiento->crops->species->name); ?> - <?php echo e($seguimiento->date); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <label for="growth" class="form-label">Crecimiento:</label>
                        <input type="number" name="growth" class="form-control" id="growth" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="comparison_percentage" class="form-label">Rendimiento (%):</label>
                        <input type="number" name="comparison_percentage" class="form-control" id="comparison_percentage" readonly>
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
                document.getElementById('formEditar').action = `/pasante/seguimientoPlanta/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-tracking_id').value = this.getAttribute('data-tracking_id');
                document.getElementById('edit-plant_count').value = this.getAttribute('data-plant_count');
                document.getElementById('edit-height_cm').value = this.getAttribute('data-height_cm');
                document.getElementById('edit-growth').value = this.getAttribute('data-growth');
                document.getElementById('edit-comparison_percentage').value = this.getAttribute('data-comparison_percentage');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
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
                    formEliminar.action = `/pasante/seguimientoPlanta/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#tabla-seguimientopez').DataTable({
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
    // Agregar
    let plantasPrevias = 0;
    let alturaPrevia = 0;

    document.getElementById('tracking_id').addEventListener('change', function() {
        const trackingId = this.value;
        if (trackingId) {
            fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                .then(res => res.json())
                .then(data => {
                    plantasPrevias = parseInt(data.plantas) || 0;
                    alturaPrevia = parseFloat(data.altura) || 0;
                    calcularAgregar();
                });
        }
    });

    document.getElementById('plant_count').addEventListener('input', calcularAgregar);
    document.getElementById('height_cm').addEventListener('input', calcularAgregar);

    function calcularAgregar() {
        const actuales = parseInt(document.getElementById('plant_count').value) || 0;
        const alturaActual = parseFloat(document.getElementById('height_cm').value) || 0;

        // Calcular y mostrar valores
        document.getElementById('growth').value = (alturaActual - alturaPrevia).toFixed(2);
        document.getElementById('comparison_percentage').value = (alturaPrevia > 0 ? (alturaActual / alturaPrevia * 100).toFixed(2) : 0);
        document.getElementById('mortality').value = (plantasPrevias - actuales > 0 ? plantasPrevias - actuales : 0);

        // Validar número de plantas
        const input = document.getElementById('plant_count');
        const error = document.getElementById('error-plantas');

        if (actuales > plantasPrevias) {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            error.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${plantasPrevias}).`;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            error.innerText = '';
        }
    }


    // Editar
    let editPlantasPrevias = 0;
    let editAlturaPrevia = 0;

    document.getElementById('edit-tracking_id').addEventListener('change', function() {
        const trackingId = this.value;
        if (trackingId) {
            fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                .then(res => res.json())
                .then(data => {
                    editPlantasPrevias = parseInt(data.plantas) || 0;
                    editAlturaPrevia = parseFloat(data.altura) || 0;
                    calcularEditar();
                });
        }
    });

    document.getElementById('edit-plant_count').addEventListener('input', calcularEditar);
    document.getElementById('edit-height_cm').addEventListener('input', calcularEditar);

    function calcularEditar() {
        const actuales = parseInt(document.getElementById('edit-plant_count').value) || 0;
        const alturaActual = parseFloat(document.getElementById('edit-height_cm').value) || 0;

        // Calcular y mostrar valores
        document.getElementById('edit-growth').value = (alturaActual - editAlturaPrevia).toFixed(2);
        document.getElementById('edit-comparison_percentage').value = (editAlturaPrevia > 0 ? (alturaActual / editAlturaPrevia * 100).toFixed(2) : 0);
        document.getElementById('edit-mortality').value = (editPlantasPrevias - actuales > 0 ? editPlantasPrevias - actuales : 0);

        // Validar número de plantas
        const input = document.getElementById('edit-plant_count');
        const error = document.getElementById('error-plantas-edit');

        if (actuales > editPlantasPrevias) {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            error.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${editPlantasPrevias}).`;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            error.innerText = '';
        }
    }


    // Al abrir el modal editar, cargar los valores previos automáticamente
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const trackingId = this.getAttribute('data-tracking_id');
                fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                    .then(res => res.json())
                    .then(data => {
                        editPlantasPrevias = parseInt(data.plantas) || 0;
                        editAlturaPrevia = parseFloat(data.altura) || 0;
                        calcularEditar();
                    });
            });
        });
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