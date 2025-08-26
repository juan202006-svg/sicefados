```blade


<?php $__env->startPush('breadcrumbs'); ?>
    <li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>
<div class="container-fluid">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white rounded-lg shadow-lg">
                <div class="card-body text-center py-5">
                    <h2 class="mb-2 display-4 font-weight-bold"><i class="fas fa-water mr-3"></i>Sistema de Gestión Acuapónica</h2>
                    <p class="mb-0 lead text-light">Monitoreo y Control de Sistemas de Producción</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards principales de conteos -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-2">
                                Sistemas Acuapónicos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($systems->count()); ?></div>
                            <div class="text-xs text-muted mt-2">Total registrados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-water fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-2">
                                Lotes Disponibles
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($availableLotsCount); ?></div>
                            <div class="text-xs text-muted mt-2">Disponibles para uso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success text-uppercase mb-2">
                                Cultivos Activos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($cropsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En seguimiento</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-2">
                                Resiembras Activas
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($resowingsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En proceso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-recycle fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas principales -->
    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow-lg mb-4 rounded-lg">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-light">
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

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow-lg mb-4 rounded-lg">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-light">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie mr-2"></i>Distribución de Cultivos por Sistema
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="cropsBySystemChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php $__currentLoopData = $cropsBySystem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #<?php echo e(sprintf('%06X', mt_rand(0, 0xFFFFFF))); ?>"></i> Sistema <?php echo e($item->aquaponic_system_id); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nueva fila para gráficas adicionales -->
    <div class="row mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow-lg mb-4 rounded-lg">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar mr-2"></i>Cultivos Activos por Especie
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="position: relative;">
                        <canvas id="cropsBySpeciesChart" height="320"></canvas>
                        <div id="barTooltip" class="tooltip" style="display: none; position: absolute; background: #fff; border: 1px solid #bdc3c7; padding: 8px; border-radius: 4px; font-size: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow-lg mb-4 rounded-lg">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie mr-2"></i>Resiembras por Estado
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" style="position: relative;">
                        <canvas id="resowingsByStatusChart"></canvas>
                        <div id="pieTooltip" class="tooltip" style="display: none; position: absolute; background: #fff; border: 1px solid #bdc3c7; padding: 8px; border-radius: 4px; font-size: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);"></div>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php $__currentLoopData = $resowingsByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color: #<?php echo e(sprintf('%06X', mt_rand(0, 0xFFFFFF))); ?>"></i> <?php echo e($item->status); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Métricas secundarias -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card bg-gradient-primary text-white shadow-lg rounded-lg">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-white text-uppercase mb-2">
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
                            <i class="fas fa-calendar-week fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card bg-gradient-success text-white shadow-lg rounded-lg">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-white text-uppercase mb-2">
                                Tasa de Supervivencia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white">92.5%</div>
                            <div class="text-xs text-white mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>+2.3% vs mes anterior
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de estadísticas detalladas -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-gradient-warning text-white shadow-lg rounded-lg hover-scale">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-3">
                        <i class="fas fa-fish fa-3x mb-2"></i>
                        <h6 class="card-title mb-0">Peces en Seguimiento</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light text-dark mb-2">Próximamente</div>
                        <p class="card-text mb-0">Sistema en desarrollo</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-gradient-danger text-white shadow-lg rounded-lg hover-scale">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-3">
                        <i class="fas fa-leaf fa-3x mb-2"></i>
                        <h6 class="card-title mb-0">Plantas Monitoreadas</h6>
                    </div>
                    <div class="h3 mb-2"><?php echo e($cropsCount); ?></div>
                    <div class="small">
                        <div class="badge badge-light text-dark mb-2">En implementación</div>
                        <p class="card-text mb-0">Control fitosanitario</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-gradient-secondary text-white shadow-lg rounded-lg hover-scale">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-3">
                        <i class="fas fa-chart-line fa-3x mb-2"></i>
                        <h6 class="card-title mb-0">Cosechas Registradas</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light text-dark mb-2">Pendiente</div>
                        <p class="card-text mb-0">Historial de producción</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark text-white shadow-lg rounded-lg hover-scale">
                <div class="card-body text-center">
                    <div class="card-header bg-transparent border-0 pb-3">
                        <i class="fas fa-users fa-3x mb-2"></i>
                        <h6 class="card-title mb-0">Usuarios Activos</h6>
                    </div>
                    <div class="h3 mb-2">0</div>
                    <div class="small">
                        <div class="badge badge-light text-dark mb-2">Configuración</div>
                        <p class="card-text mb-0">Gestión de accesos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-lg rounded-lg">
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
                            <p class="text-muted mb-3">25/08/2025 02:20 PM -05</p>
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
        Chart.defaults.global.defaultFontFamily = 'Poppins, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
        Chart.defaults.global.defaultFontColor = '#2c3e50';

        // Gráfica de Mortalidad (Bar Chart)
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
                    backgroundColor: 'rgba(52, 152, 219, 0.8)',
                    borderColor: 'rgba(52, 152, 219, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(52, 152, 219, 0.9)',
                    hoverBorderColor: 'rgba(52, 152, 219, 1)',
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontSize: 12,
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 12,
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        gridLines: {
                            color: '#ecf0f1',
                            borderDash: [3, 3]
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: '#fff',
                    bodyFontColor: '#2c3e50',
                    borderColor: '#bdc3c7',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return 'Mortalidad: ' + tooltipItem.yLabel + '%';
                        }
                    }
                }
            }
        });

        // Gráfica de Distribución de Cultivos (Pie Chart)
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
                    backgroundColor: ['#3498db', '#2ecc71', '#1abc9c', '#f1c40f', '#e74c3c'],
                    hoverBackgroundColor: ['#2980b9', '#27ae60', '#16a085', '#f39c12', '#c0392b'],
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: '#fff',
                    bodyFontColor: '#2c3e50',
                    borderColor: '#bdc3c7',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });

        // Gráfica de Cultivos por Especie (JavaScript puro - Bar Chart)
        var cropsBySpeciesCanvas = document.getElementById('cropsBySpeciesChart');
        var cropsBySpeciesCtx = cropsBySpeciesCanvas.getContext('2d');
        var cropsBySpeciesData = <?php echo json_encode($cropsBySpecies ?? [], 15, 512) ?>;
        
        var speciesLabels = cropsBySpeciesData.length > 0 ? cropsBySpeciesData.map(function(item) {
            return item.species ? item.species.name || 'Especie ' + item.species_id : 'Especie ' + item.species_id;
        }) : ['Sin datos'];
        
        var speciesCounts = cropsBySpeciesData.length > 0 ? cropsBySpeciesData.map(function(item) {
            return item.count || 0;
        }) : [0];

        function drawBarChart(progress = 1) {
            cropsBySpeciesCtx.clearRect(0, 0, cropsBySpeciesCanvas.width, cropsBySpeciesCanvas.height);
            
            var barWidth = 50; // Reducido para evitar superposición
            var spacing = 30;
            var maxValue = Math.max(...speciesCounts, 1) || 1;
            var canvasHeight = cropsBySpeciesCanvas.height;
            var canvasWidth = cropsBySpeciesCanvas.width;
            var scaleY = (canvasHeight - 80) / maxValue; // Más margen para etiquetas

            // Dibujar ejes
            cropsBySpeciesCtx.beginPath();
            cropsBySpeciesCtx.moveTo(50, 20);
            cropsBySpeciesCtx.lineTo(50, canvasHeight - 60);
            cropsBySpeciesCtx.lineTo(canvasWidth - 20, canvasHeight - 60);
            cropsBySpeciesCtx.strokeStyle = '#2c3e50';
            cropsBySpeciesCtx.lineWidth = 1.5;
            cropsBySpeciesCtx.stroke();

            // Dibujar barras y etiquetas
            speciesCounts.forEach(function(count, index) {
                var x = 70 + index * (barWidth + spacing);
                var barHeight = count * scaleY * progress;
                var y = canvasHeight - 60 - barHeight;

                if (x + barWidth < canvasWidth) { // Evitar desbordamiento
                    // Dibujar barra
                    cropsBySpeciesCtx.fillStyle = '#2ecc71';
                    cropsBySpeciesCtx.fillRect(x, y, barWidth, barHeight);

                    // Etiqueta del eje X (rotada para evitar superposición)
                    cropsBySpeciesCtx.save();
                    cropsBySpeciesCtx.translate(x + barWidth / 2, canvasHeight - 40);
                    cropsBySpeciesCtx.rotate(-Math.PI / 4);
                    cropsBySpeciesCtx.fillStyle = '#2c3e50';
                    cropsBySpeciesCtx.font = '12px Poppins';
                    cropsBySpeciesCtx.fillText(speciesLabels[index], 0, 0);
                    cropsBySpeciesCtx.restore();

                    // Valor encima de la barra
                    cropsBySpeciesCtx.fillStyle = '#2c3e50';
                    cropsBySpeciesCtx.fillText(Math.round(count * progress), x + barWidth / 2, y - 5);
                }
            });

            // Etiquetas del eje Y
            cropsBySpeciesCtx.textAlign = 'right';
            for (var i = 0; i <= maxValue; i += Math.ceil(maxValue / 5) || 1) {
                var y = canvasHeight - 60 - i * scaleY;
                cropsBySpeciesCtx.fillText(i, 40, y + 5);
            }
        }

        function animateBarChart() {
            var start = null;
            function step(timestamp) {
                if (!start) start = timestamp;
                var progress = Math.min((timestamp - start) / 1000, 1);
                drawBarChart(progress);
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        var barTooltip = document.getElementById('barTooltip');
        cropsBySpeciesCanvas.addEventListener('mousemove', function(event) {
            var rect = cropsBySpeciesCanvas.getBoundingClientRect();
            var x = event.clientX - rect.left;
            var y = event.clientY - rect.top;
            var barWidth = 50;
            var spacing = 30;
            var maxValue = Math.max(...speciesCounts, 1) || 1;
            var canvasHeight = cropsBySpeciesCanvas.height;
            var scaleY = (canvasHeight - 80) / maxValue;

            for (var i = 0; i < speciesCounts.length; i++) {
                var barX = 70 + i * (barWidth + spacing);
                var barHeight = speciesCounts[i] * scaleY;
                var barY = canvasHeight - 60 - barHeight;
                if (x >= barX && x <= barX + barWidth && y >= barY && y <= canvasHeight - 60) {
                    barTooltip.style.display = 'block';
                    barTooltip.style.left = (event.clientX + 10) + 'px';
                    barTooltip.style.top = (event.clientY - 10) + 'px';
                    barTooltip.innerText = `${speciesLabels[i]}: ${speciesCounts[i]} cultivos`;
                    return;
                }
            }
            barTooltip.style.display = 'none';
        });

        // Gráfica de Resiembras por Estado (JavaScript puro - Pie Chart)
        var resowingsByStatusCanvas = document.getElementById('resowingsByStatusChart');
        var resowingsByStatusCtx = resowingsByStatusCanvas.getContext('2d');
        var resowingsByStatusData = <?php echo json_encode($resowingsByStatus ?? [], 15, 512) ?>;
        
        var statusLabels = resowingsByStatusData.length > 0 ? resowingsByStatusData.map(function(item) {
            return item.status;
        }) : ['Sin datos'];
        
        var statusCounts = resowingsByStatusData.length > 0 ? resowingsByStatusData.map(function(item) {
            return item.count || 0;
        }) : [1];

        function drawPieChart(progress = 1) {
            resowingsByStatusCtx.clearRect(0, 0, resowingsByStatusCanvas.width, resowingsByStatusCanvas.height);
            
            var total = statusCounts.reduce((a, b) => a + b, 0) || 1;
            var colors = ['#f1c40f', '#e74c3c', '#3498db'];
            var startAngle = 0;
            var centerX = resowingsByStatusCanvas.width / 2;
            var centerY = resowingsByStatusCanvas.height / 2;
            var radius = Math.min(centerX, centerY) * 0.7;

            statusCounts.forEach(function(count, index) {
                var sliceAngle = (count / total) * 2 * Math.PI * progress;
                resowingsByStatusCtx.beginPath();
                resowingsByStatusCtx.moveTo(centerX, centerY);
                resowingsByStatusCtx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
                resowingsByStatusCtx.closePath();
                resowingsByStatusCtx.fillStyle = colors[index % colors.length];
                resowingsByStatusCtx.fill();
                startAngle += sliceAngle;
            });

            // Círculo central para efecto donut
            resowingsByStatusCtx.beginPath();
            resowingsByStatusCtx.arc(centerX, centerY, radius * 0.5, 0, 2 * Math.PI);
            resowingsByStatusCtx.fillStyle = '#fff';
            resowingsByStatusCtx.fill();
        }

        function animatePieChart() {
            var start = null;
            function step(timestamp) {
                if (!start) start = timestamp;
                var progress = Math.min((timestamp - start) / 1000, 1);
                drawPieChart(progress);
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        var pieTooltip = document.getElementById('pieTooltip');
        resowingsByStatusCanvas.addEventListener('mousemove', function(event) {
            var rect = resowingsByStatusCanvas.getBoundingClientRect();
            var x = event.clientX - rect.left;
            var y = event.clientY - rect.top;
            var centerX = resowingsByStatusCanvas.width / 2;
            var centerY = resowingsByStatusCanvas.height / 2;
            var radius = Math.min(centerX, centerY) * 0.7;
            var innerRadius = radius * 0.5;

            var dx = x - centerX;
            var dy = y - centerY;
            var distance = Math.sqrt(dx * dx + dy * dy);
            if (distance <= radius && distance >= innerRadius) {
                var angle = Math.atan2(dy, dx);
                if (angle < 0) angle += 2 * Math.PI;
                var total = statusCounts.reduce((a, b) => a + b, 0) || 1;
                var startAngle = 0;
                for (var i = 0; i < statusCounts.length; i++) {
                    var sliceAngle = (statusCounts[i] / total) * 2 * Math.PI;
                    if (angle >= startAngle && angle < startAngle + sliceAngle) {
                        pieTooltip.style.display = 'block';
                        pieTooltip.style.left = (event.clientX + 10) + 'px';
                        pieTooltip.style.top = (event.clientY - 10) + 'px';
                        pieTooltip.innerText = `${statusLabels[i]}: ${statusCounts[i]} resiembras`;
                        return;
                    }
                    startAngle += sliceAngle;
                }
            }
            pieTooltip.style.display = 'none';
        });

        // Responsividad
        function resizeCanvases() {
            [cropsBySpeciesCanvas, resowingsByStatusCanvas].forEach(canvas => {
                canvas.width = canvas.parentElement.clientWidth - 40; // Margen para evitar desbordamiento
                canvas.height = 320;
            });
            animateBarChart();
            animatePieChart();
        }

        window.addEventListener('resize', resizeCanvases);
        resizeCanvases(); // Inicializar tamaños

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

        const counters = document.querySelectorAll('.h4.font-weight-bold');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            if (!isNaN(target)) {
                animateCounter(counter, target);
            }
        });
    });
</script>

<style>
/* Paleta de colores moderna */
:root {
    --primary: #3498db;
    --success: #2ecc71;
    --info: #1abc9c;
    --warning: #f1c40f;
    --danger: #e74c3c;
    --dark: #2c3e50;
    --light: #ecf0f1;
    --gray: #bdc3c7;
}

/* Gradientes */
.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #2980b9 100%);
}
.bg-gradient-success {
    background: linear-gradient(135deg, var(--success) 0%, #27ae60 100%);
}
.bg-gradient-info {
    background: linear-gradient(135deg, var(--info) 0%, #16a085 100%);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, var(--warning) 0%, #f39c12 100%);
}
.bg-gradient-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
}
.bg-gradient-dark {
    background: linear-gradient(135deg, var(--dark) 0%, #34495e 100%);
}
.bg-gradient-secondary {
    background: linear-gradient(135deg, var(--gray) 0%, #95a5a6 100%);
}

/* Bordes de tarjetas */
.border-left-primary { border-left: 5px solid var(--primary) !important; }
.border-left-success { border-left: 5px solid var(--success) !important; }
.border-left-info { border-left: 5px solid var(--info) !important; }
.border-left-warning { border-left: 5px solid var(--warning) !important; }

/* Sombras y efectos */
.shadow-lg {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 6px 6px rgba(0, 0, 0, 0.05) !important;
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 12px;
}
.card:hover {
    transform: translateY(-5px);
}
.hover-scale {
    transition: transform 0.3s ease;
}
.hover-scale:hover {
    transform: scale(1.03);
}

/* Tipografía */
body {
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.text-gray-800 { color: var(--dark) !important; }
.text-gray-200 { color: var(--light) !important; }
.text-muted { color: var(--gray) !important; }

/* Gráficas */
.chart-area, .chart-pie {
    position: relative;
    width: 100%;
    min-height: 320px;
}
.chart-area canvas, .chart-pie canvas { border-radius: 8px; }

/* Tooltips */
.tooltip {
    pointer-events: none;
    z-index: 1000;
}

/* Animaciones */
@keyframes  fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.card, .chart-area, .chart-pie {
    animation: fadeInUp 0.5s ease-out;
}

/* Progresos */
.progress-sm { height: 8px; border-radius: 4px; }
.progress-bar { transition: width 0.6s ease; }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
```
<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/welcomepas.blade.php ENDPATH**/ ?>