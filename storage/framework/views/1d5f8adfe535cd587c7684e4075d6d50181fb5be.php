<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Cultivos</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid mt-4">
    <h1 class="fw-bold mb-4 text-primary text-center">Gestión de Cultivos</h1>
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 text-dark font-weight-bold">Lista de Cultivos</h5>
            <button type="button" class="btn btn-primary btn-lg rounded-pill ml-auto" data-toggle="modal" data-target="#agregar">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Cultivo
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="cultivoTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Sistema Acuapónico</th>
                            <th>Especie</th>
                            <th>Lote</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $cultivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cultivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-light">
                            <td><?php echo e($n++); ?></td>
                            <td><?php echo e($cultivo->date); ?></td>
                            <td><?php echo e($cultivo->aquaponicSystem->name); ?></td>
                            <td><?php echo e($cultivo->species->name ?? 'Sin especie'); ?></td>
                            <td>
                                <?php $__currentLoopData = $cultivo->lotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-info">
                                    <?php echo e($lote->name); ?> (<?php echo e($lote->pivot->planted_quantity); ?>)
                                </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($cultivo->quantity); ?></td>
                            <td>
                                <?php if($cultivo->status == 'Cultivado'): ?>
                                    <span class="badge badge-success">Cultivado</span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e($cultivo->status); ?></span>
                                <?php endif; ?>
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storecrops')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content border-0 rounded-lg shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white rounded-top p-4">
                        <h5 class="modal-title font-weight-bold" id="agregarLabel">Agregar Nuevo Cultivo</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5 bg-white rounded-bottom">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="date" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-calendar-alt mr-2"></i> Fecha
                                    </label>
                                    <input type="date" name="date" class="form-control form-control-lg custom-input" id="date" required readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="aquaponic_system_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-water mr-2"></i> Sistema Acuapónico
                                    </label>
                                    <select id="aquaponic_system_id" name="aquaponic_system_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione un sistema acuapónico</option>
                                        <?php $__currentLoopData = $acuaponicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acuaponico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($acuaponico->id); ?>"><?php echo e($acuaponico->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="species_id" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-leaf mr-2"></i> Especie
                                    </label>
                                    <select name="species_id" class="form-control form-control-lg custom-select" required>
                                        <option value="">Seleccione una especie</option>
                                        <?php $__currentLoopData = $especies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $especie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($especie->id); ?>"><?php echo e($especie->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="lot_ids" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-layer-group mr-2"></i> Lotes
                                    </label>
                                    <select id="lot_ids" name="lot_ids[]" class="form-control form-control-lg custom-select" multiple required>
                                    </select>
                                    <small class="form-text text-muted">Puede seleccionar más de un lote con Ctrl (Windows) o Cmd (Mac)</small>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="quantity" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-sort-numeric-up mr-2"></i> Cantidad a Cultivar
                                    </label>
                                    <input type="number" id="quantity" name="quantity" class="form-control form-control-lg custom-input" required>
                                    <div class="invalid-feedback" id="error-cantidad"></div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="status" class="form-label text-dark font-weight-bold custom-form-label">
                                        <i class="fas fa-toggle-on mr-2"></i> Estado
                                    </label>
                                    <select name="status" class="form-control form-control-lg custom-select" required>
                                        <option value="Cultivado">Cultivado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light p-4 rounded-bottom">
                        <button type="button" class="btn btn-secondary btn-lg rounded-pill px-4" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo e(asset('css/custom-styles.css')); ?>">

<!-- Script para establecer la fecha actual en el campo de fecha -->
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