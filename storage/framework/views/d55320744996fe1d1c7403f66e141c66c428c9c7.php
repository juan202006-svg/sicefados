

<?php $__env->startPush('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Seguimientos Peces</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>

<h1 class="fw-bold mb-4">Seguimiento Peces</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Seguimientos</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo seguimiento
            </button>
        </div>
        <div class="table-responsive">
            <table id="seguimientopeztable" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Cultivo</th>
                        <th>N° Peces</th>
                        <th>Peso(gr)</th>
                        <th>Biomasa(gr)</th>
                        <th>Ganancia de peso(gr)</th>
                        <th>Mortalidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $__currentLoopData = $seguimientoPez; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($n++); ?></td>
                        <td class="text-center"><?php echo e($sp->Tracking->date); ?></td>
                        <td class="text-center"><?php echo e($sp->Tracking->crops->species->name); ?></td>
                        <td class="text-center"><?php echo e($sp->fish_count); ?></td>
                        <td class="text-center"><?php echo e($sp->weight_gr); ?>gr</td>
                        <td class="text-center"><?php echo e($sp->biomass_gr); ?>gr</td>
                        <td class="text-center"><?php echo e($sp->weight_gain_gr); ?>gr</td>
                        <td class="text-center"><?php echo e($sp->mortality); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($sp->id); ?>"
                                data-tracking_id="<?php echo e($sp->tracking_id); ?>"
                                data-fish_count="<?php echo e($sp->fish_count); ?>"
                                data-weight_gr="<?php echo e($sp->weight_gr); ?>"
                                data-biomass_gr="<?php echo e($sp->biomass_gr); ?>"
                                data-weight_gain_gr="<?php echo e($sp->weight_gain_gr); ?>"
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
                    <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updatetrackingfish', 0)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Seguimiento Peces</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-tracking_id" class="form-label">Cultivo seguimineto:</label>
                                <select class="form-control" id="edit-tracking_id" name="tracking_id" required>
                                    <option value="">Seleccione un seguimiento</option>
                                    <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($seguimiento->id); ?>"
                                        data-peces="<?php echo e(optional($seguimiento->latestFishTracking)->fish_count ?? $seguimiento->crops->quantity); ?>"
                                        data-peso="<?php echo e(optional($seguimiento->latestFishTracking)->weight_gr ?? 0); ?>">
                                        <?php echo e($seguimiento->crops->species->name); ?> - <?php echo e($seguimiento->date); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-fish_count" class="form-label"> N° Peces: </label>
                                <input type="number" class="form-control" name="fish_count" id="edit-fish_count" required>
                                <div class="invalid-feedback" id="edit-error-peces"></div>

                            </div>
                            <div class="mb-3">
                                <label for="edit-weight_gr" class="form-label"> Peso (gr): </label>
                                <input type="number" class="form-control" name="weight_gr" id="edit-weight_gr" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-biomass_gr" class="form-label"> Biomasa (gr): </label>
                                <input type="number" class="form-control" name="biomass_gr" id="edit-biomass_gr" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-weight_gain_gr" class="form-label"> Ganacia de peso(gr): </label>
                                <input type="number" class="form-control" name="weight_gain_gr" id="edit-weight_gain_gr" readonly>
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
        <form action="<?php echo e(route ('acuaponico.pasante.pasante.storetrackingfish')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento peces</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tracking_id">Cultivo en seguimiento:</label>
                        <select name="tracking_id" id="tracking_id" class="form-control" required>
                            <option value="">Seleccione un seguimiento</option>
                            <?php $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seguimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($seguimiento->id); ?>"
                                data-peces="<?php echo e(optional($seguimiento->latestFishTracking)->fish_count ?? $seguimiento->crops->quantity); ?>"
                                data-peso="<?php echo e(optional($seguimiento->latestFishTracking)->weight_gr ?? 0); ?>">
                                <?php echo e($seguimiento->crops->species->name); ?> - <?php echo e($seguimiento->date); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fish_count" class="form-label">N° Peces:</label>
                        <input type="number" name="fish_count" class="form-control" id="fish_count" required>
                        <div class="invalid-feedback" id="error-peces"></div>
                    </div>
                    <div class="mb-3">
                        <label for="weight_gr" class="form-label">Peso Promedio (gr):</label>
                        <input type="number" name="weight_gr" class="form-control" id="weight_gr" required>
                    </div>
                    <div class="mb-3">
                        <label for="biomass_gr" class="form-label">Biomasa (gr):</label>
                        <input type="number" name="biomass_gr" class="form-control" id="biomass_gr" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="weight_gain_gr" class="form-label">Ganancia de peso (gr):</label>
                        <input type="number" name="weight_gain_gr" class="form-control" id="weight_gain_gr" readonly>
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
<!-- Script para calcular biomasa, ganancia de peso y mortalidad  a la hora de agregar-->
<script>
    let pecesPrevios = 0;
    let pesoPrevio = 0;

    document.getElementById('tracking_id').addEventListener('change', function() {
        const trackingId = this.value;

        if (trackingId) {
            fetch(`/pasante/seguimientoPez/prevdata/${trackingId}`)
                .then(response => response.json())
                .then(data => {
                    pecesPrevios = parseInt(data.peces) || 0;
                    pesoPrevio = parseFloat(data.peso) || 0;
                    calcularCampos();
                });
        }
    });

    document.getElementById('fish_count').addEventListener('input', calcularCampos);
    document.getElementById('weight_gr').addEventListener('input', calcularCampos);

    function calcularCampos() {
        const pecesActuales = parseInt(document.getElementById('fish_count').value) || 0;
        const pesoActual = parseFloat(document.getElementById('weight_gr').value) || 0;

        const inputPeces = document.getElementById('fish_count');
        const errorMsg = document.getElementById('error-peces');

        if (pecesActuales > pecesPrevios) {
            inputPeces.classList.add('is-invalid');
            errorMsg.innerText = `No puede ingresar más peces (${pecesActuales}) que los registrados anteriormente (${pecesPrevios}).`;
        } else {
            inputPeces.classList.remove('is-invalid');
            errorMsg.innerText = '';
        }

        document.getElementById('biomass_gr').value = (pesoActual * pecesActuales).toFixed(2);
        document.getElementById('weight_gain_gr').value = (pesoActual - pesoPrevio).toFixed(2);
        document.getElementById('mortality').value = (pecesPrevios - pecesActuales > 0 ? pecesPrevios - pecesActuales : 0);
    }
</script>
<!-- Script combinado para modal de editar seguimiento de peces -->
<script>
    let editPecesPrevios = 0;
    let editPesoPrevio = 0;

    document.addEventListener('DOMContentLoaded', function() {
        // Al hacer clic en el botón de editar
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/seguimientoPez/update/${id}`;
                document.getElementById('edit-id').value = id;

                // Cargar valores al formulario
                const trackingId = this.getAttribute('data-tracking_id');
                document.getElementById('edit-tracking_id').value = trackingId;
                document.getElementById('edit-fish_count').value = this.getAttribute('data-fish_count');
                document.getElementById('edit-weight_gr').value = this.getAttribute('data-weight_gr');
                document.getElementById('edit-biomass_gr').value = this.getAttribute('data-biomass_gr');
                document.getElementById('edit-weight_gain_gr').value = this.getAttribute('data-weight_gain_gr');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');

                // Disparar evento change para que cargue los datos previos
                document.getElementById('edit-tracking_id').dispatchEvent(new Event('change'));
            });
        });

        // Evento al cambiar el seguimiento (tracking)
        document.getElementById('edit-tracking_id').addEventListener('change', function() {
            const trackingId = this.value;

            if (trackingId) {
                fetch(`/pasante/seguimientoPez/prevdata/${trackingId}`)
                    .then(response => response.json())
                    .then(data => {
                        editPecesPrevios = parseInt(data.peces) || 0;
                        editPesoPrevio = parseFloat(data.peso) || 0;
                        calcularCamposEdit();
                    });
            }
        });

        // Eventos al cambiar cantidad de peces o peso
        document.getElementById('edit-fish_count').addEventListener('input', calcularCamposEdit);
        document.getElementById('edit-weight_gr').addEventListener('input', calcularCamposEdit);

        // Función para calcular campos derivados
        function calcularCamposEdit() {
            const pecesActuales = parseInt(document.getElementById('edit-fish_count').value) || 0;
            const pesoActual = parseFloat(document.getElementById('edit-weight_gr').value) || 0;

            const inputPeces = document.getElementById('edit-fish_count');
            const errorMsg = document.getElementById('edit-error-peces');

            if (pecesActuales > editPecesPrevios) {
                inputPeces.classList.add('is-invalid');
                errorMsg.innerText = `No puede ingresar más peces (${pecesActuales}) que los registrados anteriormente (${editPesoPrevio}).`;
            } else {
                inputPeces.classList.remove('is-invalid');
                errorMsg.innerText = '';
            }

            document.getElementById('edit-biomass_gr').value = (pesoActual * pecesActuales).toFixed(2);
            document.getElementById('edit-weight_gain_gr').value = (pesoActual - editPesoPrevio).toFixed(2);
            document.getElementById('edit-mortality').value = (editPecesPrevios - pecesActuales > 0 ? editPecesPrevios - pecesActuales : 0);
        }
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

<!-- Script para eliminar seguimiento -->
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
                    formEliminar.action = `/pasante/seguimientoPez/destroy/${id}`;
                    formEliminar.submit();
                }
            });
        });
    });
</script>


<!-- Script para calcular los días transcurridos desde la fecha del cultivo -->
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
        $('#seguimientopeztable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/seguimientoPeces.blade.php ENDPATH**/ ?>