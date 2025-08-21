<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Cultivos</li>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content2'); ?>
<h1 class="fw-bold mb-4">Gestión de Cultivos</h1>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold">Lista de Cultivos</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar">
                <i class="bi bi-plus-circle"></i> Nuevo Cultivo
            </button>
        </div>
        <div class="table-responsive">
            <div class="card-body">
                <table id="cultivoTable" class="table table-hover table-bordered align-middle text-center">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>S/acuaponico</th>
                            <th>Especie</th>
                            <th>Lote</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $cultivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cultivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($n++); ?></td>
                            <td class="text-center"><?php echo e($cultivo->date); ?></td>
                            <td class="text-center"><?php echo e($cultivo->aquaponicSystem->name); ?></td>
                            <td class="text-center"><?php echo e($cultivo->species->name ?? 'sin especie'); ?></td>
                            <td class="text-center">
                                <?php $__currentLoopData = $cultivo->lotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-info">
                                    <?php echo e($lote->name); ?> (<?php echo e($lote->pivot->planted_quantity); ?>)
                                </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td class="text-center"><?php echo e($cultivo->quantity); ?></td>
                            <td class="text-center"><?php echo e($cultivo->status); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm editbtn"
                                    data-id="<?php echo e($cultivo->id); ?>"
                                    data-date="<?php echo e($cultivo->date); ?>"
                                    data-aquaponic_system_id="<?php echo e($cultivo->aquaponic_system_id); ?>"
                                    data-species_id="<?php echo e($cultivo->species_id); ?>"
                                    data-lot_ids="<?php echo e($cultivo->lotes->pluck('id')->implode(',')); ?>"
                                    data-quantity="<?php echo e($cultivo->quantity); ?>"
                                    data-status="<?php echo e($cultivo->status); ?>"
                                    <?php $__currentLoopData = $cultivo->lotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    data-lot_asignado_<?php echo e($lote->id); ?>="<?php echo e($lote->pivot->planted_quantity); ?>"
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    data-toggle="modal"
                                    data-target="#editar">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo e($cultivo->id); ?>">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <!-- Inicio de modal de editar -->
                <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden=" true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formEditar" action="<?php echo e(route('acuaponico.pasante.pasante.updatecrops', ['id' => 0])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarLabel">Editar cultivo</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="edit-id">
                                    <div class="mb-3">
                                        <label for="edit-date" class="form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="edit-date" name="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-aquaponic_system_id" class="form-label">S/acuaponico:</label>
                                        <select class="form-control" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                                            <option value="">Seleccione un sistema acuapónico</option>
                                            <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-species_id" class="form-label">Especie:</label>
                                        <select class="form-control" id="edit-species_id" name="species_id" required>
                                            <option value="">Seleccione un cultivo</option>
                                            <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($especie->id); ?>"><?php echo e($especie->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-lot_ids" class="form-label">Lotes:</label>
                                        <select id="edit-lot_ids" class="form-control" name="lot_ids[]" multiple required>
                                        </select>
                                        <small class="form-text text-muted">Puede seleccionar más de un lote con Ctrl (Windows) o Cmd (Mac)</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-quantity" class="form-label">Cantidad a cultivar:</label>
                                        <input type="number" class="form-control" id="edit-quantity" name="quantity" required>
                                        <div class="invalid-feedback" id="error-cantidad-edit"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-status" class="form-label">Estado:</label>
                                        <select name="status" id="edit-status" class="form-control" required>
                                            <option value="Cultivado">Cultivado</option>
                                            <option value="Seguimiento">Seguimiento</option>
                                            <option value="Cosechado">Cosechado</option>
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
                <!-- Termina modal de editar -->
                <!-- Inicia modal de eliminar -->
                <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formEliminar" action="" method="POST" style="display:none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('acuaponico.pasante.pasante.storecrops')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarLabel">Agregar Nuevo cultivo</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
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
                    <div class="form-group">
                        <label for="species_id">Especie:</label>
                        <select name="species_id" class="form-control" required>
                            <option value="">Seleccione una especie</option>
                            <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($especie->id); ?>"><?php echo e($especie->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lot_ids">Lotes:</label>
                        <select id="lot_ids" name="lot_ids[]" class="form-control" multiple required>
                        </select>
                        <small class="form-text text-muted">Puede seleccionar más de un lote con Ctrl (Windows) o Cmd (Mac)</small>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad a cultivar:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required>
                        <div class="invalid-feedback" id="error-cantidad"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select name="status" class="form-control" required>
                            <option value="Cultivado">Cultivado</option>
                            <option value="Seguimiento">Seguimiento</option>
                            <option value="Cosechado">Cosechado</option>
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
<!-- Script para establecer la fecha actual en el campo de fecha -->
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
<!-- Script para validación del modal de agregar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loteSelect = document.getElementById('lot_ids');
        const cantidadInput = document.getElementById('quantity');
        const errorDiv = document.getElementById('error-cantidad');
        const form = loteSelect.closest('form');

        function calcularCapacidadTotal() {
            const selectedOptions = Array.from(loteSelect.selectedOptions);
            return selectedOptions.reduce((total, option) => {
                const capacidad = parseInt(option.getAttribute('data-capacidad')) || 0;
                const ocupado = parseInt(option.getAttribute('data-ocupado')) || 0;
                return total + (capacidad - ocupado);
            }, 0);
        }

        function validarCantidad() {
            const capacidadTotal = calcularCapacidadTotal();
            const cantidad = parseInt(cantidadInput.value) || 0;
            if (cantidad > capacidadTotal) {
                cantidadInput.classList.add('is-invalid');
                errorDiv.innerText = `La cantidad excede la capacidad total de los lotes seleccionados (${capacidadTotal}).`;
                return false;
            } else {
                cantidadInput.classList.remove('is-invalid');
                errorDiv.innerText = '';
                return true;
            }
        }

        loteSelect.addEventListener('change', validarCantidad);
        cantidadInput.addEventListener('input', validarCantidad);
        form.addEventListener('submit', function(e) {
            if (!validarCantidad()) {
                e.preventDefault();
            }
        });
    });
</script>
<!-- Script para cargar lotes al agregar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sistemaSelect = document.getElementById('aquaponic_system_id');
        const lotesSelect = document.getElementById('lot_ids');

        sistemaSelect.addEventListener('change', function() {
            const sistemaId = this.value;
            lotesSelect.innerHTML = '';
            if (sistemaId) {
                fetch(`/pasante/cultivo/lotes-por-sistema/${sistemaId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            lotesSelect.innerHTML = '<option disabled>No hay lotes disponibles</option>';
                        } else {
                            data.forEach(lote => {
                                const option = document.createElement('option');
                                option.value = lote.id;
                                option.textContent = `${lote.name} - Disponible: ${lote.capacity - lote.ocupado}`;
                                option.dataset.capacidad = lote.capacity;
                                option.dataset.ocupado = lote.ocupado;
                                option.dataset.state = lote.state;
                                lotesSelect.appendChild(option);
                            });
                            setTimeout(() => {
                                document.getElementById('quantity').dispatchEvent(new Event('input'));
                            }, 100);
                        }
                    })
                    .catch(error => console.error('Error al obtener los lotes:', error));
            }
        });
    });
</script>
<!-- Script para el modal de editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loteSelectEdit = document.getElementById('edit-lot_ids');
        const cantidadInputEdit = document.getElementById('edit-quantity');
        const formEdit = document.getElementById('formEditar');
        const errorDivEdit = document.getElementById('error-cantidad-edit');

        function calcularCapacidadTotalEdit() {
            const selectedOptions = Array.from(loteSelectEdit.selectedOptions);
            return selectedOptions.reduce((total, option) => {
                const capacidad = parseInt(option.getAttribute('data-capacidad')) || 0;
                const ocupado = parseInt(option.getAttribute('data-ocupado')) || 0;
                return total + (capacidad - ocupado);
            }, 0);
        }

        function validarCantidadEdit() {
            const capacidadTotal = calcularCapacidadTotalEdit();
            const cantidad = parseInt(cantidadInputEdit.value) || 0;
            if (cantidad > capacidadTotal) {
                cantidadInputEdit.classList.add('is-invalid');
                errorDivEdit.innerText = `La cantidad excede la capacidad total de los lotes seleccionados (${capacidadTotal}).`;
                return false;
            } else {
                cantidadInputEdit.classList.remove('is-invalid');
                errorDivEdit.innerText = '';
                return true;
            }
        }

        loteSelectEdit.addEventListener('change', validarCantidadEdit);
        cantidadInputEdit.addEventListener('input', validarCantidadEdit);
        formEdit.addEventListener('submit', function(e) {
            if (!validarCantidadEdit()) {
                e.preventDefault();
            }
        });

        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const cropId = this.getAttribute('data-id');
                const date = this.getAttribute('data-date');
                const aquaponicSystemId = this.getAttribute('data-aquaponic_system_id');
                const speciesId = this.getAttribute('data-species_id');
                const loteIdsStr = this.getAttribute('data-lot_ids');
                const loteIds = loteIdsStr ? loteIdsStr.split(',') : [];
                const quantity = this.getAttribute('data-quantity');
                const status = this.getAttribute('data-status');

                // Almacenar asignados originales
                const originalAsignados = {};
                loteIds.forEach(id => {
                    originalAsignados[id] = parseInt(this.getAttribute(`data-lot_asignado_${id}`)) || 0;
                });

                const editModal = document.getElementById('editar');
                editModal.dataset.originalAsignados = JSON.stringify(originalAsignados);

                // Setear valores
                document.getElementById('edit-id').value = cropId;
                document.getElementById('edit-date').value = date;
                document.getElementById('edit-aquaponic_system_id').value = aquaponicSystemId;
                document.getElementById('edit-species_id').value = speciesId;
                document.getElementById('edit-quantity').value = quantity;
                document.getElementById('edit-status').value = status;

                // Fetch con crop_id
                fetch(`/pasante/cultivo/lotes-por-sistema/${aquaponicSystemId}?crop_id=${cropId}`)
                    .then(response => response.json())
                    .then(data => {
                        loteSelectEdit.innerHTML = '';
                        const originalAsignados = JSON.parse(editModal.dataset.originalAsignados || '{}');
                        data.forEach(lote => {
                            let ocupadoEfectivo = lote.ocupado;
                            if (lote.id in originalAsignados) {
                                ocupadoEfectivo -= originalAsignados[lote.id];
                            }
                            ocupadoEfectivo = Math.max(0, ocupadoEfectivo);
                            const disponibleEfectivo = lote.capacity - ocupadoEfectivo;

                            const option = document.createElement('option');
                            option.value = lote.id;
                            option.text = `${lote.name} - Disponible: ${disponibleEfectivo}`;
                            option.setAttribute('data-capacidad', lote.capacity);
                            option.setAttribute('data-ocupado', ocupadoEfectivo);
                            option.setAttribute('data-state', lote.state);
                            if (loteIds.includes(lote.id.toString())) {
                                option.selected = true;
                            }
                            loteSelectEdit.appendChild(option);
                        });
                        setTimeout(() => {
                            validarCantidadEdit();
                        }, 200);
                    })
                    .catch(error => console.error('Error al obtener lotes:', error));
            });
        });
    });
</script>
<!-- Script para cargar lotes al cambiar sistema en editar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editSistemaSelect = document.getElementById('edit-aquaponic_system_id');
        const editLotesSelect = document.getElementById('edit-lot_ids');

        editSistemaSelect.addEventListener('change', function() {
            const sistemaId = this.value;
            const cropId = document.getElementById('edit-id').value;
            editLotesSelect.innerHTML = '';
            if (sistemaId) {
                fetch(`/pasante/cultivo/lotes-por-sistema/${sistemaId}?crop_id=${cropId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            editLotesSelect.innerHTML = '<option disabled>No hay lotes disponibles</option>';
                        } else {
                            const originalAsignados = JSON.parse(document.getElementById('editar').dataset.originalAsignados || '{}');
                            data.forEach(lote => {
                                let ocupadoEfectivo = lote.ocupado;
                                if (lote.id in originalAsignados) {
                                    ocupadoEfectivo -= originalAsignados[lote.id];
                                }
                                ocupadoEfectivo = Math.max(0, ocupadoEfectivo);
                                const disponibleEfectivo = lote.capacity - ocupadoEfectivo;

                                const option = document.createElement('option');
                                option.value = lote.id;
                                option.textContent = `${lote.name} - Disponible: ${disponibleEfectivo}`;
                                option.setAttribute('data-capacidad', lote.capacity);
                                option.setAttribute('data-ocupado', ocupadoEfectivo);
                                option.setAttribute('data-state', lote.state);
                                if (lote.id in originalAsignados) {
                                    option.selected = true;
                                }
                                editLotesSelect.appendChild(option);
                            });
                            setTimeout(() => {
                                document.getElementById('edit-quantity').dispatchEvent(new Event('input'));
                            }, 100);
                        }
                    })
                    .catch(error => console.error('Error al obtener lotes:', error));
            }
        });
    });
</script>
<!-- Script del modal de eliminar -->
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
                    formEliminar.action = `/pasante/cultivo/destroy/${id}`;
                    formEliminar.submit();
                }
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
        $('#cultivoTable').DataTable({
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
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/pasante/cultivos.blade.php ENDPATH**/ ?>