

<?php $__env->startSection('content'); ?>
<style>
    table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
</style>
<div class="container">
    <br>
    <h2 class="text-justify text-center mt-4" 
        style="font-size: 54px; font-family:'Savate', sans-serif; font-optical-sizing: auto; font-weight: 400;
        font-style: normal;">Gestión de Usuarios</h2>
    <div class="mt-4">
        <div class="border-bottom"></div>
    </div>

    <div class="row mt-4">
        
        <div class="col-md-8">
            <form action="<?php echo e(route('acuaponico.admin.admin.storeUsuarios')); ?>" method="POST" class="mb-6">
                <?php echo csrf_field(); ?>
                <div class="shadow p-4 rounded bg-light">
                    <h4 class="text-center mb-4">Agregar Nuevo Usuario</h4>

                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <input type="text" name="first_name" class="form-control form-control-lg" placeholder="Ingresa el Nombre" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Apellidos</label>
                            <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Ingresa los Apellidos" required>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="opciones" class="form-label">Rol</label>
                            <select name="role" class="form-select form-select-lg" required id="opciones">
                                <option value="" disabled selected>Seleccione un rol</option>
                                <option value="pasante">Pasante</option>
                                <option value="instructor">Instructor</option>
                            </select>
                        </div>

                        
                        <div class="col-md-6 mb-3">
                            <label for="productive_unit_id" class="form-label">Unidad Productiva</label>
                            <select name="productive_unit_id" class="form-select form-select-lg" >
                                <option value="">-- Seleccione --</option>
                                <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($unidad->id); ?>"><?php echo e($unidad->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg px-5">Agregar</button>
                    </div>
                </div>
            </form>
        </div>

        
        <div class="col-md-4 d-flex flex-column align-items-end">
            
            <div class="d-flex flex-column h-100" style="max-width: 300px; width: 100%;">
                
                
                <div onclick="scrollToTable()" class="card shadow mb-4 flex-fill" style="background-color: hsl(176, 100%, 51%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong><?php echo e($totalCount); ?></strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Usuarios registrados</h6>
                            <i class="fa fa-users fa-lg"></i>
                        </div>
                    </div>
                </div>

                
                <div onclick="scrollToTable()" class="card shadow mb-3 flex-fill" style="background-color: hsl(131, 100%, 77%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong><?php echo e($pasantesCount); ?></strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Pasantes</h6>
                            <i class="fa fa-user-graduate fa-lg"></i>
                        </div>
                    </div>
                </div>

                
                <div onclick="scrollToTable()" class="card shadow flex-fill" style="background-color: hsl(77, 92%, 90%)">
                    <div class="card-body py-3 px-3 d-flex flex-column justify-content-between">
                        <p class="display-6 mb-2"><strong><?php echo e($instructorCount); ?></strong></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Instructores</h6>
                            <i class="fa fa-chalkboard-teacher fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h1 class="mt-5 border-bottom"></h1>
    </div>




<div class="container mt-5">
    <h1 class="text-center text-secondary border-bottom pb-2">Lista de usuarios</h1>

    <div class="d-flex justify-content-end align-items-center mt-3 mb-3">
        <label for="busqueda" class="me-2 fw-semibold text-secondary">Buscar:</label>
        <input type="text" id="busqueda" class="form-control w-25" placeholder="Búsqueda..." onkeyup="filtrarTabla()">
    </div>

    
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabla-usuarios">
            <thead class="table-primary">
                <tr> 
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Unidad Productiva</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($usuario->first_name); ?></td>
                    <td><?php echo e($usuario->last_name); ?></td>
                    <td><?php echo e(ucfirst($usuario->role)); ?></td>
                    <td><?php echo e($usuario->productiveUnit->name ?? 'No asignado'); ?></td>
                    <td><?php echo e(ucfirst($usuario->status)); ?></td>
                    <td>
                        
                        <a data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($usuario->id); ?>" title="Editar" class="text-dark me-3">
                            <i class="fas fa-pencil-alt" style="font-size: 1.2rem;"></i>
                        </a>

                        
                        <form action="<?php echo e(route('acuaponico.admin.admin.destroyUsuarios', $usuario->id)); ?>" 
                            method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-danger btn-delete" title="Eliminar" data-user-id="<?php echo e($usuario->id); ?>">
                                <i class="fas fa-trash" style="font-size: 1.2rem;"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                    
                    <div class="modal fade" id="editModal<?php echo e($usuario->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($usuario->id); ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?php echo e(route('acuaponico.admin.admin.updateUsuarios', $usuario->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title w-100 text-center">Realiza cambios</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">Nombre</label>
                                            <input type="text" name="first_name" class="form-control" value="<?php echo e($usuario->first_name); ?>" required style="height: 50px; width: 45%">
                                        </div>
                                        <div class="mb-3" style="margin-left: 54%; margin-top: -21%;">
                                            <label for="last_name" class="form-label">Apellidos</label>
                                            <input type="text" name="last_name" class="form-control" value="<?php echo e($usuario->last_name); ?>" required style="height: 50px; width: 100%;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Rol</label>
                                            <select name="role" class="form-select" required>
                                                <option value="pasante" <?php echo e($usuario->role == 'pasante' ? 'selected' : ''); ?>>Pasante</option>
                                                <option value="instructor" <?php echo e($usuario->role == 'instructor' ? 'selected' : ''); ?>>Instructor</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productive_unit_id" class="form-label">Unidad Productiva</label>
                                            <select name="productive_unit_id" class="form-select"  style="width: 45%; height: 50px;" required>
                                                <option value="">-- Seleccione --</option>
                                                <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($unidad->id); ?>" <?php echo e($usuario->productive_unit_id == $unidad->id ? 'selected' : ''); ?>>
                                                        <?php echo e($unidad->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="mb-3" style="margin-left: 55%; margin-top: -21%;">
                                            <label for="status" class="form-label" >Estado</label>
                                            <select name="status" class="form-select" required style="height: 50px;">
                                                <option value="activo" <?php echo e($usuario->status == 'activo' ? 'selected' : ''); ?>>Activo</option>
                                                <option value="inactivo" <?php echo e($usuario->status == 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
            
            <div class="text-muted small">
                Mostrando <?php echo e($usuarios->firstItem()); ?> - <?php echo e($usuarios->lastItem()); ?> de <?php echo e($usuarios->total()); ?> usuarios
            </div>

            
            <div>
                <?php echo e($usuarios->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
            </div>
        </div>

        <div class="mt-5 mb-5">
            <div class="border-bottom"></div>
        </div>
        
        <footer class="bg-white text-dark border-top mt-5 pt-4">
            <div class="container small">
                <div class="row gy-4 text-center text-md-start">
                    
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Sistema de Gestión ACUAPONICO</h6>
                        <p class="mb-1">Administra usuarios, unidades productivas y roles.</p>
                        <p class="mb-0 text-muted">Construido con Laravel & Bootstrap 5.</p>
                    </div>

                    
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Desarrollado por</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">Juan Sebastian Guzman Hernandez</li>
                            <li class="mb-1">
                                <a href="mailto:guzmanhernandezj603@gmail.com" class="text-decoration-none text-dark">
                                    guzmanhernandezj603@gmail.com
                                </a>
                            </li>
                            <li class="mb-0">
                                <a href="tel:‪+573005954563‬" class="text-decoration-none text-dark">
                                    ‪+57 300 595 4563‬
                                </a>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="col-md-4">
                        <h6 class="fw-bold text-uppercase">Más información</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a href="#" class="text-decoration-none text-dark">Política de privacidad</a></li>
                            <li><a href="#" class="text-decoration-none text-dark">Términos de uso</a></li>
                            <li><a href="#" class="text-decoration-none text-dark">Soporte técnico</a></li>
                        </ul>
                    </div>
                </div>

                <hr class="my-4">

                <div class="text-center text-muted pb-2">
                    &copy; <?php echo e(date('Y')); ?> ACUAPONICO. Todos los derechos reservados.
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <script>
            function filtrarTabla() {
                const input = document.getElementById("busqueda");
                const filter = input.value.toLowerCase();
                const rows = document.querySelectorAll("table tbody tr");

                rows.forEach(row => {
                    const nombre = row.cells[1].textContent.toLowerCase();
                    const apellidos = row.cells[2].textContent.toLowerCase();
                    const rol = row.cells[3].textContent.toLowerCase();

                    if (nombre.includes(filter) || apellidos.includes(filter) || rol.includes(filter)) {
                        row.style.display = "";
                    } else {
                            row.style.display = "none";
                        }
                    });
                }


                //scroll
                function scrollToTable() {
                    const tabla = document.getElementById("tabla-usuarios");
                    if (tabla) {
                        tabla.scrollIntoView({ behavior: "smooth" });
                    }
                }


                //Modal de confirmación de eliminación
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('form');
                        const userId = this.getAttribute('data-user-id');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡Esta acción eliminará el usuario permanentemente!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                })
            </script>

            <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo e(session("success")); ?>',
                    showConfirmButton: false,
                    timer: 3000,
                    position: 'center'
                });
            </script>
            <?php endif; ?>

            <?php if(session('info')): ?>
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Información',
                    text: '<?php echo e(session("info")); ?>',
                    showConfirmButton: false,
                    timer: 3000,
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo e(session("success")); ?>',
                    showConfirmButton: false,
                    timer: 2500,
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if(session('successDelete')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo e(session("successDelete")); ?>',
                    showConfirmButton: false,
                    timer: 2500,
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if($errors->any()): ?>
            <script>
                swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Caracteres no válidos o campos incompletos.',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if(session('delete_error')): ?>
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: '<?php echo e(session("delete_error")); ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if(session('error')): ?>
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: 'El usuario ya existe',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            <?php endif; ?>
            <?php if(session('error')): ?>
            <script>
                swal.fire({
                    icon: 'error',
                    title: '!Error¡',
                    text: 'Ya existe este usuario con el mismo rol y unidad productiva',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    position: 'center'
                });
            </script>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/usuarios.blade.php ENDPATH**/ ?>