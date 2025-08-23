

<?php $__env->startPush('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body text-center py-4">
                    <h2 class="mb-2"><i class="fas fa-water mr-3"></i>Sistema de Gestión Acuapónica</h2>
                    <p class="mb-0 lead">Monitoreo y Control de Sistemas de Producción</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards principales de conteos -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sistemas Acuapónicos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($systems->count()); ?></div>
                            <div class="text-xs text-muted mt-1">Total registrados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-water fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Lotes Disponibles
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($lotsCount); ?></div>
                            <div class="text-xs text-muted mt-1">En gestión</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Cultivos Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($cropsCount); ?></div>
                            <div class="text-xs text-muted mt-1">En seguimiento</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Eficiencia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($systems->count() > 0 ? number_format(($cropsCount / $systems->count()) * 100, 1) : 0); ?>%
                            </div>
                            <div class="text-xs text-muted mt-1">Productividad</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas principales -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar mr-2"></i>Análisis de Mortalidad por Cultivo
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opciones:</div>
                            <a class="dropdown-item" href="#">Exportar datos</a>
                            <a class="dropdown-item" href="#">Ver detalle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="mortalityChart" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie mr-2"></i>Distribución de Cultivos
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="cropsBySystemChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Sistema 1
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sistema 2
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Sistema 3
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Métricas secundarias -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">
                                Progreso Semanal
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white">85%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%"
                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">
                                Tasa de Supervivencia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">92.5%</div>
                            <div class="text-xs text-white-50 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>+2.3% vs mes anterior
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de estadísticas detalladas -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-warning text-white shadow-lg">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-2">
                        <i class="fas fa-fish fa-2x mb-2"></i>
                        <h6 class="card-title mb-0">Peces en Seguimiento</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light mb-2">Próximamente</div>
                        <p class="card-text mb-0">Sistema en desarrollo</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-danger text-white shadow-lg">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-2">
                        <i class="fas fa-leaf fa-2x mb-2"></i>
                        <h6 class="card-title mb-0">Plantas Monitoreadas</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light mb-2">En implementación</div>
                        <p class="card-text mb-0">Control fitosanitario</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-secondary text-white shadow-lg">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-2">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <h6 class="card-title mb-0">Cosechas Registradas</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light mb-2">Pendiente</div>
                        <p class="card-text mb-0">Historial de producción</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-dark text-white shadow-lg">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-2">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h6 class="card-title mb-0">Usuarios Activos</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light mb-2">Configuración</div>
                        <p class="card-text mb-0">Gestión de accesos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Información del Sistema
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="font-weight-bold text-primary">Estado del Sistema</h6>
                            <p class="text-muted mb-3">Todos los sistemas operativos funcionando correctamente.</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="font-weight-bold text-primary">Última Actualización</h6>
                            <p class="text-muted mb-3"><?php echo e(date('d/m/Y H:i:s')); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="font-weight-bold text-primary">Próxima Revisión</h6>
                            <p class="text-muted mb-3"><?php echo e(date('d/m/Y', strtotime('+7 days'))); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuración de Chart.js para mejor apariencia
        Chart.defaults.global.defaultFontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Gráfica de Mortalidad mejorada (Bar Chart)
        var mortalityCtx = document.getElementById('mortalityChart').getContext('2d');
        var mortalityData = <?php echo json_encode($mortalityData ?? [], 15, 512) ?>;
        
        var labels = mortalityData.length > 0 ? mortalityData.map(function(item) {
            return item.harvestable_type === 'Modules\\AGROCEFA\\Entities\\Crop' ? 
                'Cultivo ' + item.harvestable_id : 'Resiembre ' + item.harvestable_id;
        }) : ['Sin datos'];
        
        var data = mortalityData.length > 0 ? mortalityData.map(function(item) { 
            return item.total_mortality; 
        }) : [0];

        new Chart(mortalityCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Mortalidad Total',
                    data: data,
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(78, 115, 223, 0.9)',
                    hoverBorderColor: 'rgba(78, 115, 223, 1)',
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'cultivo'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            padding: 10,
                            callback: function(value, index, values) {
                                return value + '%';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return 'Mortalidad: ' + tooltipItem.yLabel + '%';
                        }
                    }
                },
            }
        });

        // Gráfica de Distribución de Cultivos mejorada (Pie Chart)
        var cropsBySystemCtx = document.getElementById('cropsBySystemChart').getContext('2d');
        var cropsBySystem = <?php echo json_encode($cropsBySystem ?? [], 15, 512) ?>;
        
        var systemLabels = cropsBySystem.length > 0 ? cropsBySystem.map(function(item) { 
            return 'Sistema ' + item.aquaponic_system_id; 
        }) : ['Sin datos'];
        
        var systemData = cropsBySystem.length > 0 ? cropsBySystem.map(function(item) { 
            return item.count; 
        }) : [1];

        new Chart(cropsBySystemCtx, {
            type: 'doughnut',
            data: {
                labels: systemLabels,
                datasets: [{
                    data: systemData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b619', '#e02d1b'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

        // Animación de contador para las tarjetas
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            const timer = setInterval(() => {
                start += increment;
                element.textContent = Math.floor(start);
                
                if (start >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                }
            }, 16);
        }

        // Aplicar animación a los contadores principales
        const counters = document.querySelectorAll('.h5.font-weight-bold');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            if (!isNaN(target)) {
                animateCounter(counter, target);
            }
        });
    });
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.progress-sm {
    height: 0.5rem;
}

.chart-area {
    position: relative;
    height: 20rem;
    width: 100%;
}

.chart-pie {
    position: relative;
    height: 15rem;
    width: 100%;
}

@keyframes  fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.6s ease-out;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/welcomepas.blade.php ENDPATH**/ ?>