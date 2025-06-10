@extends('layouts.layoutMain')
@section('title', 'Reportes')
@include('utils.navegacion')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Reporte de Productos</h2>

        <a href="{{ route('reportes.excel') }}"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block transition">
            Exportar a Excel
        </a>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium">Nombre</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Descripción</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Precio</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Cantidad</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Categoría</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="px-4 py-2">{{ $producto->nombre }}</td>
                            <td class="px-4 py-2">{{ $producto->descripcion }}</td>
                            <td class="px-4 py-2">${{ number_format($producto->precio, 2) }}</td>
                            <td class="px-4 py-2">{{ $producto->cantidad }}</td>
                            <td class="px-4 py-2">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Productos creados por mes</h2>

            <div class="bg-white p-6 rounded-lg shadow">
                <canvas id="productosChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('productosChart').getContext('2d');
        const productosChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Productos creados',
                    data: {!! json_encode($datos) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mes'
                        }
                    }
                }
            }
        });
    </script>
@endsection
