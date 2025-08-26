

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Seguimiento Resiembra</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<h1 class="fw-bold mb-4">Seguimientos Resiembras</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Seguimientos de resiembras</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo seguimiento
            </button>
        </div>
        <div class="table-responsive">
            <table id="seguimientoresiembra" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>S/acuapónico</th>
                        <th>Resiembra</th>
                        <th>N° Plantas</th>
                        <th>Tonalidad</th>
                        <th>Altura(cm)</th>
                        <th>Tiempo(dias)</th>
                        <th>Crecimiento</th>
                        <th>Mortalidad</th>
                        <th>Novedades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $__currentLoopData = $seguimiento_resiembra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($n++); ?></td>
                        <td class="text-center"><?php echo e($sr->date); ?></td>
                        <td class="text-center"><?php echo e($sr->aquaponicSystem->name ?? 'Sin sistema'); ?></td>
                        <td class="text-center"><?php echo e($sr->resowing->crops->species->name ?? 'Sin cultivo'); ?></td>
                        <td class="text-center"><?php echo e($sr->plant_count); ?></td>
                        <td class="text-center">
                            <span class="color-circle" style="background-color: <?php echo e($sr->color_tone); ?>;"></span>
                        </td>
                        <td class="text-center"><?php echo e($sr->height_cm); ?>cm</td>
                        <td class="text-center"><?php echo e($sr->days_elapsed); ?></td>
                        <td class="text-center"><?php echo e($sr->growth); ?>cm</td>
                        <td class="text-center"><?php echo e($sr->mortality); ?></td>
                        <td class="text-center"><?php echo e($sr->notes ?? 'sin novedades'); ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($sr->id); ?>"
                                data-aquaponic_system_id="<?php echo e($sr->aquaponic_system_id); ?>"
                                data-resowing_id="<?php echo e($sr->resowing_id); ?>"
                                data-plant_count="<?php echo e($sr->plant_count); ?>"
                                data-color_tone="<?php echo e($sr->color_tone); ?>"
                                data-height_cm="<?php echo e($sr->height_cm); ?>"
                                data-days_elapsed="<?php echo e($sr->days_elapsed); ?>"
                                data-growth="<?php echo e($sr->growth); ?>"
                                data-mortality="<?php echo e($sr->mortality); ?>"
                                data-notes="<?php echo e($sr->notes); ?>"
                                data-date="<?php echo e($sr->date); ?>"
                                data-resowing_date="<?php echo e($sr->resowing->date); ?>"
                                data-toggle="modal"
                                data-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($sr->id); ?>">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- Modal de Editar -->
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateresowingtracking', 0)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Seguimiento Resiembras</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-aquaponic_system_id" class="form-label">Sistema acuapónico:</label>
                                <select class="form-control" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                                    <option value="">Seleccione el sistema</option>
                                    <?php $__currentLoopData = $sistema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-resowing_id" class="form-label">Resiembra:</label>
                                <select class="form-control" id="edit-resowing_id" name="resowing_id" required>
                                    <option value="">Seleccione una resiembra</option>
                                    <?php $__currentLoopData = $resiembras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($r->id); ?>"
                                        data-system="<?php echo e($r->aquaponic_system_id); ?>"
                                        data-date="<?php echo e($r->date); ?>"
                                        data-total_quantity="<?php echo e($r->total_quantity); ?>"
                                        data-status="<?php echo e($r->status); ?>">
                                        <?php echo e($r->crops->species->name ?? 'Sin cultivo'); ?> - <?php echo e($r->status); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-plant_count" class="form-label">N° Plantas:</label>
                                <input type="number" class="form-control" id="edit-plant_count" name="plant_count" required>
                                <div class="invalid-feedback" id="error-plantas-edit"></div>
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
                                <label for="edit-height_cm" class="form-label">Altura (cm):</label>
                                <input type="number" class="form-control" name="height_cm" id="edit-height_cm" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-days_elapsed" class="form-label">Tiempo en días:</label>
                                <input type="number" class="form-control" name="days_elapsed" id="edit-days_elapsed" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-growth" class="form-label">Crecimiento:</label>
                                <input type="number" class="form-control" name="growth" id="edit-growth" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-mortality" class="form-label">Mortalidad:</label>
                                <input type="number" class="form-control" name="mortality" id="edit-mortality" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit-notes" class="form-label">Novedades:</label>
                                <textarea class="form-control" name="notes" id="edit-notes"></textarea>
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
        <!-- Modal de Eliminar -->
        <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEliminar" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
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
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storeresowingtracking')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nuevo Seguimiento Resiembra</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label">Sistema acuapónico:</label>
                        <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione el sistema</option>
                            <?php $__currentLoopData = $sistema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="resowing_id" class="form-label">Resiembra:</label>
                        <select name="resowing_id" id="resowing_id" class="form-control" required>
                            <option value="">Seleccione una resiembra</option>
                            <?php $__currentLoopData = $resiembras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($r->id); ?>"
                                data-system="<?php echo e($r->aquaponic_system_id); ?>"
                                data-date="<?php echo e($r->date); ?>"
                                data-total_quantity="<?php echo e($r->total_quantity); ?>"
                                data-status="<?php echo e($r->status); ?>">
                                <?php echo e($r->crops->species->name ?? 'Sin cultivo'); ?> - <?php echo e($r->status); ?>

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
                        <label for="height_cm" class="form-label">Altura (cm):</label>
                        <input type="number" name="height_cm" class="form-control" id="height_cm" required>
                    </div>
                    <div class="mb-3">
                        <label for="days_elapsed" class="form-label">Tiempo en días:</label>
                        <input type="number" name="days_elapsed" class="form-control" id="days_elapsed" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="growth" class="form-label">Crecimiento:</label>
                        <input type="number" name="growth" class="form-control" id="growth" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mortality" class="form-label">Mortalidad:</label>
                        <input type="number" name="mortality" class="form-control" id="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Novedades:</label>
                        <textarea class="form-control" name="notes" id="notes"></textarea>
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
        // Establecer la fecha actual para el modal de agregar
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Filtrar resiembras por sistema acuapónico
        function setupSystemResowingDependency(systemSelectId, resowingSelectId, daysInputId = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const resowingSelect = document.getElementById(resowingSelectId);
            if (!systemSelect || !resowingSelect) return;

            const allOptions = Array.from(resowingSelect.options).slice(1);

            systemSelect.addEventListener('change', function() {
                const selectedSystemId = this.value;
                resowingSelect.innerHTML = '<option value="">Seleccione una resiembra</option>';

                allOptions.forEach(option => {
                    if (option.getAttribute('data-system') === selectedSystemId) {
                        resowingSelect.appendChild(option.cloneNode(true));
                    }
                });

                if (daysInputId) {
                    const daysInput = document.getElementById(daysInputId);
                    if (daysInput) daysInput.value = '';
                }
            });
        }

        setupSystemResowingDependency('aquaponic_system_id', 'resowing_id', 'days_elapsed');
        setupSystemResowingDependency('edit-aquaponic_system_id', 'edit-resowing_id', 'edit-days_elapsed');

        // Función para calcular días transcurridos
        function calculateDaysElapsed(resowingDate, dateInputId, daysInputId) {
            const dateInput = document.getElementById(dateInputId);
            const daysInput = document.getElementById(daysInputId);
            if (!resowingDate || !dateInput.value) {
                console.warn('Falta fecha de resiembra o fecha de seguimiento:', { resowingDate, dateValue: dateInput.value });
                daysInput.value = '';
                return;
            }
            try {
                const fechaInicio = new Date(resowingDate);
                const fechaSeleccionada = new Date(dateInput.value);
                if (isNaN(fechaInicio) || isNaN(fechaSeleccionada)) {
                    console.error('Fechas inválidas:', { resowingDate, dateValue: dateInput.value });
                    daysInput.value = '';
                    return;
                }
                const diffTiempo = fechaSeleccionada - fechaInicio;
                const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));
                daysInput.value = Math.max(0, diffDias);
            } catch (error) {
                console.error('Error en calculateDaysElapsed:', error);
                daysInput.value = '';
            }
        }

        // Scripts para agregar
        document.getElementById('resowing_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaResiembra = selectedOption.getAttribute('data-date');
            const totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
            console.log('Fecha de resiembra:', fechaResiembra); // Depuración

            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');

            // Limpiar campos calculados
            document.getElementById('growth').value = '';
            document.getElementById('mortality').value = '';

            window.totalQuantity = totalQuantity;
            window.initialPlantCount = totalQuantity;

            if (this.value) {
                fetch(`<?php echo e(url('/pasante/seguimiento_resiembra/previous')); ?>/${this.value}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    window.previousTracking = data.previousTracking;
                    window.totalQuantity = data.total_quantity;
                    window.initialPlantCount = data.total_quantity;
                    updateCalculatedFields();
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.previousTracking = null;
                    updateCalculatedFields();
                });
            }
        });

        // Actualizar días transcurridos al cambiar la fecha en agregar
        document.getElementById('date').addEventListener('change', function() {
            if (!this.value) {
                console.error('El campo de fecha está vacío');
                this.value = `${year}-${month}-${day}`; // Restaurar fecha actual si está vacío
            }
            const resowingSelect = document.getElementById('resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
        });

        // Forzar cálculo al abrir el modal de agregar
        document.querySelector('#agregar').addEventListener('show.bs.modal', function() {
            const resowingSelect = document.getElementById('resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
        });

        // Escuchar cambios en plant_count y height_cm para agregar
        ['plant_count', 'height_cm'].forEach(field => {
            document.getElementById(field).addEventListener('input', () => updateCalculatedFields());
        });

        // Validar formulario antes de enviar para agregar
        document.querySelector('#agregar form').addEventListener('submit', function(e) {
            if (!updateCalculatedFields()) {
                e.preventDefault();
            }
        });

        // Scripts para editar
        document.getElementById('edit-resowing_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaResiembra = selectedOption.getAttribute('data-date');
            const totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
            const resowingStatus = selectedOption.getAttribute('data-status');
            console.log('Fecha de resiembra (editar):', fechaResiembra, 'Estado:', resowingStatus); // Depuración

            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');

            // Limpiar campos calculados
            document.getElementById('edit-plant_count').value = totalQuantity;
            document.getElementById('edit-height_cm').value = '';
            document.getElementById('edit-growth').value = '';
            document.getElementById('edit-mortality').value = '';

            window.totalQuantity = totalQuantity;
            window.initialPlantCount = totalQuantity;

            if (this.value) {
                fetch(`<?php echo e(url('/pasante/seguimiento_resiembra/previous')); ?>/${this.value}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    window.previousTracking = data.previousTracking;
                    window.totalQuantity = data.total_quantity;
                    window.initialPlantCount = data.total_quantity;
                    console.log('Datos del seguimiento anterior:', data); // Depuración
                    updateCalculatedFields(true);
                })
                .catch(error => {
                    console.error('Error al obtener seguimiento anterior:', error);
                    window.previousTracking = null;
                    window.totalQuantity = totalQuantity;
                    window.initialPlantCount = totalQuantity;
                    updateCalculatedFields(true);
                });
            } else {
                updateCalculatedFields(true);
            }
        });

        // Actualizar días transcurridos al cambiar la fecha en edición
        document.getElementById('edit-date').addEventListener('change', function() {
            if (!this.value) {
                console.error('El campo de fecha está vacío (editar)');
                this.value = `${year}-${month}-${day}`; // Restaurar fecha actual si está vacío
            }
            const resowingSelect = document.getElementById('edit-resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');
            updateCalculatedFields(true);
        });

        // Escuchar cambios en plant_count y height_cm para editar
        ['plant_count', 'height_cm'].forEach(field => {
            document.getElementById(`edit-${field}`).addEventListener('input', () => updateCalculatedFields(true));
        });

        // Validar formulario antes de enviar para editar
        document.querySelector('#editar form').addEventListener('submit', function(e) {
            if (!updateCalculatedFields(true)) {
                e.preventDefault();
            }
        });

        // Lógica para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                console.log('Datos del botón:', {
                    id,
                    date: this.getAttribute('data-date'),
                    aquaponic_system_id: this.getAttribute('data-aquaponic_system_id'),
                    resowing_id: this.getAttribute('data-resowing_id'),
                    plant_count: this.getAttribute('data-plant_count'),
                    height_cm: this.getAttribute('data-height_cm'),
                    days_elapsed: this.getAttribute('data-days_elapsed'),
                    growth: this.getAttribute('data-growth'),
                    mortality: this.getAttribute('data-mortality'),
                    notes: this.getAttribute('data-notes'),
                    resowing_date: this.getAttribute('data-resowing_date')
                }); // Depuración
                document.getElementById('formEditar').action = `/pasante/seguimiento_resiembra/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date') || `${year}-${month}-${day}`;
                document.getElementById('edit-aquaponic_system_id').value = this.getAttribute('data-aquaponic_system_id');
                document.getElementById('edit-plant_count').value = this.getAttribute('data-plant_count');
                document.getElementById('edit-height_cm').value = this.getAttribute('data-height_cm');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-growth').value = this.getAttribute('data-growth');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes') || '';

                // Seleccionar el color correspondiente
                const colorTone = this.getAttribute('data-color_tone');
                const colorInputs = document.querySelectorAll('#editar input[name="color_tone"]');
                colorInputs.forEach(input => {
                    input.checked = input.value === colorTone;
                });

                // Calcular días elapsed inicial
                const resowingDate = this.getAttribute('data-resowing_date');
                calculateDaysElapsed(resowingDate, 'edit-date', 'edit-days_elapsed');

                // Filtrar y seleccionar el resowing_id
                const systemSelect = document.getElementById('edit-aquaponic_system_id');
                systemSelect.value = this.getAttribute('data-aquaponic_system_id');
                systemSelect.dispatchEvent(new Event('change'));
                setTimeout(() => {
                    const resowingSelect = document.getElementById('edit-resowing_id');
                    resowingSelect.value = this.getAttribute('data-resowing_id');
                    window.previousTracking = null; // Resetear para evitar valores antiguos
                    if (resowingSelect.value) {
                        const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
                        const resowingStatus = selectedOption.getAttribute('data-status');
                        window.totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
                        window.initialPlantCount = window.totalQuantity;
                        fetch(`<?php echo e(url('/pasante/seguimiento_resiembra/previous')); ?>/${resowingSelect.value}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.previousTracking = data.previousTracking;
                            window.totalQuantity = data.total_quantity;
                            window.initialPlantCount = data.total_quantity;
                            console.log('Datos del seguimiento anterior:', data); // Depuración
                            updateCalculatedFields(true); // Recalcular después de cargar datos
                        })
                        .catch(error => {
                            console.error('Error al obtener seguimiento anterior:', error);
                            window.previousTracking = null;
                            updateCalculatedFields(true);
                        });
                    } else {
                        updateCalculatedFields(true); // Si no hay resowing_id, usar valores originales
                    }
                }, 100);
            });
        });

        // Lógica para el modal de eliminación
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
                        formEliminar.action = `/pasante/seguimiento_resiembra/destroy/${id}`;
                        formEliminar.submit();
                    }
                });
            });
        });

        // Función para actualizar campos calculados
        function updateCalculatedFields(isEditModal = false) {
            const prefix = isEditModal ? 'edit-' : '';
            const plantCountInput = document.getElementById(`${prefix}plant_count`);
            const heightInput = document.getElementById(`${prefix}height_cm`);
            const growthInput = document.getElementById(`${prefix}growth`);
            const mortalityInput = document.getElementById(`${prefix}mortality`);
            const errorDiv = document.getElementById(`error-plantas${isEditModal ? '-edit' : ''}`);
            const resowingSelect = document.getElementById(`${prefix}resowing_id`);
            const selectedOption = resowingSelect ? resowingSelect.options[resowingSelect.selectedIndex] : null;
            const resowingStatus = selectedOption ? selectedOption.getAttribute('data-status') : null;

            const plantCount = parseInt(plantCountInput.value) || 0;
            const heightCm = parseFloat(heightInput.value) || 0;
            const totalQuantity = window.totalQuantity || 0;
            const previousTracking = window.previousTracking;

            // Validar plant_count
            if (plantCount > totalQuantity) {
                plantCountInput.classList.add('is-invalid');
                errorDiv.textContent = `El número de plantas no puede exceder la cantidad resembrada total (${totalQuantity}).`;
                return false;
            } else {
                plantCountInput.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }

            // Calcular crecimiento
            let growth = 0;
            if (resowingStatus === 'Seguimiento' && previousTracking) {
                const previousHeight = parseFloat(previousTracking.height_cm) || 0;
                growth = heightCm - previousHeight;
            } else {
                growth = heightCm; // Para resiembra "Registrada" o sin seguimiento anterior
            }
            growth = Math.max(0, growth);
            growthInput.value = growth.toFixed(2);

            // Calcular mortalidad
            let mortality = 0;
            let previousPlantCount = totalQuantity;
            if (resowingStatus === 'Seguimiento' && previousTracking) {
                previousPlantCount = parseInt(previousTracking.plant_count) || totalQuantity;
            }
            mortality = previousPlantCount - plantCount;
            mortality = Math.max(0, mortality);
            mortalityInput.value = mortality;

            return true;
        }

        // Forzar cálculo al abrir el modal de edición
        document.querySelector('#editar').addEventListener('show.bs.modal', function() {
            const resowingSelect = document.getElementById('edit-resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');
            updateCalculatedFields(true);
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
        $('#seguimientoresiembra').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/seguimiento_resiembra.blade.php ENDPATH**/ ?>