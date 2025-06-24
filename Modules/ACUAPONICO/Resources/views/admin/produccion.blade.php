@extends('acuaponico::layouts.master')

@section('content2')
<style>
.pagination {
    display: flex;
    justify-content: center;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}

.pagination li {
    margin: 0 3px;
}

.pagination .page-link {
    padding: 6px 12px;
    color: #007bff;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}

.pagination .active .page-link {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mt-5" style="font-family: 'Noto Sans', sans-serif; font-weight: 600;">
                Producción
            </h1>

            <div class="border-bottom mt-4 mb-3"></div>

            <!-- Menú horizontal -->
            <div class="d-flex flex-wrap">
                <button onclick="mostrarSeccion('cultivos')" class="flex-fill btn btn-success text-white m-1 d-flex align-items-center justify-content-center" style="height: 60px;">
                    <i class="fas fa-seedling me-2"></i> Cultivos
                </button>
                <button onclick="mostrarSeccion('plantas')" class="flex-fill btn btn-success text-white m-1 d-flex align-items-center justify-content-center" style="height: 60px;">
                    <i class="fas fa-leaf me-2"></i> Categorias
                </button>
                <button onclick="mostrarSeccion('peces')" class="flex-fill btn btn-success text-white m-1 d-flex align-items-center justify-content-center" style="height: 60px;">
                    <i class="fas fa-fish me-2"></i> Seguimiento de Peces
                </button>
                <button onclick="mostrarSeccion('general')" class="flex-fill btn btn-success text-white m-1 d-flex align-items-center justify-content-center" style="height: 60px;">
                    <i class="fas fa-chart-line me-2"></i> Seguimiento General
                </button>
                <button onclick="mostrarSeccion('cosecha')" class="flex-fill btn btn-success text-white m-1 d-flex align-items-center justify-content-center" style="height: 60px;">
                    <i class="fas fa-tools me-2"></i> Cosecha
                </button>
            </div>

            <!-- Contenido dinámico -->
            <div class="mt-4">
                <div id="seccion-cultivos" class="seccion">
                    <div class="card shadow-sm border-0">
                        <div class="mb-4 mt-3">
                            <h3 class="mb-0 text-center fz-3x">Lista de Cultivos</h3>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="table-responsive mt-4">
                        <!-- Separación lateral usando padding -->
                        <div class="px-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                <!-- Búsqueda -->
                                <div class="d-flex align-items-center gap-2">
                                    <label for="busqueda" class="fw-semibold text-secondary mb-0">Buscar:</label>
                                    <input type="text" id="busqueda" class="form-control" style="width: 250px;" placeholder="Búsqueda..." onkeyup="filtrarTabla()">
                                </div>

                                <!-- Botones -->
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success" onclick="exportarExcel()">
                                        <i class="fas fa-file-excel me-2"></i> Excel
                                    </button>
                                    <button class="btn btn-danger" onclick="generarPDF()">
                                        <i class="fas fa-file-pdf me-2"></i> PDF
                                    </button>
                                </div>
                            </div>
                        </div>

                            <div class="border-bottom"></div>
                            <div class="card-body">
                                <table id="tabla-especies" class="table table-hover table-bordered align-middle text-center">
                                    <thead style="background-color: #f8f9fa;">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Fecha</th>
                                            <th>Especie</th>
                                            <th>Lote</th>
                                            <th>Cantidad</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                             @foreach ($cultivos as $cultivo)
                                                 <tr>
                                                     <td>{{ $loop->iteration }}</td>
                                                     <td>{{ $cultivo->date }}</td>
                                                     <td>{{ $cultivo->species->common_name ?? 'Sin especie' }}</td>
                                                     <td>{{ $cultivo->lot->name ?? 'Sin lote' }}</td>
                                                     <td>{{ $cultivo->quantity }}</td>
                                                     <td>{{ $cultivo->status }}</td>
                                                 </tr>
                                             @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <nav>
                                        <ul class="pagination justify-content-center" style="margin: 0;">
                                            @php
                                                $currentPage = $cultivos->currentPage();
                                                $lastPage = $cultivos->lastPage();
                                            @endphp 
                                            {{-- Botón anterior --}}
                                            @if ($currentPage > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $cultivos->url($currentPage - 1) }}">&laquo; Anterior</a>
                                                </li>
                                            @endif
                                            {{-- Números de página --}}
                                            @for ($i = 1; $i <= $lastPage; $i++)
                                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $cultivos->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            {{-- Botón siguiente --}}
                                            @if ($currentPage < $lastPage)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $cultivos->url($currentPage + 1) }}">Siguiente &raquo;</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div id="seccion-plantas" class="seccion d-none">
                    <div class="card shadow-sm border-0">
                        <div class="mb-4 mt-3">
                            <h3 class="mb-0 text-center fz-3x">Lista de Categorías</h3>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="table-responsive mt-4">
                            <!-- Separación lateral usando padding -->
                            <div class="px-3">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                    <!-- Búsqueda -->
                                    <div class="d-flex align-items-center gap-2">
                                        <label for="busqueda-categorias" class="fw-semibold text-secondary mb-0">Buscar:</label>
                                        <input type="text" id="busqueda-categorias" class="form-control" style="width: 250px;" placeholder="Búsqueda..." onkeyup="filtrarTabla('tabla-categorias', 'busqueda-categorias')">
                                    </div>

                                    <!-- Botones -->
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success" onclick="exportarExcel('tabla-categorias', 'categorias.xlsx', ['Código', 'Nombre', 'Fecha'])">
                                            <i class="fas fa-file-excel me-2"></i> Excel
                                        </button>
                                        <button class="btn btn-danger" onclick="generarPDF('tabla-categorias', 'Lista de Categorías', 'categorias.pdf')">
                                            <i class="fas fa-file-pdf me-2"></i> PDF
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="border-bottom"></div>
                            <div class="card-body">
                                <table id="tabla-categorias" class="table table-hover table-bordered align-middle text-center">
                                    <thead style="background-color: #f8f9fa;">
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $categoria)
                                            <tr>
                                                <td>{{ $loop->iteration + ($categorias->currentPage() - 1) * $categorias->perPage() }}</td>
                                                <td>{{ $categoria->name }}</td>
                                                <td>{{ $categoria->date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <nav>
                                        <ul class="pagination justify-content-center" style="margin: 0;">
                                            @php
                                                $currentPage = $categorias->currentPage();
                                                $lastPage = $categorias->lastPage();
                                            @endphp
                                            {{-- Botón anterior --}}
                                            @if ($currentPage > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $categorias->url($currentPage - 1) }}">« Anterior</a>
                                                </li>
                                            @endif
                                            {{-- Números de página --}}
                                            @for ($i = 1; $i <= $lastPage; $i++)
                                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $categorias->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            {{-- Botón siguiente --}}
                                            @if ($currentPage < $lastPage)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $categorias->url($currentPage + 1) }}">Siguiente »</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="seccion-peces" class="seccion d-none">
                    <h3>Seguimiento de Peces</h3>
                    <p>Contenido del seguimiento de peces.</p>
                </div>

                <div id="seccion-general" class="seccion d-none">
                    <h3>Seguimiento General</h3>
                    <p>Contenido del seguimiento general.</p>
                </div>

                <div id="seccion-cosecha" class="seccion d-none">
                    <h3>Cosecha</h3>
                    <p>Contenido de cosecha.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Script para alternar secciones -->
<script>
    function mostrarSeccion(id) {
        document.querySelectorAll('.seccion').forEach(seccion => {
            seccion.classList.add('d-none');
        });
        const activa = document.getElementById('seccion-' + id);
        if (activa) {
            activa.classList.remove('d-none');
        }
    }

    // Descargar PDF
    function generarPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Lista de Cultivos", 14, 20);

        doc.autoTable({
            html: '#tabla-especies',
            startY: 30,
            theme: 'grid',
            styles: {
                fontSize: 10,
                cellPadding: 3,
                haling: 'center',
            }
        });

        doc.save('cultivos.pdf');
    }

    // Descargar Excel
    function exportarExcel() {
        const filas = document.querySelectorAll("#tabla-especies tbody tr");
        const data = [];

        data.push([
            "Codigo",
            "Fecha de siembra",
            "Nombre comun de la especie",
            "Lote",
            "Cantidad sembrada",
            "Estado actual"
        ]);

        filas.forEach(fila => {
            const celdas = fila.querySelectorAll("td");
            data.push([
                celdas[0].innerText,
                celdas[1].innerText,
                celdas[2].innerText,
                celdas[3].innerText,
                celdas[4].innerText,
                celdas[5].innerText
            ]);
        });

        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Lista de Cultivos");

        XLSX.writeFile(wb, 'cultivos.xlsx');
    }

    // Filtro en vivo
    function filtrarTabla() {
        const input = document.getElementById("busqueda");
        const filtro = input.value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-especies tbody tr");

        filas.forEach(fila => {
            const columnas = fila.querySelectorAll("td");
            const textoFila = Array.from(columnas).map(td => td.textContent.toLowerCase()).join(" ");
            fila.style.display = textoFila.includes(filtro) ? "" : "none";
        });
    }


    
    
</script>
@endsection