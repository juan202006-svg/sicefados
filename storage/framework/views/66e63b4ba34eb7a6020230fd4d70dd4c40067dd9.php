
<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Cosechas</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content11'); ?>
<h1 class="fw-bold mb-4">Gestión de cosechas</h1>
<div class="content mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Cosechas</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nueva Cosecha
            </button>
        </div>
        <div class="table-responsive">
            <table id="cosecha" class="table table-hover table-bordered align-middle text-center">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th>Código</th>
                        <th>Sistema Acuapónico</th>
                        <th>Cultivo/Resiembra</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Unidad medida</th>
                        <th>Destino</th>
                        <th>Mortandad</th>
                        <th>Novedades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 1; ?>
                    <?php $__currentLoopData = $cosechas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($n++); ?></td>
                        <td><?php echo e($ch->aquaponicSystem->name ?? 'N/A'); ?></td>
                        <td>
                            <?php if($ch->harvestable instanceof \Modules\AGROCEFA\Entities\Crop): ?>
                            <?php echo e($ch->harvestable->species->name); ?> (Cultivo)
                            <?php elseif($ch->harvestable instanceof \Modules\ACUAPONICO\Entities\Resowing): ?>
                            <?php echo e($ch->harvestable->crops->species->name ?? 'N/A'); ?> (Resiembra)
                            <?php else: ?>
                            N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($ch->date); ?></td>
                        <td><?php echo e($ch->quantity); ?></td>
                        <td><?php echo e($ch->unit); ?></td>
                        <td><?php echo e($ch->destination); ?></td>
                        <td><?php echo e($ch->mortality); ?></td>
                        <td><?php echo e($ch->notes); ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm editbtn"
                                data-id="<?php echo e($ch->id); ?>"
                                data-aquaponic_system_id="<?php echo e($ch->aquaponic_system_id); ?>"
                                data-harvestable_id="<?php echo e($ch->harvestable_id); ?>"
                                data-harvestable_type="<?php echo e($ch->harvestable_type); ?>"
                                data-date="<?php echo e($ch->date); ?>"
                                data-quantity="<?php echo e($ch->quantity); ?>"
                                data-unit="<?php echo e($ch->unit); ?>"
                                data-destination="<?php echo e($ch->destination); ?>"
                                data-mortality="<?php echo e($ch->mortality); ?>"
                                data-notes="<?php echo e($ch->notes); ?>"
                                data-toggle="modal"
                                data-target="#editar">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($ch->id); ?>">
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

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storeharvest')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Nueva Cosecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha:</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                        <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione un sistema</option>
                            <?php $__currentLoopData = $systems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harvestable" class="form-label">Cultivo o Resiembre:</label>
                        <select name="harvestable" id="harvestable" class="form-control" required>
                            <option value="">Primero seleccione un sistema</option>
                        </select>
                        <input type="hidden" name="harvestable_id" id="harvestable_id">
                        <input type="hidden" name="harvestable_type" id="harvestable_type">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad:</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" step="0.01" required>
                        <div class="invalid-feedback" id="error-peces" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unidad de medida:</label>
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="Gramos">Gramos</option>
                            <option value="Kilogramos">Kilogramos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destino:</label>
                        <input type="text" name="destination" class="form-control" id="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="mortality" class="form-label">Mortandad:</label>
                        <input type="number" name="mortality" class="form-control" id="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Novedad:</label>
                        <textarea name="notes" class="form-control" id="notes"></textarea>
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

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updateharvest', 0)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editarLabel">Editar Cosecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-date" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="edit-date" name="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-aquaponic_system_id" class="form-label">Sistema Acuapónico:</label>
                        <select name="aquaponic_system_id" id="edit-aquaponic_system_id" class="form-control" required>
                            <option value="">Seleccione un sistema</option>
                            <?php $__currentLoopData = $systems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-harvestable" class="form-label">Cultivo o Resiembre:</label>
                        <select name="harvestable" id="edit-harvestable" class="form-control" required>
                            <option value="">Primero seleccione un sistema</option>
                        </select>
                        <input type="hidden" name="harvestable_id" id="edit-harvestable_id">
                        <input type="hidden" name="harvestable_type" id="edit-harvestable_type">
                    </div>
                    <div class="mb-3">
                        <label for="edit-quantity" class="form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="edit-quantity" name="quantity" step="0.01" required>
                        <div class="invalid-feedback" id="edit-error-peces" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-unit" class="form-label">Unidad de medida:</label>
                        <select name="unit" id="edit-unit" class="form-control" required>
                            <option value="Gramos">Gramos</option>
                            <option value="Kilogramos">Kilogramos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-destination" class="form-label">Destino:</label>
                        <input type="text" class="form-control" id="edit-destination" name="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-mortality" class="form-label">Mortandad:</label>
                        <input type="number" class="form-control" id="edit-mortality" name="mortality" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-notes" class="form-label">Novedad:</label>
                        <textarea class="form-control" name="notes" id="edit-notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEliminar" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarLabel">Eliminar Cosecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta cosecha? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fecha actual para el modal agregar
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Función para cargar cultivos/resiembras
        function loadHarvestables(systemSelectId, harvestableSelectId, harvestableIdInputId, harvestableTypeInputId, initialSystemId = null, initialHarvestableId = null, initialHarvestableType = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const harvestableIdInput = document.getElementById(harvestableIdInputId);
            const harvestableTypeInput = document.getElementById(harvestableTypeInputId);

            systemSelect.addEventListener('change', function() {
                const systemId = this.value;
                harvestableSelect.innerHTML = '<option value="">Cargando...</option>';
                if (systemId) {
                    fetch(`<?php echo e(route('acuaponico.pasante.pasante.harvests.harvestables-by-system', '')); ?>/${systemId}?harvestable_id=${initialHarvestableId || ''}&harvestable_type=${encodeURIComponent(initialHarvestableType || '')}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            harvestableSelect.innerHTML = '<option value="">Seleccione un cultivo o resiembra</option>';
                            data.forEach(item => {
                                harvestableSelect.innerHTML += `<option value="${item.type}|${item.id}" data-quantity="${item.quantity}">${item.name}</option>`;
                            });
                            if (initialHarvestableId && initialHarvestableType && systemId === initialSystemId) {
                                const initialValue = `${initialHarvestableType}|${initialHarvestableId}`;
                                harvestableSelect.value = initialValue;
                                harvestableSelect.dispatchEvent(new Event('change'));
                                initialHarvestableId = null;
                                initialHarvestableType = null;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching harvestables:', error);
                            harvestableSelect.innerHTML = '<option value="">Error al cargar los datos</option>';
                        });
                } else {
                    harvestableSelect.innerHTML = '<option value="">Primero seleccione un sistema</option>';
                }
            });

            harvestableSelect.addEventListener('change', function() {
                const value = this.value;
                const mortalityInput = document.getElementById(systemSelectId.replace('aquaponic_system_id', 'mortality') || 'mortality');
                const quantityInput = document.getElementById(systemSelectId.replace('aquaponic_system_id', 'quantity') || 'quantity');
                if (value) {
                    const [type, id] = value.split('|');
                    harvestableTypeInput.value = type;
                    harvestableIdInput.value = id;
                    const quantity = parseFloat(this.selectedOptions[0].getAttribute('data-quantity')) || 0;
                    const inputQuantity = parseFloat(quantityInput.value) || 0;
                    mortalityInput.value = quantity - inputQuantity >= 0 ? quantity - inputQuantity : '';
                } else {
                    harvestableTypeInput.value = '';
                    harvestableIdInput.value = '';
                    mortalityInput.value = '';
                }
            });

            if (initialSystemId) {
                systemSelect.value = initialSystemId;
                systemSelect.dispatchEvent(new Event('change'));
            }
        }

        // Inicializar para el modal de agregar
        loadHarvestables('aquaponic_system_id', 'harvestable', 'harvestable_id', 'harvestable_type');

        // Cargar datos para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/cosecha/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-quantity').value = this.getAttribute('data-quantity');
                document.getElementById('edit-unit').value = this.getAttribute('data-unit');
                document.getElementById('edit-destination').value = this.getAttribute('data-destination');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes');

                loadHarvestables(
                    'edit-aquaponic_system_id',
                    'edit-harvestable',
                    'edit-harvestable_id',
                    'edit-harvestable_type',
                    this.getAttribute('data-aquaponic_system_id'),
                    this.getAttribute('data-harvestable_id'),
                    this.getAttribute('data-harvestable_type')
                );

                setTimeout(() => {
                    document.getElementById('edit-harvestable').dispatchEvent(new Event('change'));
                }, 500);
            });
        });

        // Validar cantidad y calcular mortalidad
        function validateQuantity(inputId, errorId, harvestableSelectId, mortalityId) {
            const input = document.getElementById(inputId);
            const harvestableSelect = document.getElementById(harvestableSelectId);
            const errorDiv = document.getElementById(errorId);
            const mortality = document.getElementById(mortalityId);

            function calculate() {
                const quantity = parseFloat(harvestableSelect.options[harvestableSelect.selectedIndex]?.getAttribute('data-quantity') || 0);
                const cantidad = parseFloat(input.value) || 0;

                if (cantidad < 0 || isNaN(cantidad)) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = 'La cantidad debe ser un número válido mayor o igual a 0.';
                    mortality.value = '';
                } else if (cantidad > quantity) {
                    input.classList.add('is-invalid');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = `No puedes ingresar más de ${quantity}.`;
                    mortality.value = '';
                } else {
                    input.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                    mortality.value = quantity - cantidad >= 0 ? quantity - cantidad : '';
                }
            }

            harvestableSelect.addEventListener('change', calculate);
            input.addEventListener('input', calculate);
            calculate();
        }

        validateQuantity('quantity', 'error-peces', 'harvestable', 'mortality');
        validateQuantity('edit-quantity', 'edit-error-peces', 'edit-harvestable', 'edit-mortality');

        // Eliminar con SweetAlert
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
                        formEliminar.action = `/pasante/cosecha/destroy/${id}`;
                        formEliminar.submit();
                    }
                });
            });
        });
    });
</script>

<!-- Scripts para notificaciones -->
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
        $('#cosecha').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registrocosecha.blade.php ENDPATH**/ ?>