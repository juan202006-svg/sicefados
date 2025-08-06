@extends('acuaponico::layouts.master')

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --dark-color: #1b263b;
            --light-color: #f8f9fa;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-icon {
            font-size: 2rem;
            opacity: 0.7;
        }
        
        .stat-card .card-body {
            display: flex;
            align-items: center;
        }
        
        .stat-card .icon-container {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .users-icon { background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color); }
        .sales-icon { background-color: rgba(76, 201, 240, 0.1); color: var(--success-color); }
        .revenue-icon { background-color: rgba(248, 150, 30, 0.1); color: var(--warning-color); }
        .orders-icon { background-color: rgba(247, 37, 133, 0.1); color: var(--danger-color); }
        
        .recent-orders table tbody tr {
            transition: all 0.2s;
        }
        
        .recent-orders table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-processing { background-color: #cce5ff; color: #004085; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        
        .top-bar {
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-bar {
            position: relative;
            width: 300px;
        }
        
        .search-bar input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid #ddd;
        }
        
        .search-bar i {
            position: absolute;
            left: 15px;
            top: 10px;
            color: #aaa;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .notification-badge {
            position: relative;
            margin-right: 20px;
        }
        
        .notification-badge .badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        
        .activity-item {
            border-left: 3px solid #eee;
            padding-left: 15px;
            margin-left: 15px;
            padding-bottom: 15px;
            position: relative;
        }
        
        .activity-item:last-child {
            padding-bottom: 0;
        }
        
        .activity-item::before {
            content: '';
            width: 12px;
            height: 12px;
            border-radius: 50%;
            position: absolute;
            left: -7.5px;
            top: 5px;
        }
        
        .activity-item.primary::before { background-color: var(--primary-color); }
        .activity-item.success::before { background-color: var(--success-color); }
        .activity-item.warning::before { background-color: var(--warning-color); }
        .activity-item.danger::before { background-color: var(--danger-color); }
        .activity-item.info::before { background-color: var(--accent-color); }
    </style>
</head>
<body>

    
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="icon-container users-icon">
                        <i class="bi bi-people-fill card-icon"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Usuarios</h6>
                        <h3 class="mb-0">1,254</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> 12.5%</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="icon-container sales-icon">
                        <i class="bi bi-cart-check-fill card-icon"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Ventas</h6>
                        <h3 class="mb-0">$24,780</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> 8.2%</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="icon-container revenue-icon">
                        <i class="bi bi-currency-dollar card-icon"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Ingresos</h6>
                        <h3 class="mb-0">$18,650</h3>
                        <small class="text-danger"><i class="bi bi-arrow-down"></i> 3.4%</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="icon-container orders-icon">
                        <i class="bi bi-box-seam card-icon"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Pedidos</h6>
                        <h3 class="mb-0">324</h3>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> 5.7%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ventas Mensuales</h5>
                    <div>
                        <select class="form-select form-select-sm" style="width: 120px;">
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Distribución de Ventas</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesDistributionChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders and Activity -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card recent-orders">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pedidos Recientes</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Ver todos</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-7841</td>
                                    <td>Juan Pérez</td>
                                    <td>15/05/2023</td>
                                    <td>$245.00</td>
                                    <td><span class="badge-status status-completed">Completado</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-7840</td>
                                    <td>María Gómez</td>
                                    <td>15/05/2023</td>
                                    <td>$189.50</td>
                                    <td><span class="badge-status status-processing">Procesando</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-7839</td>
                                    <td>Carlos Ruiz</td>
                                    <td>14/05/2023</td>
                                    <td>$320.75</td>
                                    <td><span class="badge-status status-pending">Pendiente</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-7838</td>
                                    <td>Ana López</td>
                                    <td>14/05/2023</td>
                                    <td>$145.20</td>
                                    <td><span class="badge-status status-completed">Completado</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-7837</td>
                                    <td>Pedro Sánchez</td>
                                    <td>13/05/2023</td>
                                    <td>$89.90</td>
                                    <td><span class="badge-status status-cancelled">Cancelado</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actividad Reciente</h5>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="activity-item primary mb-3">
                        <h6 class="mb-1">Nuevo usuario registrado</h6>
                        <p class="mb-0 text-muted">Carlos Mendoza se registró en el sistema</p>
                        <small class="text-muted">Hace 15 minutos</small>
                    </div>
                    
                    <div class="activity-item success mb-3">
                        <h6 class="mb-1">Nuevo pedido realizado</h6>
                        <p class="mb-0 text-muted">Pedido #ORD-7842 por $156.00</p>
                        <small class="text-muted">Hace 1 hora</small>
                    </div>
                    
                    <div class="activity-item warning mb-3">
                        <h6 class="mb-1">Pedido enviado</h6>
                        <p class="mb-0 text-muted">Pedido #ORD-7838 ha sido enviado</p>
                        <small class="text-muted">Hace 3 horas</small>
                    </div>
                    
                    <div class="activity-item info mb-3">
                        <h6 class="mb-1">Pago recibido</h6>
                        <p class="mb-0 text-muted">Pago de $245.00 recibido para #ORD-7841</p>
                        <small class="text-muted">Hace 5 horas</small>
                    </div>
                    
                    <div class="activity-item danger">
                        <h6 class="mb-1">Pedido cancelado</h6>
                        <p class="mb-0 text-muted">Pedido #ORD-7835 ha sido cancelado</p>
                        <small class="text-muted">Ayer, 4:25 PM</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ventas 2023',
                    data: [12500, 19000, 15000, 18000, 21000, 19500, 23000, 24500, 22000, 25000, 23500, 28000],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }, {
                    label: 'Ventas 2022',
                    data: [10000, 15000, 12000, 14000, 17000, 16000, 18500, 19500, 18000, 20000, 19000, 22000],
                    borderColor: '#adb5bd',
                    backgroundColor: 'rgba(173, 181, 189, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    borderDash: [5, 5]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
        
        // Sales Distribution Chart
        const distCtx = document.getElementById('salesDistributionChart').getContext('2d');
        const distChart = new Chart(distCtx, {
            type: 'doughnut',
            data: {
                labels: ['Electrónica', 'Ropa', 'Hogar', 'Juguetes', 'Otros'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#4361ee',
                        '#4cc9f0',
                        '#f8961e',
                        '#f72585',
                        '#adb5bd'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
        
        // Update charts on window resize
        window.addEventListener('resize', function() {
            salesChart.resize();
            distChart.resize();
        });
    </script>
@endsection
